<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    //
    public function index(){
        $customers= Customer::all();
        if($customers->isEmpty()){
            $data=[
                'message' => 'No hay clientes registradas',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        return response()->json($customers, 200);
    }
}
