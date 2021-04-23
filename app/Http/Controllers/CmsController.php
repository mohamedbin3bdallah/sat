<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cms;
use Auth;

class CmsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->middleware('auth');
		$this->middleware(function ($request, $next) {
			$this->user = Auth::user();
			if($this->user->role != 'admin') return redirect('web/404');
			else 
			{
				return $next($request);
			}
		});
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Cms::all();
      return view('admin/cms' , array('alldata'=>$data));
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
		$attrs = array(
		'section' => 'Section',
		'title' => 'Title',
        'content' => 'Content',
      );
	  
	  $validator = Validator::make($request->all(), [
			'section' => 'required',
			'title' => 'required|max:50',
			'content' => 'required',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

      $add = new Cms;
      if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/', $fileName);
        $add->image = $fileName;
      }

      $add->title = request('title');
	  $add->content = request('content');
	  $add->section = request('section');
	  $add->page_flag = 1;
      $add->save();
      return back()->with(array('modal'=>'myModal','success'=>'Saved Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      $attrs = array(
        'content' => 'Content',
      );
	  
	  $validator = Validator::make($request->all(), [
			'content' => 'required',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

      $add = Cms::find($id);
	  $fileName = request('oldimg');
      if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/', $fileName);
        if(request('oldimg')) unlink('./uploads/'.request('oldimg'));
        $add->image = $fileName;
      }

      $add->title = request('title');
	  $add->content = request('content');
	  $add->image = $fileName;
      $add->save();
      return back()->with(array('modal'=>'myModal'.$id,'success'=>'Saved Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Cms::find($id);
		if($data->id)
		{
			if($data->image) unlink('./uploads/'.$data->image);
			$data->delete();
		}
		return back()->with(array('success'=>'Saved Successfully'));
    }
}
