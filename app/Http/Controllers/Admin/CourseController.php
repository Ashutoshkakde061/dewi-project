<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\CourseModel;

// class CourseController extends Controller
// {
//     public function Course(){
//         return view('Admin/course/course');
//     }

//     public function Addcourse(){
//         return view('Admin/course/add');
//     }
//  public function Addstorecourse(Request $request)
// {
//    dd($request);
//     $validated = $request->validate([
//         'course_name' => 'required|string|max:255',
//         'course_duration' => 'required|array|min:1',
//         'course_duration.*' => 'required|numeric|min:1',
//         'course_price' => 'required|array|min:1',
//         'course_price.*' => 'required|numeric|min:0',
//     ]);

//     // Loop through each duration and price to save them
//     foreach ($request->course_duration as $index => $duration) {
//         CourseModel::create([
//             // 'course' => $request->course_name,
//             'days' => $duration,
//             'price' => $request->course_price[$index] ?? 0,
//         ]);
//     }

//     // Redirect to the course list page with a success message
//     return redirect()->route('admin/course')->with('success', 'Course(s) added successfully.');
// }


// }
