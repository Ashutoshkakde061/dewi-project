<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialModel extends Model
{
    use HasFactory;
    protected $table = 'testimonial';
    protected $primaryKey = 'testimonial_id';
    protected $fillable = [
        'title',
        'image',
        'description',
    ];
    public $timestamps = true;
}
