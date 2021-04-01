<?php

namespace App\Http\Controllers;
use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;


class ClientsController extends Controller
{
    public function index()
    {
        

        return view('admin.clients.index');
    }

    public function create()
    {
     

        return view('admin.clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        

        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
       

        return view('admin.clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
               

        $client->delete();

        return back();
    }

   
}