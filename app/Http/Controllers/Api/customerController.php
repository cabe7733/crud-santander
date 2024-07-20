<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'document'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'city'=>'required',
            'email'=>'required|email',
            'age'=>'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $customers = Customer::create([
            'name'=> $request->name,
            'document'=> $request->document,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'city'=> $request->city,
            'email'=> $request->email,
            'age'=> $request->age,
        ]);

        if (!$customers) {
            $data = [
                'message' => 'Error al crear el cliente',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'product' => $customers,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $customers = Customer::find($id);

        if (!$customers) {
            $data = [
                'message' => 'cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'product' => $customers,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $customers = Customer::find($id);

        if (!$customers) {
            $data = [
                'message' => 'cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $customers->delete();

        $data = [
            'message' => 'cliente eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $customers = Customer::find($id);

        if (!$customers) {
            $data = [
                'message' => 'cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'document'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'city'=>'required',
            'email'=>'required|email',
            'age'=>'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $customers->name= $request->name;
        $customers->document= $request->document;
        $customers->phone= $request->phone;
        $customers->address= $request->address;
        $customers->city= $request->city;
        $customers->email= $request->email;
        $customers->age= $request->age;
        $customers->save();

        $data = [
            'message' => 'cliente actualizado',
            'customers' => $customers,
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}
