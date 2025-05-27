<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountersModel;
use DataTables;
use Illuminate\Support\Facades\File;

class CountersController extends Controller
{
    public function Counters(Request $request){

       
{

        if ($request->ajax()) {
            $data = CountersModel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-counters', ['counter_id' => $row->counter_id]);
                    $deleteUrl = route('delete-counters', ['counter_id' => $row->counter_id]);
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

        $counters = CountersModel::latest()->first();
        return view('Admin/counters/counters', compact('counters'));

    }
}


public function getcounters_api()
{
    $getcounters = CountersModel::latest::get();
    return response()-> json ([
        'countersdata' =>$getcounters,
    ]);
    
}


public function create_counters_api(Request $request)
{
    $validated = $request->validate([
        'image' => 'required|image|mimes:jpg,svg,jpeg,png,gif|max:1024', // Max 1MB (1000KB)',
        'title' => 'required',
        'count' => 'required'
    ]);
    $path = 'admin-assets/assets/img/';
    $directory = 'countersimg'; // Define folder name
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
        'count' => $request->count,
    ];
    CountersModel::create($data);
    return redirect('admin/counters')->with('success', 'counters added successfully');
    $data = save();
}




    public function Addcounters(){
        return view('admin/counters/add');
    }

      public function Addstorecounters(Request $request){
        $validated = $request -> validate([
            'image' =>'required',
            'title' =>'required',
            'count' =>'required',
          
        ]);
         $path = 'admin-assets/assets/img/';
        $directory = 'countersimg'; // Define folder name
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
            'count' => $request->count,
           
            
            
           
            
        ];

     
        CountersModel::create($data);
        return redirect('admin/counters')->with('success', 'counters added successfully');
    
         $data=save();
    
    }

    public function Editcounters($counter_id){
        $data = CountersModel::find($counter_id);
        return view('admin/counters/edit', compact('data'));
        
    }


public function Editstorecounters(Request $request, $counter_id){
        $validated = $request -> validate([
            'image' => 'required|image|mimes:jpg,svg,jpeg,png,gif|max:1024', // Max 1MB (1000KB)',
            'title' =>'required',
            'count'=>'required'
        ]);


        $data = CountersModel::find($counter_id);


        $data->title = $request->title;
        $data->count = $request->count;
        



        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/counters/';
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
         return redirect('admin/counters');
    }


    
     public function Deletecounters($counter_id)
    {
        $data = CountersModel::findOrFail($counter_id);
        $data->delete();
        return redirect('admin/counters');
    }
}











