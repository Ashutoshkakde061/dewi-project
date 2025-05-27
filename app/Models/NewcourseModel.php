<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewcourseModel extends Model
{
    use HasFactory;
    protected $table = 'newcourse';
    protected $primaryKey = 'newcourse_id';
    protected $fillable = [
        'course',
        'days',
        'price',
    ];  
 public $timestamps = true;


public function Dayprice()
{
    return $this->hasMany(NewcoursedetailsModel::class, 'newcourse_id', 'newcourse_id');

}



}