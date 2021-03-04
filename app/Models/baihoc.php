<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baihoc extends Model
{
    protected $table = 'baihoc';
    protected $fillable = ['name', 'sort',  'status','courses_id', 'chapter_id'];
    public $timestams = false;
}
