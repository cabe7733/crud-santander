<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class saleController extends Controller
{
    public function index(){
        $sales= Sale::all();
        if($sales->isEmpty()){
            $data=[
                'message' => 'No hay ventas registradas',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($sales, 200);
    }
}
