<?php

namespace App\Http\Controllers;
use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Request;
use Session;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        Session::flash('success', 'Salvo com sucesso!'); 
        return redirect()->route('dashboard');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        Session::flash('success', 'Salvo com sucesso!'); 
        return redirect()->route('dashboard');
    }

  

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }

   
}