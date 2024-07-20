<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'product_id'=>'required',
            'customer_id'=>'required',
            'purchase_value'=>'required',
            'purchased_amount'=>'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $sales = Sale::create([
            'product_id' => $request->product_id,
            'customer_id' => $request->customer_id,
            'purchase_value' => $request->purchase_value,
            'purchased_amount' => $request->purchased_amount
        ]);

        if (!$sales) {
            $data = [
                'message' => 'Error al crear la venta',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'product' => $sales,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $sales = Sale::find($id);

        if (!$sales) {
            $data = [
                'message' => 'venta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'product' => $sales,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $sales = Sale::find($id);

        if (!$sales) {
            $data = [
                'message' => 'venta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $sales->delete();

        $data = [
            'message' => 'venta eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $sales = Sale::find($id);

        if (!$sales) {
            $data = [
                'message' => 'venta no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'product_id'=>'required',
            'customer_id'=>'required',
            'purchase_value'=>'required',
            'purchased_amount'=>'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $sales->product_id=$request->product_id;
        $sales->customer_id=$request->customer_id;
        $sales->purchase_value=$request->purchase_value;
        $sales->purchased_amount=$request->purchased_amount;

        $sales->save();

        $data = [
            'message' => 'venta actualizado',
            'product' => $sales,
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}
