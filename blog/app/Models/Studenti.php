<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studenti extends Model
{
    use HasFactory;

    protected $guarded=[];
    public $table = 'studenti';
}
