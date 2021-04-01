@extends('layout')

@section('content')

    <h1>Adicionar / Editar Produto</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="{{route('products.update',[$product->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" class="form-control " value="{{ old('name', isset($product) ? $product->name : '') }}" name="name" id="name">
                    @if($errors->has('name'))
                        <div  class='text-danger'>
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" rows='5' class="form-control" name="description"  id="description">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                    @if($errors->has('description'))
                        <div  class='text-danger'>
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="text" class="form-control" name="price" id="price" value="{{ old('price', isset($product) ? $product->price : '') }}" placeholder="100,00 ou maior">
                    @if($errors->has('price'))
                        <div  class='text-danger'>
                            {{ $errors->first('price') }}
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
    </script>
@endsection
