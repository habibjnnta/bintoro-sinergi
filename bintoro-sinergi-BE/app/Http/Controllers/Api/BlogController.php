<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JWTAuth;
use Auth;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::all();
        return response()->json([
            'success' => true,    
            'data'   => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'category_id'   => 'required|numeric',
            'resume'        => 'required',
            'image'         => 'required',
            'description'   => 'required',
            'status'        => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(!Category::find($request->category_id)){
            return response()->json([
                'success' => false,
                'message' => "Category tidak di temukan !!"
            ]);
        }

        $user = JWTAuth::parseToken()->authenticate();

        $data = Blog::create([
            'id' => Str::uuid(),
            'title' => $request->title,
            'category_id' => $request->category_id,
            'resume' => $request->resume,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => $user->id,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Blog::where('id',$id)->first();
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'category_id'   => 'required|numeric',
            'resume'        => 'required',
            'description'   => 'required',
            'status'        => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if(!Category::find($request->category_id)){
            return response()->json([
                'success' => false,
                'message' => "Category tidak di temukan !!"
            ]);
        }

        if($request->image){
            Blog::where('id',$id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'resume' => $request->resume,
                'description' => $request->description,
                'image' => $request->image,
                'status' => $request->status,
                'updated_at' => Carbon::now()
            ]);

        }else{
            Blog::where('id',$id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'resume' => $request->resume,
                'description' => $request->description,
                'status' => $request->status,
                'updated_at' => Carbon::now()
            ]);

        }

        return response()->json([
            'success' => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::where('id',$id)->delete();
        return response()->json([
            'success' => true
        ], 200);
    }

    public function upload_foto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $file = $request->file('image');
        $image_name = Str::uuid();
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'image/'; 
        $image_url = $upload_path.$image_full_name;
        $success = $file->move($upload_path,$image_full_name);

        if($success){
            return $image_full_name;
        }else{
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function list(Request $request)
    {
        $data = Blog::where('status','1')->get();
        return response()->json([
            'success' => true,    
            'data'   => $data
        ], 200);
    }
}
