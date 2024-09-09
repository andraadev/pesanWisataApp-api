<?php

namespace App\Http\Controllers;

use App\Http\Resources\DestinationResource;
use Illuminate\Http\Request;
use App\Models\destination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;

class destinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all posts
        $destination = destination::all();

        //return collection of posts as a resource
        return new DestinationResource(true, 'List Data Destination', $destination);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
  
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'location'     => 'required',
            'description'   => 'nullable',
            'image_url'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image_url');
        $image->storeAs('public/destinations_image', $image->hashName());

        //create post
        $destination = destination::create([
            'name'     => $request->name,
            'slug' => $request->slug,
            'location'   => $request->location,
            'description' => $request->description,
            'image_url'     => $image->hashName(),
        ]);

        //return response
        return new DestinationResource(true, 'Data Destinasi Berhasil Ditambahkan!', $destination);
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
                //find destination by slug
                $destination = destination::where('slug',$slug)->first();
                if ($destination) {
                    return response()->json([
                        'success'=> false,
                        'message' => 'destinasi tidak ditemukan'
                    ], 404);
                }
                //return single post as a resource
                return new DestinationResource(true, 'Data Destinasi', $destination);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'      => 'required|min:5',
            'location'  => 'required',
            'description' => 'nullable',
        ]);
    

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //get destination by id
        $destination = destination::find($id);

        //check if image is not empty
        if ($request->hasFile('image_url')) {
            //upload image
            $image = $request->file('image_url');
            $image->storeAs('public/destinations_image', $image->hashName());

            //delete old image
            Storage::delete('public/destinations_image/' .basename($destination->image_url));

            //update destination data with new image
            $destination->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'location' => $request->location,
                'description' => $request->description,
                'image_url' => $image->hashName(),
            ]);

        } else {
            //update destination data without image
            $destination->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'location' => $request->location,
                'description' => $request->description,
            ]);
        }
        return new DestinationResource(true, 'Data destinasi berhasil diubah', $destination);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find post by ID
        $destination = destination::find($id);

        //delete image
        Storage::delete('public/destinations_image/'.basename($destination->image_url));

        //delete post
        $destination->delete();

        //return response
        return new DestinationResource(true, 'Data Destinasi Berhasil Dihapus!', null);
    }
}