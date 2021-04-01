@extends('layout')

@section('content')
    <h1>Dashboard de vendas</h1>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href="{{route('sales.create')}}"  class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Nova venda</a></h5>
            <form action="" method="get" id='formFilter'>
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" name='client' id="client">
                               @foreach($clients as $key => $value)
                                 <option value="{{$key}}">{{$value}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername" name="date_range" id="dateRange" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" id="btnFilter" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                <tbody id="listSales">
                @foreach($sales as $sale)
                    <tr>
                        <td>{{$sale->product->name}}</td>
                        <td>{{$sale->date}}</td>
                        <td>{{$sale->total}}</td>
                        <td><a href="{{route('sales.edit',$sale->id)}}" class="btn btn-primary">Editar</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Quantidade
                    </th>
                    <th scope="col">
                        Valor Total
                    </th>
                </tr>
                <tr>
                    <td>
                        Vendidos
                    </td>
                    <td>
                        {{$countStatusSold->amountCount}}
                    </td>
                    <td>
                        {{number_format($countStatusSold->totalSum,2,",",".")}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Cancelados
                    </td>
                    <td>
                        {{$countStatusDisapproved->amountCount}}
                    </td>
                    <td>
                        {{number_format($countStatusDisapproved->totalSum,2,",",".")}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluções
                    </td>
                    <td>
                        {{$countStatusCanceled->amountCount}}
                    </td>
                    <td>
                        {{number_format($countStatusCanceled->totalSum,2,",",".")}}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a href="{{route('products.create')}}" class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>  Novo produto</a></h5>
            <table class='table'>
                <tr>
                    <th scope="col">
                        Nome
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-primary">Editar</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script>
         //request
        function requestFilterSale(data){
            return $.ajax({
                method: 'GET',
                url: "/sales",
                data: data ?? null,
            });
        }

        $('#formFilter').on('submit', function(event){
            const  dataForm = {
                client: $("#client").val(),
                dateRange: $(".date_range").val()
            }
            const sales = requestFilterSale(dataForm);
            sales.done(function(result){
                $('#listSales').html('');
                if(result.data.length == 0){
                    $('#listSales').html('<tr><td colspan="4"><center>Nenhum dado encontrado!</center></td></tr>');
                }
                result.data.map(function(sale){
                    $('#listSales').append(
                        `<tr>
                            <td>${sale.product.name}</td>
                            <td>${sale.date}</td>
                            <td>${sale.total}</td>
                            <td>
                             <a class="btn btn-primary" href="${sale.editUrl}" style="color:white;">Editar</a>
                            </td>
                        </tr>`
                    );
                });

            });
            event.preventDefault();
        });
    </script>
@endsection
