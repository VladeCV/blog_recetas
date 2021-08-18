@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('botones')
    <a  href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white"> Volver</a>   
@endsection

@section('content')
    <h2 class="text-center mb-5">Editar Receta</h2>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <form method="post" action="{{route('recetas.update',['receta'=>$receta->id])}}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input type="text" name="titulo" id="titulo" class="form-control @error ('titulo') is-invalid @enderror" 
                    placeholder="Titulo Receta" value="{{$receta->titulo}}">
                @error('titulo')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria" class="form-control @error ('categoria') is-invalid @enderror">
                        <option value="">-- Seleccione -</option>
                        @foreach ($categorias as $categoria)
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ $receta->categoria_id == $categoria->id ? 'selected' : '' }} 
                            >{{$categoria->nombre}}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mt-1">
                    <label for="preparacion">Preparacion</label>
                    <input id="preparacion" type="hidden" name="preparacion" value="{{$receta->preparacion}}">
                    <trix-editor input="preparacion" style="overflow-y:auto;" class="form-control @error ('preparacion') is-invalid @enderror"></trix-editor>
                     @error('preparacion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mt-1">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{$receta->ingredientes}}">
                    <trix-editor input="ingredientes" style="overflow-y:auto;" class="form-control @error ('ingredientes') is-invalid @enderror"></trix-editor>
                    @error('ingredientes')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class=" form-group mt-1">
                    <label for="imagen">Elige la imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control @error ('imagen') is-invalid @enderror">
                    <div class="mt-3">
                      <p>Imagen Actual:</p>
                      <img src="/storage/{{$receta->imagen}}" style="width: 300px">
                    </div>
                    @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>
                </div>
            </form>
        </div>
    </div>
@push('other-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer></script>
@endpush
@endsection
