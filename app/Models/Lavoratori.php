<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * @property int $id_lavoratore
 * @property string $password
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property int $admin
 */
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
