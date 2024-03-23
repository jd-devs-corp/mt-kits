<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::get();

        if (is_null($clients->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No kit Found'
            ], 200);
        }
        $response = [
            'status' => 'success',
            'kits' => 'products are here',
            'data' => $clients,
        ];
        return response()->json($response, 200);

    }

    /*
     * Store a newly created resource in storage *Jiordi viera*
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients|regex:/(.+)@(.+)\.(.+)/i',
            'phone_country' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error',
                'data' => $validate->errors(),
            ], 403);
        }
        $client = Client::create($request->all());

        $response = [
            'status' => 200,
            'message' => 'Client created successfully',
            'data' => $client
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $client = Client::find($id);
        if (is_null($client)) {
            return response()->json([
                'status' => 404,
                'message' => 'No client Found'
            ], 200);
        }
        $response = [
            'status' => 200,
            'clients' => 'clients are here',
            'data' => $client,
        ];
        return response()->json($response, 200);
    }

    /*Update*/

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients|regex:/(.+)@(.+)\.(.+)/i',
            'phone_country' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 500,
                'message' => 'Validation error',
                'data' => $validate->errors(),
            ], 403);
        }
        $client = Client::find($id);
        if (is_null($client)) {
            return response()->json([
                'status' => 404,
                'message' => 'No kit Found'
            ], 200);
        }
        $client->update($request->all());
        $response = [
            'status' => 200,
            'message' => 'Client updated successfully',
            'data' => $client
        ];
        return response()->json($response, 200);
    }

    /*Search*/

    public function search($name)
    {
        $client= Client::where('name', 'like', '%' . $name . '%')->latest()->get();

        if (is_null($client->first())){
            return response()->json([
                'status' => 404,
                'message' => 'No kit Found'
            ], 200);
        }
        $response= [
            'status' => 200,
            'kits' => 'products are here',
            'data' => $client
        ];
        return response()->json($response, 200);
    }
}
