<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riesenia extends Model
{
    use HasFactory;

    protected $guarded=[];            //nepusti upravit, ak je nastavene ktore, teraz sa daju vsetky menit
    public $table = 'riesenia';



    public function student() {
        return $this->belongsTo(Studenti::class);
    }



}
