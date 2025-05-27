<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use App\Models\SlideModel;

class SlideController extends Controller
{
      public function Slide(Request $request){
       

         if ($request->ajax()) {
            $data = SlideModel::latest()->get();
           
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-slide', ['slide_id' => $row->slide_id]);
                    $deleteUrl = route('delete-slide', ['slide_id' => $row->slide_id]);
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
         return view('Admin/slide/slide');

    }

    public function AddSlide(){
        return view('Admin/slide/add');
    }

     public function Addstoreslide(Request $request){
        // dd($request->all());
        $validated = $request -> validate([
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
        
        SlideModel::create($data);
        return redirect('admin/slide')->with('success', 'slide added successfully');
    
         
    

    }


    public function Editslide($slide_id){
        $data = SlideModel::find($slide_id);
        return view('admin/slide/edit', compact('data'));
        
    }


public function Editstoreslide(Request $request, $slide_id){
        $validated = $request -> validate([
            'image' => 'required|image|mimes:jpg,svg,jpeg,png,gif,webp|max:5000', // Max 1MB (1000KB)',
            'title' =>'required',
            'description'=>'required'
        ]);


        $data = SlideModel::find($slide_id);


        $data->title = $request->title;
        $data->description = $request->description;
        



        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/ourservices/';
            if (File::exists(public_path($data->image))) {
                File::delete(public_path($data->image)); // Delete old image
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path($path), $filename);
            $data->image = $path . $filename;
        }

        $data->save();
         return redirect('admin/slide');
    }


    
     public function Deleteslide($slide_id)
    {
        $data = SlideModel::findOrFail($slide_id);
        $data->delete();
        return redirect('admin/slide');
    }


}   
