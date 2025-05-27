<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewcourseModel;

use DataTables;
use Illuminate\Support\Facades\File;

class NewcourseController extends Controller
{
    public function Newcourse(Request $request){

       
{

        if ($request->ajax()) {
            $data = NewcourseModel::latest()->get();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-newcourse', ['newcourse_id' => $row->newcourse_id]);
                    $deleteUrl = route('delete-newcourse', ['newcourse_id' => $row->newcourse_id]);
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
                ->addColumn('img', function ($row) {
                    $imageUrl = asset($row->img); // Safe joining
                    // dd($imageUrl);
                    return '<img src="' . $imageUrl . '" alt="Image" style="width: 120px; height: 120px;" class="img-fluid rounded">';
                })
                ->rawColumns(['action','img'])
                ->make(true);
        }

        // $ourservices = OurservicesModel::latest()->first();
        return view('Admin/newcourse/newcourse');

    }
}


  

    public function Addnewcourse(){
        return view('admin/newcourse/add');
    }

      public function Addstorenewcourse(Request $request){
        $validated = $request -> validate([
            'img' =>'required',
            'title' =>'required',
            'description' =>'required',
          
        ]);
         $path = 'admin-assets/assets/img/';
        $directory = 'newcourseimg'; // Define folder name
        $path = public_path($directory); 
        
        // Ensure the directory exists
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        
        // Move file to public/couterimg/
        $file->move($path, $filename);
        
        // Store relative path for database
        $imagePath = "$directory/$filename";


        $data = [
            'img' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
           
            
            
           
            
        ];

     
        NewcourseModel::create($data);
        return redirect('admin/newcourse')->with('success', 'services added successfully');
    
         $data=save();
    
    }

    public function Editnewcourse($newcourse_id){
        $data = NewcourseModel::find($newcourse_id);
        return view('admin/newcourse/edit', compact('data'));
        
    }


public function Editstorenewcourse(Request $request, $services_id){
        $validated = $request -> validate([
            'img' => 'required|image|mimes:jpg,svg,jpeg,png,gif|max:1024', // Max 1MB (1000KB)',
            'title' =>'required',
            'description'=>'required'
        ]);


        $data = NewcourseModel::find($services_idnewcourse_id);


        $data->title = $request->title;
        $data->description = $request->description;
        



        if ($request->hasFile('img')) {
            $path = 'admin-assets/assets/img/services/';
            if (File::exists(public_path($data->img))) {
                File::delete(public_path($data->img)); // Delete old image
            }
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path($path), $filename);
            $data->img = $path . $filename;
        }

        $data->save();
         return redirect('admin/newcourse');
    }


    
     public function Deletenewcourse($newcourse_id)
    {
        $data = NewcourseModel::findOrFail($newcourse_id);
        $data->delete();
        return redirect('admin/newcourse');
    }
}











