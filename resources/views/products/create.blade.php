@extends('../layout')

@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">    
        <h1>Adicionar / Editar Produto</h1>
        @csrf
        <div class='card'>
            <div class='card-body'>
              
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Nome do produto</label>
                        <input type="text" class="form-control "  name="name" id="name" >
                        @if($errors->has('name'))
                            <div class='text-danger'>
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea type="text" rows='5' class="form-control" id="description" name="description" required></textarea>
                        @if($errors->has('description'))
                            <div  class='text-danger'>
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="100,00 ou maior" required>
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
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" ></script>
    <script>
        $('#price').mask('0000000,00', {reverse: true});
    </script>
@endsection
