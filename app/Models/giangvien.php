<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class giangvien extends Model
{
    protected $table = 'giangvien';
    protected $fillable = ['hoten', 'images',  'description'];
    public $timestams = false;
}
