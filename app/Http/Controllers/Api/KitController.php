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

        if(is_null($kits->first())){
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
        return $response()->json($response, 200);

    }

    /*
     * Store a newly created resource in storage *Jiordi viera*
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|',
        ]);
    }
}
