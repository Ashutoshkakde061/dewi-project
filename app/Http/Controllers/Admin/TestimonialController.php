<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestimonialModel;

class TestimonialController extends Controller
{
    public function Testimonial(Request $request){

          if ($request->ajax()) {
            $data = SlideModel::latest()->get();
           
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-slide', ['testimonial_id' => $row->testimonial_id]);
                    $deleteUrl = route('delete-slide', ['testimonial_id' => $row->testimonial_id]);
                    $csrfToken = csrf_token();

                    $actionBtn = '
                    <a href="' . $editUrl . '" class="edit btn btn-success btn-sm">Edit</a>
                     <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . method_field('DELETE') . '
                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                        <a href="' . $deleteUrl . '" class="delete btn btn-danger btn-sm">Delete</a>
                    </form>';
                    return $actionBtn;
                })
                ->addColumn('image', function ($row) {
                    $imageUrl = asset($row->image); // Safe joining
                    // dd($imageUrl);
                    return '<img src="' . $imageUrl . '" alt="Image" style="width: 120px; height: 120px;" class="img-fluid rounded">';
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }

        return view('Admin/testimonial/testimonial');
    }

    public function Addtestimonial(){
        return view('Admin/testimonial/add');
    }

    public function Addstoretestinominal(Request $request){

        $validated =request()-> validate([
            'image' =>'required',
            'title' =>'required',
            'description' =>'required',
        ]);
         $path = 'admin-assets/assets/img/';
        $directory = 'slideimg'; // Define folder name
        $path = public_path($directory); 
        
        // Ensure the directory exists
        if (!file_exists($path)) {
            mkdir($path, 0777, true);           
        }
        
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        
        // Move file to public/couterimg/
        $file->move($path, $filename);
        
        // Store relative path for database
        $imagePath = "$directory/$filename";


        $data = [
            'image' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            
        ];
        
        TestimonialModel::create($data);
        return redirect('admin/testimonial')->with('success', 'slide added successfully');
    
    }
}
