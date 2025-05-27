<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountersModel;
use App\Models\OurservicesModel;
use App\Models\ServicesModel;
use App\Models\SlideModel;
use App\Models\TestimonialModel;


class HomeController extends Controller
{
   public function Index(){
   
          $counters=CountersModel::latest()->get();
            $ourservices=OurservicesModel::latest()->get();
            $services=ServicesModel::latest()->get();
            $slide=SlideModel::latest()->first  ();
            $testimonial=TestimonialModel::latest()->get();
         return view('index',compact('counters','ourservices','services','slide','testimonial'));
   }
}

