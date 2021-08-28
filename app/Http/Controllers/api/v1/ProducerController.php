<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Producer;

class ProducerController extends Controller
{
    public function producers()
    {
        try {
            $data = Producer::all();
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

    public function producer($id)
    {
        try {
            $data = Producer::where('id', $id)->get();
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
            'name' => 'required|string|max:55|unique:producers',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        $producer = new Producer([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        $producer->save();

        return response()->json([
            'status' => 200,
            'data'   => $producer,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Producer::find($id);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
            }

            $duplicate = Producer::where('name', $request->name)->get();

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
            $data = Producer::find($id);

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
