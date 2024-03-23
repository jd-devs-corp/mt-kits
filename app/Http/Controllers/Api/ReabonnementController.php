<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReabonnementController extends Controller
{
    public function index()
    {
        $reabonnements = Reabonnement::get();

        if (is_null($reabonnements->first())) {
            return response()->json([
                'status' => 404,
                'message' => 'No reabonnement Found'
            ], 200);
        }
        $response = [
            'status' => 200,
            'reabonnements' => 'products are here',
            'data' => $reabonnements,
        ];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'kit_id' => 'required|exists:kits,id|numeric',
            'date_abonnement' => 'required',
            'date_fin_abonnement' => 'required',
            'plan_tarifaire' => 'required|numeric',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error',
                'data' => $validate->errors(),
            ], 403);
        }
        $reabonnement = Reabonnement::create($request->all());

        $response = [
            'status' => 200,
            'message' => 'Reabonnement created successfully',
            'data' => $reabonnement
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $reabonnements = Reabonnement::where('kit_id', $id)->get();

        if (is_null($reabonnements->first())) {
            return response()->json([
                'status' => 404,
                'message' => 'No reabonnement Found'
            ], 200);
        }
        $response = [
            'status' => 200,
            'reabonnements' => 'products are here',
            'data' => $reabonnements,
        ];
        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'kit_id' => 'required|exists:kits,id|numeric',
            'date_abonnement' => 'required',
            'date_fin_abonnement' => 'required',
            'plan_tarifaire' => 'required|numeric',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error',
                'data' => $validate->errors(),
            ], 403);
        }
        $reabonnement = Reabonnement::find($id);

        $reabonnement->update($request->all());

        $response = [
            'status' => 200,
            'message' => 'Reabonnement updated successfully',
            'data' => $reabonnement
        ];

        return response()->json($response, 200);
    }


    public function destroy($id)
    {
        $reabonnement = Reabonnement::find($id);
        if (is_null($reabonnement)) {
            return response()->json([
                'status' => 404,
                'message' => 'No reabonnement Found'
            ], 200);
        }
        $reabonnement->delete();
        $response = [
            'status' => 200,
            'message' => 'Reabonnement deleted successfully',
            'data' => $reabonnement
        ];
        return response()->json($response, 200);
    }

    public function search($kit_id)
    {
        $reabonnements = Reabonnement::where('kit_id', $kit_id)->get();
        if (is_null($reabonnements->first())) {
            return response()->json([
                'status' => 404,
                'message' => 'No reabonnement Found'
            ], 200);
        }
        $response = [
            'status' => 200,
            'reabonnements' => 'reabonnements are here',
            'data' => $reabonnements,
        ];
        return response()->json($response, 200);
    }

}
