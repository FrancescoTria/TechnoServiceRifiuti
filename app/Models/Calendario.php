<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;

    protected $table = 'calendario';
    // Se la tabella non ha timestamps, decommenta la riga sotto:
    // public $timestamps = false;
    // protected $fillable = ['colonna1', 'colonna2', ...];
}