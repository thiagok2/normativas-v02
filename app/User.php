<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Documento;
use App\Models\Unidade;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipo','created_at','updated_at', 'cpf'
    ];

    public $timestamps = true;


    public function isAdmin(){
        return $this->tipo == 'admin';
    }

    public function isGestor(){
        return $this->tipo == 'gestor';
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function documentos(){
        return $this->hasMany(Documento::class);
    }

    public function unidade() {
		return $this->belongsTo(Unidade::class,'unidade_id');
    }

    public function firstName(){
        return explode(" ",$this->name)[0];
    }
}
