<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewcoursedetailsModel extends Model
{
    use HasFactory;
    protected $table = 'newcoursedetails';
    protected $primaryKey = 'newcoursedetails_id';
    protected $fillable = [
        'newcourse_id',
        'days',
        'price',
        'newcoursedetails_id',
    ];

    public function newcourse(){
        return $this->belongsTo(NewcourseModel::class, 'newcourse_id', 'newcourse_id');
    }

   
}
