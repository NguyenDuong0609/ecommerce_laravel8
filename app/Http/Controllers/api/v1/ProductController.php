<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        try {
            $data = Product::with('category')->paginate(2);
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        $images = null;
        $validator = Validator::make($request->all(), [
            'slug' => 'required|string|max:55',
            'title' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'product_type_id' => 'required',
            'price' => 'required',
            'status' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'specification' => 'required',
            'quality' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        if ($request->hasFile('files')) {

            $files = $request->file('files');
            $allowedfileExtension=['jpg','png'];
            $exe_flg = true;

            foreach($files as $file) {
				$extension = $file->getClientOriginalExtension();
				$check=in_array($extension,$allowedfileExtension);

				if(!$check) {
                    // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
					$exe_flg = false;
					break;
				}
			}

            if($exe_flg) {
                $i=1;
				foreach ($files as $file) {

                    $fileName = $request->slug.$i.".". $file->getClientOriginalExtension();

                    $file->move(public_path('images'), $fileName);

                    $images = $images.",".$fileName;
                    $i++;

				}

                $request['images'] = $images;

                $product = new Product($request->all());

                $product->save();

                return response()->json([
                    'status' => 200,
                    'data'   => $product,
                ]);
			} else {
				return response()->json([
                    'status' => 204,
                    'errors' => 'No images upload'
                ]);
			}
        }

        return response()->json([
            'status' => 204,
            'errors' => 'No images'
        ]);
    }

    public function update(Request $request, $id)
    {
        $images = null;
        try {
            $data = Product::find($id);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
            }

            $duplicate = Product::where('title', $request->title)->get();

            if((count($duplicate) != 0) && ($duplicate[0]['id'] != $id)) {
                return response()->json([
                    'status' => 400,
                    'error' => 'Duplicate data',
                ]);
            }else{

                if ($request->hasFile('files')) {
                    $files = $request->file('files');
                    $allowedfileExtension=['jpg','png'];
                    $exe_flg = true;

                    foreach($files as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);

                        if(!$check) {
                            // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                            $exe_flg = false;
                            break;
                        }
                    }

                    if($exe_flg) {
                        $i=1;
                        foreach ($files as $file) {
                            $fileName = $request->title.$i.".". $file->getClientOriginalExtension();
                            $file->move(public_path('images'), $fileName);

                            $images = $images.",".$fileName;
                            $i++;
                        }
                        $request['images'] = json_encode($images);

                    } else {
                        return response()->json([
                            'status' => 204,
                            'errors' => 'No images upload'
                        ]);
                    }
                }

                $data->update($request->all());

                        return response()->json([
                            'status' => 200,
                            'data'   => $data,
                        ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function product($id)
    {
        try {
            if(is_numeric($id)) {
                $data = Product::where('id', $id)->get();
            }else{
                $data = Product::where('slug','like','%'.$id.'%')->get();
            }
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $data = Product::find($id);

            $images =  json_decode($data['images']);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
            }

           $data->delete();
            foreach($images as $image) {
                unlink(public_path('images/'). $image);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Delete successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'errors' => $e->getMessage()
            ]);
        }
    }
}
