<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avvisi extends Model
{
    use HasFactory;

    protected $table = 'avvisi';
    protected $primaryKey = 'id_avviso';

    protected $fillable = [
        'categoria',
        'messaggio',
        'data_invio',
        'id_cliente',
        'id_lavoratore',
        'oggetto',
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    public function lavoratore()
    {
        return $this->belongsTo(Lavoratori::class, 'id_lavoratore', 'id_lavoratore');
    }
}