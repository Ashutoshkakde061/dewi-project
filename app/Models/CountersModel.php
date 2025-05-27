<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountersModel extends Model
{
    use HasFactory;
    protected $table = 'counters';
    protected $primaryKey = 'counter_id';
    protected $fillable = [
        'image',
        'title',
        'count',
    ];
    public $timestamps = true;
  
}
