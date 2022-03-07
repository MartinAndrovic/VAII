<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulohy extends Model
{
    use HasFactory;

    protected $guarded=[];            //nepusti upravit, ak je nastavene ktore, teraz sa daju vsetky menit
    public $table = 'ulohy';



    public function zadanie() {
        return $this->belongsTo(Zadania::class);
    }
}
