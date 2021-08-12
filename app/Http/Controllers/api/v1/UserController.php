<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users()
    {
        try {
            $data = User::all();
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

    public function user(Request $request, $id)
    {
        try {
            $data = User::find($id);
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

    public function update(Request $request, $id)
    {
        try {
            $data = User::find($id);

            if(!$data) {
                return response()->json([
                    'status' => 204,
                    'errors' => 'No data'
                ]);
            }

            $duplicate = User::where('name', $request->name)
                    ->orWhere('email', $request->email)->get();

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
            $data = User::find($id);

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
