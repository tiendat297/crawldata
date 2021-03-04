<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cell extends Model
{
    protected $table = 'cell';
    protected $fillable = ['name', 'gia_sale',  'gia_croot'];
    public $timestams = false;
}
