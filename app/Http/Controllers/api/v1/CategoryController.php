<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function parentCate()
    {
        try {
            $data = Category::all();
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

    public function categories()
    {
        try {
            // $data = Category::tree();
            $data = Category::all();
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


    public function category($id)
    {
        try {
            $data = Category::where('slug','like','%'.$id.'%')->orWhere('id', $id)->get();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:55|unique:categories',
            'slug' => 'required|string|max:55',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $category = new Category([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        $category->save();

        return response()->json([
            'status' => 200,
            'data'   => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Category::find($id);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
            }

            $duplicate = Category::where('name', $request->name)->get();

            if((count($duplicate) != 0) && ($duplicate[0]['id'] != $id)) {
                return response()->json([
                    'status' => 400,
                    'error' => 'Duplicate data',
                ]);
            }else{
                $data->update($request->all());

                return response()->json([
                    'status' => 200,
                    'data' => $data,
                ]);
            }

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
            $data = Category::find($id);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
            }else {
                $count = Category::where('parent_id', $id)->get();
                if(count($count) != 0) {
                    return response()->json([
                        'status' => 204,
                        'errors' => 'Category has children'
                    ]);
                }
            }

            $data->delete();

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
