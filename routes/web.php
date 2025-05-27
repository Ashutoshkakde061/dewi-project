<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CountersController;
use App\Http\Controllers\Admin\OurservicesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\NewcourseController;

// use App\Http\Controllers\Admin\CourseController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(HomeController::class)->group(function(){
 Route::get('/','Index')->name('index');
});

Route::controller(DashboardController::class)->group(function(){
    Route::get('admin/dashboard','Dashboard')->name('dashboard');
    Route::post('logout','Logout')->name('logout');
});



Route::controller(AuthController::class)->group(function(){
    Route::get('admin','Admin')->name('admin');
    Route::post('admin-login','Login')->name('admin-login');
    Route::get('register','Register_view')->name('register');
    Route::post('register','Register')->name('register');

   
}); 



Route::controller(CountersController::class)->group(function(){
 Route::get('admin/counters','Counters')->name('counters');
 Route::get('admin/add-counters', 'Addcounters')->name('add-counters');
 Route::post('admin/add-store-counters', 'Addstorecounters')->name('add-store-counters');
 Route::get('admin/edit-counters/{counter_id}', 'Editcounters')->name('edit-counters');
 Route::post('admin/edit-store-counters/{counter_id}', 'Editstorecounters')->name('edit-store-counters');
 Route::get('admin/delete-counters/{counter_id}', 'Deletecounters')->name('delete-counters');
     
});



Route::controller(OurservicesController::class)->prefix('admin')->group(function () {
    Route::get('ourservices', 'Ourservices')->name('ourservices');
    Route::get('add-ourservices', 'Addourservices')->name('add-ourservices');
    Route::post('add-store-ourservices', 'Addstoreourservices')->name('add-store-ourservices');
    Route::get('edit-ourservices/{ourservices_id}', 'Editourservices')->name('edit-ourservices');
    Route::post('edit-store-ourservices/{ourservices_id}', 'Editstoreourservices')->name('edit-store-ourservices');
    Route::get('delete-ourservices/{ourservices_id}', 'Deleteourservices')->name('delete-ourservices');
});


Route::controller(ServicesController::class)->prefix('admin')->group(function () {
    Route::get('services', 'Services')->name('services');
    Route::get('add-services', 'Addservices')->name('add-services');
    Route::post('add-store-services', 'Addstoreservices')->name('add-store-services');
    Route::get('edit-services/{services_id}', 'Editservices')->name('edit-services');
    Route::post('edit-store-services/{services_id}', 'Editstoreservices')->name('edit-store-services');
    Route::get('admin/delete-services/{services_id}', 'Deleteservices')->name('delete-services');
  
});




Route::controller(SlideController::class)->prefix('admin')->group(function () {
    Route::get('slide', 'Slide')->name('slide');
    Route::get('add-slide', 'Addslide')->name('add-slide');
    Route::post('add-store-slide', 'Addstoreslide')->name('add-store-slide');
    Route::get('edit-slide/{slide_id}', 'Editslide')->name('edit-slide');
    Route::post('edit-store-slide/{slide_id}', 'Editstoreslide')->name('edit-store-slide');
    Route::get('admin/delete-slide/{slide_id}', 'Deleteslide')->name('delete-slide');
    // Route::get('add-services', 'Addservices')->name('add-services');
    // Route::post('add-store-services', 'Addstoreservices')->name('add-store-services');
    // Route::get('edit-services/{services_id}', 'Editservices')->name('edit-services');
    // Route::post('edit-store-services/{services_id}', 'Editstoreservices')->name('edit-store-services');
    // Route::get('admin/delete-services/{services_id}', 'Deleteservices')->name('delete-services');
  
});




Route::controller(TestimonialController::class)->group(function(){
 Route::get('admin/testimonial','Testimonial')->name('testimonial');
    Route::get('admin/add-testimonial', 'Addtestimonial')->name('add-testimonial');
    Route::post('admin/add-store-testimonial', 'Addstoretestinominal')->name('add-store-testimonial');



});

// Route::controller(CourseController::class)->group(function(){
//     Route::get('admin/course','Course')->name('course');
//     Route::get('admin/add-course', 'Addcourse')->name('add-course');
//     Route::post('admin/add-store-course, ', 'Addstorecourse')->name('add-store-course');
// });


Route::controller(NewcourseController::class)->group(function(){
 Route::get('admin/newcourse','Newcourse')->name('newcourse');
 Route::get('admin/add-newcourse', 'Addnewcourse')->name('add-newcourse');
    Route::post('admin/add-store-newcourse', 'Addstorenewcourse')->name('add-store-newcourse');
    Route::get('admin/view-newcourse/{newcourse_id}', 'Viewnewcourse')->name('view-newcourse');
    // Route::get('admin/delete-viewnewcourse/{newcourse_id}', 'Deleteviewnewcourse')->name('delete-viewnewcourse');
    Route::delete('/admin/delete-viewnewcourse/{newcourse_id}', [NewcourseController::class, 'Deleteviewnewcourse'])->name('delete-viewnewcourse');

    // Route::get('admin/edit-newcourse/{newcourse_id}', 'Editnewcourse')->name('edit-newcourse');
    // Route::post('admin/edit-storenewcourse/{newcourse_id}', 'Editstorenewcourse')->name('edit-storenewcourse');

    Route::get('admin/edit-newcourse/{newcourse_id}', [NewcourseController::class, 'Editnewcourse'])->name('edit-newcourse');
    Route::post('admin/edit-storenewcourse/{newcourse_id}', [NewcourseController::class, 'Editstorenewcourse'])->name('edit-storenewcourse');
    Route::get('admin/delete-newcourse/{newcourse_id}', 'Deletenewcourse')->name('delete-newcourse');


});
