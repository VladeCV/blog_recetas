@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('botones')
    <a  href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 font-weight-bold"> Volver</a>   
@endsection

@section('content')
<h2 class="text-center mb-5">Editar Perfil</h2>
 <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
          <form action="{{route('perfiles.update',['perfil'=>$perfil->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" 
                name="nombre" 
                id="nombre" 
                class="form-control 
                @error ('nombre') is-invalid @enderror"
                value="{{$perfil->usuario->name}}"> 
                    
              @error('nombre')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{$message}}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="url">Sitio Web</label>
              <input type="text" 
                name="url" 
                id="url" 
                class="form-control 
                @error ('url') is-invalid @enderror"
                value="{{$perfil->usuario->url}}"> 
                    
              @error('url')
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{$message}}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group mt-1">
                    <label for="biografia">Biografia</label>
                    <input id="biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}">
                    <trix-editor input="biografia" style="overflow-y:auto;" class="form-control @error ('biografia') is-invalid @enderror"></trix-editor>
                     @error('biografia')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
            </div>

            <div class=" form-group mt-1">
                    <label for="imagen">Tu imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control @error ('imagen') is-invalid @enderror">
                    @if ($perfil->imagen)
                      
                      <div class="mt-3">
                        <p>Imagen Actual:</p>
                        
                      </div>
                      @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                          <strong>{{$message}}</strong>
                        </span>
                      @enderror
                        
                    @endif
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
           </div>
          </form>
        </div>
 </div>

@push('other-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer></script>
@endpush

@endsection