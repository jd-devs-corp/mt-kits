<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Kit;

class KitController extends Controller
{
    public function index()
    {
        $kits = Kit::latest()->get();

        if (is_null($kits->first())) {
            return response()->json([
                'status' => 404,
                'message' => 'No kit Found'
            ], 200);
        }
        $response = [
            'status' => 200,
            'kits' => 'products are here',
            'data' => $kits,
        ];
        return response()->json($response, 200);

    }

    /*
     * Store a newly created resource in storage *Jiordi viera*
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id|numeric',
            'kit_number' => 'required|unique:kits',
            'localisation' => 'required',
            'user_id' => 'nullable|exists:users,id|numeric',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error',
                'data' => $validate->errors(),
            ], 403);
        }
        $kit = Kit::create($request->all());

        $response = [
            'status' => 200,
            'message' => 'Kit created successfully',
            'data' => $kit
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $kit = Kit::find($id);
        if (is_null($kit)) {
            return response()->json([
                'status' => 404,
                'message' => 'No kit Found'
            ], 200);
        }
        $response = [
            'status' => 200,
            'kit' => 'kit is here',
            'data' => $kit,
        ];
        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id|numeric',
            'kit_number' => 'required|unique:kits',
            'localisation' => 'required',
            'user_id' => 'nullable|exists:users,id|numeric',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error',
                'data' => $validate->errors(),
            ], 403);
        }
        $kit = Kit::find($id);
        $kit->update($request->all());
        $response = [
            'status' => 200,
            'message' => 'Kit updated successfully',
            'data' => $kit
        ];
        return response()->json($response, 200);
    }

    /*Search*/

    public function search($kit_number)
    {
        $kit = Kit::where('kit_number', 'like', '%' . $kit_number . '%')->latest()->get();

        if (is_null($kit->first())) {
            return response()->json([
                'status' => 404,
                'message' => 'No kit Found'
            ], 200);
        }
        $response = [
            'status' => 200,
            'kits' => 'kits are here',
            'data' => $kit,
        ];
        return response()->json($response, 200);
    }


}
