<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Product;
use App\Sale;
use App\Client;
use Carbon\Carbon;
use Session;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) { 
            try {
                $data = $request->all();
                
                if(isset($data['dateRange'])){
                    $sanitizeDate = explode(" ",$data['dateRange']);
                    $dateFrom = Carbon::createFromFormat('d/m/Y', $sanitizeDate[0])->format('Y-m-d');
                    $dateTo = Carbon::createFromFormat('d/m/Y', $sanitizeDate[2])->format('Y-m-d');
                }

                $data = Sale::when(isset($dateFrom) and isset($dateTo),function($q) use ($dateFrom,$dateTo){
                                $q->whereBetween('date', [$dateFrom, $dateTo]);
                              })
                              ->when(isset($data['client']),function($q)  use ($data){
                                $q->where('client_id',$data['client']);
                              })
                              ->get();
                $result = [
                    'status' => 'sucesso',
                    'status_code' => 200,
                    'data' => $data,
                ];
                return response()->json($result);
            } catch (\Exception $e) {
                $result = [
                    'status' => 'Erro',
                    'status_code' => 500,
                    'message' => 'Erro ' . $e . '. Não foi possível executar esta ação.'
                ];
                return response()->json($result, 500);
            }
        }
    }

    public function create()
    {
        $products = Product::get()->pluck('name','id')->prepend('Escolha...', '');
      
       
        return view('sales.create',compact('products'));
    }

    public function store(StoreSaleRequest $request)
    {
        $data = $request->all();
        try{
            DB::transaction(function () use ($data){
                //save client first
                $client = new Client();
                $client->name = $data['name'];
                $client->cpf = $data['cpf'];
                $client->email = $data['email'];
                $client->save();
                //save sales
                $sale = new Sale();
                $sale->discount = str_replace(',', '.', $data['discount']);
                $sale->product_id = $data['product_id'];
                $sale->client_id = $client->id;
                $sale->date = $data['date'];
                $sale->amount = $data['amount'];
                $sale->status = $data['status'];
                $sale->save();

                Session::flash('success', 'Salvo com sucesso!'); 
            });
        }catch(\Exception $e){
                Session::flash('danger', 'Ops algo deu errado: '.$e); 
        }
      

        return redirect()->route('dashboard');
    }

    public function edit(Sale $sale)
    {
        $products = Product::get()->pluck('name','id')->prepend('Escolha...', '');
        $sale->load('product');
        $statusOptions = array(
            '' => 'Escolha',
            '1' => 'Aprovado',
            '2' => 'Cancelado',
            '3' => 'Devolvido',
        );
        
        return view('sales.edit', compact('sale','products','statusOptions'));
    }

    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $data = $request->all();
        try{
            DB::transaction(function () use ($data,$sale){
                //save client first
                $client = Client::find($sale->client_id);
                $client->name = $data['name'];
                $client->cpf = $data['cpf'];
                $client->email = $data['email'];
                $client->update();
                $sale->update($data);
                Session::flash('success', 'Salvo com sucesso!'); 
            });
        }catch(\Exception $e){
            Session::flash('danger', 'Ops algo deu errado: '.$e); 
        }
        return redirect()->route('dashboard');
    }

  

    public function destroy(Sale $sale)
    {
        $product->delete();
        return back();
    }
}