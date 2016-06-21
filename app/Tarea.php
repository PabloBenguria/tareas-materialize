<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Tarea extends Model
{
  protected $table = 'tareas';
  protected $fillable = ['texto', 'autor_id'];

  public function users(){
    return $this->belongsToMany('App\User');
  }

  public function scopeType($query, $estado) {
    $estados = config('options.types');
    if($estado != '' && isset($estados[$estado])) {
      $query->where('estado', $estado);
    }
  }

  public static function filterType($estado) {
    return Tarea::type($estado)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
  }

}
