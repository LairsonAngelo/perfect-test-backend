<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Sale;
use App\Client;

class DashboardController
{
    public function index()
    {   
        
        $products = Product::all();
        $sales = Sale::all();   
        $clients = Client::get()->pluck('name','id')->prepend('Cliente', '');
            
        $countStatusSold = Sale::where('status','1')
                                ->select(DB::raw('count(sales.id) as amountCount,sum(products.price * sales.amount - sales.discount) as totalSum'))
                                ->join('products','products.id','=','sales.product_id')
                                ->first();
        $countStatusDisapproved = Sale::where('status','2')
                                    ->select(DB::raw('count(sales.id) as amountCount,sum(products.price * sales.amount - sales.discount) as totalSum'))
                                    ->join('products','products.id','=','sales.product_id')
                                    ->first();
        $countStatusCanceled = Sale::where('status','3')
                                    ->select(DB::raw('count(sales.id) as amountCount,sum(products.price * sales.amount - sales.discount) as totalSum'))
                                    ->join('products','products.id','=','sales.product_id')
                                    ->first();


        return view('dashboard',compact('products','sales','countStatusSold','countStatusDisapproved','countStatusCanceled','clients'));
    }
}