<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zadania extends Model
{
    use HasFactory;

    protected $guarded=[];            //nepusti upravit, ak je nastavene ktore, teraz sa daju vsetky menit
    public $table = 'zadania';



    public function skuska() {
        return $this->belongsTo(Skusky::class);
    }
}
