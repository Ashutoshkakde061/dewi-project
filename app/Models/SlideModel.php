<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideModel extends Model
{
    use HasFactory;
    protected $table = 'slide';
    protected $primaryKey = 'slide_id';
    protected $fillable = [
        'image',
        'title',
        'description',
    ];
    public $timestamps = true;
}