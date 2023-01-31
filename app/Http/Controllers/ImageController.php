<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\DocumentImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImage()
    {
        return view('resizeImage');
    }
  
    public function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
    
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        return $output_file; 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();
     
        $destinationPath = public_path('/thumbnail');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
   
        return back()
            ->with('success','Image Upload successful')
            ->with('imageName',$input['imagename']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImageURL($path="")
    {
        if($path == "") return "";
        $filename = basename($path);

        Image::make($path)->save(public_path('/images' . $filename));
     
        $destinationPath = public_path('/thumbnail');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
   
        return back()
            ->with('success','Image Upload successful')
            ->with('imageName',$input['imagename']);
    }

    public function uploadImage(Request $request)
    {
        
        $imageFile = $request->file('file');
        $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
        
        if(!Storage::exists('/uploads/users'.Auth::id().'/temp')) {

            Storage::makeDirectory('/uploads/users/'.Auth::id().'/temp', 0775, true); //creates directory
        
        }
        $path = $request->file('file')->storeAs('/uploads/users/'.Auth::id().'/temp', $new_name, 'public');
        return response()->json(["status" => "success", "data" => asset('storage/'.$path)]);
    }

    public function uploadImages(Request $request)
    {
        
        $imageFiles = $request->file('file');
        $urls = array();
        foreach ($imageFiles as $key => $imageFile) {
            $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
            
            if(!Storage::exists('/uploads/users'.Auth::id().'/temp')) {

                Storage::makeDirectory('/uploads/users/'.Auth::id().'/temp', 0775, true); //creates directory
            
            }
            $uploadUrl = $imageFile->storeAs('/uploads/users/'.Auth::id().'/temp', $new_name, 'public');
            $urls[] = asset('storage/'.$uploadUrl);
        }
        
        return response()->json(["status" => "success", "data" => $urls]);
    }

    public function deleteImage(Request $request)
    {
        $imageFile = $request->get('file');
        Storage::delete($imageFile);
        //$path = $request->file('file')->storeAs('uploads/document_images', $new_name, 'public');
        
        return response()->json(["status" => "success", "data" => asset($imageFile)]);
    }
}
