<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurservicesModel;
use DataTables;
use Illuminate\Support\Facades\File;

class OurservicesController extends Controller
{
    public function Ourservices(Request $request){

       
{

        if ($request->ajax()) {
            $data = OurservicesModel::latest()->get();
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-ourservices', ['ourservices_id' => $row->ourservices_id]);
                    $deleteUrl = route('delete-ourservices', ['ourservices_id' => $row->ourservices_id]);
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
        return view('Admin/our-services/ourservices');

    }
}


  

    public function Addourservices(){
        return view('admin/our-services/add');
    }

      public function Addstoreourservices(Request $request){
        $validated = $request -> validate([
            'img' =>'required',
            'title' =>'required',
            'description' =>'required',
          
        ]);
         $path = 'admin-assets/assets/img/';
        $directory = 'ourservicesimg'; // Define folder name
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

     
        OurservicesModel::create($data);
        return redirect('admin/ourservices')->with('success', 'ourservices added successfully');
    
         $data=save();
    
    }

    public function Editourservices($ourservices_id){
        $data = OurservicesModel::find($ourservices_id);
        return view('admin/our-services/edit', compact('data'));
        
    }


public function Editstoreourservices(Request $request, $ourservices_id){
        $validated = $request -> validate([
            'img' => 'required|image|mimes:jpg,svg,jpeg,png,gif|max:1024', // Max 1MB (1000KB)',
            'title' =>'required',
            'description'=>'required'
        ]);


        $data = OurservicesModel::find($ourservices_id);


        $data->title = $request->title;
        $data->description = $request->description;
        



        if ($request->hasFile('img')) {
            $path = 'admin-assets/assets/img/ourservices/';
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
         return redirect('admin/ourservices');
    }


    
     public function Deleteourservices($ourservices_id)
    {
        $data = OurservicesModel::findOrFail($ourservices_id);
        $data->delete();
        return redirect('admin/ourservices');
    }
}











