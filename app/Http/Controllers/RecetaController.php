<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuario = auth()->user()->id;
        

        $recetas = Receta::where('user_id',$usuario)->paginate(5);
        return view('recetas.index')->with('recetas',$recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');

        $categorias=CategoriaReceta::all(['id','nombre']);

        return view('/recetas/create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'titulo'=>'required',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required|image',
        ]);

        $ruta_imagen=$request['imagen']->store('upload-recetas','public');

        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,500);
        $img->save();

        /*DB::table('recetas')->insert(
            [
                'titulo'=>$data['titulo'],
                'preparacion'=>$data['preparacion'],
                'ingredientes'=>$data['ingredientes'],
                'imagen'=>$ruta_imagen,
                'user_id'=> Auth::user()->id,
                'categoria_id'=>$data['categoria']
            ]
        );*/

        auth()->user()->recetas()->create([
            'titulo'=>$data['titulo'],
            'preparacion'=>$data['preparacion'],
            'ingredientes'=>$data['ingredientes'],
            'imagen'=>$ruta_imagen,
            'categoria_id'=>$data['categoria']
        ]);

        return redirect()->action('App\Http\Controllers\RecetaController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show',compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
         $this->authorize('view',$receta);

        $categorias=CategoriaReceta::all(['id','nombre']);
        return view('recetas.edit',compact('categorias','receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        $this->authorize('update',$receta);

        $data=request()->validate([
            'titulo'=>'required',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required',
        ]);

        $receta->titulo =$data['titulo'];
        $receta->categoria_id =$data['categoria'];
        $receta->preparacion =$data['preparacion'];
        $receta->ingredientes =$data['ingredientes'];

        if (request('imagen')) {
            # code...
            $ruta_imagen=$request['imagen']->store('upload-recetas','public');

            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000,500);
            $img->save();

            $receta->imagen = $ruta_imagen;
        }

        $receta->save();

        return redirect()->action('App\Http\Controllers\RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete',$receta);

        $receta->delete();

        return redirect()->action('App\Http\Controllers\RecetaController@index');
    }
}
