<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo',
        'preparacion',
        'ingredientes',
        'imagen',
        'categoria_id'
    ];
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }

    public function autor(){
        return $this->belongsTo(User::class,'user_id');
    }
}
