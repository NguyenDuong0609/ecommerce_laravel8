<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function coupons()
    {
        try {
            $data = Coupon::all();
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

    public function coupon($id)
    {
        try {
            $data = Coupon::where('code',$id)->orWhere('id', $id)->get();
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
            'name' => 'required|string|max:55|unique:coupons',
            'code' => 'required|string|max:55|unique:coupons',
            'type' => 'required|string|max:55',
            'value' => 'required|string|max:55',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $coupon = new Coupon([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
        ]);

        $coupon->save();

        return response()->json([
            'status' => 200,
            'data'   => $coupon,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Coupon::find($id);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
            }

            $duplicate = Coupon::where('name', $request->name)->get();

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
            $data = Coupon::find($id);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
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
