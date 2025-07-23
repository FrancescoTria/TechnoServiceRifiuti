<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Lavoratori extends Authenticatable
{
    use HasFactory;

    protected $table = 'lavoratori';
    protected $primaryKey = 'id_lavoratore';

    protected $fillable = [
        'nome',
        'cognome',
        'admin',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    // Crittografa la password quando viene settata
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function lavoratore()
    {
        return $this->belongsTo(Lavoratori::class, 'id_lavoratore');
    }
}
