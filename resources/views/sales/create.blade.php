@extends('../layout')

@section('content')
    <h1>Adicionar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="{{ route('sales.store') }}" method="POST">
            @csrf
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control " name="name" id="name">
                    @if($errors->has('name'))
                        <div class='text-danger'>
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                    @if($errors->has('email'))
                        <div class='text-danger'>
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" placeholder="99999999999">
                    @if($errors->has('cpf'))
                        <div class='text-danger'>
                            {{ $errors->first('cpf') }}
                        </div>
                    @endif
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product">Produto</label>
                    <select id="product" name="product_id" class="form-control">
                        @foreach($products as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('product_id'))
                        <div class='text-danger'>
                            {{ $errors->first('product_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" class="form-control single_date_picker" name="date" id="date">
                    @if($errors->has('date'))
                        <div class='text-danger'>
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="quantity">Quantidade</label>
                    <input type="text" class="form-control" id="quantity" name="amount" placeholder="1 a 10">
                    @if($errors->has('amount'))
                        <div class='text-danger'>
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="text" class="form-control" id="discount" name="discount" placeholder="100,00 ou menor">
                    @if($errors->has('discount'))
                        <div class='text-danger'>
                            {{ $errors->first('discount') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value='' selected>Escolha...</option>
                        <option value='1'>Aprovado</option>
                        <option value='2'>Cancelado</option>
                        <option value='3'>Devolvido</option>
                    </select>
                    @if($errors->has('status'))
                        <div class='text-danger'>
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" ></script>
    <script>
        $('#price').mask('0000000,00', {reverse: true});
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#discount').mask('0000000,00', {reverse: true});
    </script>
@endsection
