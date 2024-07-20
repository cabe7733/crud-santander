<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportsController extends Controller
{
    public function topProducts(){
        $sales= DB::select('SELECT `id`, product.name, `purchase_value`, `purchased_amount`, `created_at` FROM `sale`
                            INNER JOIN product ON sale.product_id = product.id
                            WHERE 1
                            GROUP BY sale.id');
        return response()->json($sales, 200);
    }

    public function topCustomers(){
        $sales= DB::select('select * from users');;
        return response()->json($sales, 200);
    }

    public function totalValueProductAndCustomers(){
        $sales= DB::select('select * from users');;
        return response()->json($sales, 200);
    }

    public function stockProducts(){
        $sales= DB::select('select * from users');;
        return response()->json($sales, 200);
    }
}
