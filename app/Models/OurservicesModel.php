<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurservicesModel extends Model
{
    use HasFactory;
     protected $table = 'ourservices';
    protected $primaryKey = 'ourservices_id';
    protected $fillable = [
        'img',
        'title',
        'description',
    ];
    public $timestamps = true;
  
}
