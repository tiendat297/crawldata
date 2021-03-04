<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    protected $table = 'courses';
    protected $fillable = ['id', 'name',  'price_sale', 'images', 'price_root'];
    public $timestams = false;
}
