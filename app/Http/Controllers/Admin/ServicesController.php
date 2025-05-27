<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use App\Models\ServicesModel;

class ServicesController extends Controller
{
    public function Services(Request $request){
       

         if ($request->ajax()) {
            $data = ServicesModel::latest()->get();
           
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-services', ['services_id' => $row->services_id]);
                    $deleteUrl = route('delete-services', ['services_id' => $row->services_id]);
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
         return view('Admin/services/services');

    }

public function getservices_api()
    {
        $getservices = ServicesModel::latest()->get();

        return response()->json([
            'servicesdata' => $getservices,
        ]);
    }

public function getservice_api($services_id){
    $getservices =ServicesModel::find($services_id);

    return response()->json([
        'servicesdata' =>'$getservices',
    ]);

}
    // create-services api


    public function create_services_api(Request $request)
        {

            $validated = $request->validate([
                'image' => 'required',
                'title' => 'required',
                'description' => 'required'
            ]);

           $path = 'uploads/';
            $directory = 'servicesimg'; // Define folder name
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
            ServicesModel::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Data added successfully',
                'data' => $data
            ]);


        }

     // edit-services api

public function update_services_api(Request $request, $services_id)
{
   
    $service = ServicesModel::find($services_id);

    
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,'
    ]);

    // Handle new image upload if provided
    if ($request->hasFile('image')) {
        $directory = 'servicesimg';
        $path = public_path($directory);

        
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $filename);

        $service->image = "$directory/$filename"; // Update image path
    }

    // Update other fields
    $service->title = $request->title;
    $service->description = $request->description;
    $service->save();

    return response()->json([
        'success' => 'true',
        'message' => 'Service updated successfully',
        'data' => $service
    ]);
}


     



      public function Addservices(){
        return view('Admin/services/add');
    }

      public function Addstoreservices(Request $request){
        $validated = $request -> validate([
            'image' =>'required',
            'title' =>'required',
            'description' =>'required',
    
        ]);

         $path = 'admin-assets/assets/img/';
        $directory = 'servicesimg'; // Define folder name
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

     
        ServicesModel::create($data);
          
        return redirect('admin/services')->with('success', 'services added successfully');
    

    
    }

    public function Editservices($services_id){
        $data = ServicesModel::find($services_id);
        return view('admin/services/edit', compact('data'));
        
    }


public function Editstoreservices(Request $request, $services_id){
        $validated = $request -> validate([
            'image' => 'required|image|mimes:jpg,svg,jpeg,png,gif,avif,jfif,webp|', // Max 1MB (1000KB)',
            'title' =>'required',
            'description'=>'required'
        ]);


        $data = ServicesModel::find($services_id);


        $data->title = $request->title;
        $data->description = $request->description;
        



        if ($request->hasFile('image')) {
            $path = 'admin-assets/assets/img/services/';
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
         return redirect()-> route('services')->with('success', 'Services updated successfully');

    }

    
     public function Deleteservices($services_id)
    {
        $data = ServicesModel::findOrFail($services_id);
        $data->delete();
        return redirect('admin/services');
    }

       public function Delete_services_api($services_id)
    {
        $data = ServicesModel::findOrFail($services_id);
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully',
            'data' => $data,
        ]);
        
    }



}
 
    













        