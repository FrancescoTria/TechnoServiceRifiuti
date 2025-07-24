<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_indirizzo
 * @property string $nome_indirizzo
 * @property string|null $civico
 * @property string|null $CAP
 */
class Indirizzi extends Model
{
    use HasFactory;

    protected $table = 'indirizzi';
    protected $primaryKey = 'id_indirizzo';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'tipo_indirizzo',
        'nome_indirizzo',
        'civico',
        'CAP',
    ];
}