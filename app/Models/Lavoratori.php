<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Lavoratori extends Model
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

    // Crittografa la password quando viene settata
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
