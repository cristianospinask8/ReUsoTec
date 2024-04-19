<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntos extends Model
{
    use HasFactory;


    protected $table = 'puntos_vivedigital';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'direccion',
        'sector',
        'code',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

}
