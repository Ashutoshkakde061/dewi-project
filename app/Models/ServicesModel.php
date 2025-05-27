<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
     use HasFactory;
     protected $table = 'services';
    protected $primaryKey = 'services_id';
    protected $fillable = [
        'image',
        'title',
        'description',
    ];
    public $timestamps = true;
}
