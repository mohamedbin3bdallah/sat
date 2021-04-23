<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\News;
use Auth;

class NewsController extends Controller
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
      $data = News::all();
      return view('admin/news' , array('alldata'=>$data));
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
        'title' => 'Title',
        'description' => 'Description',
        'image' => 'Image',
		'file' => 'File',
      );
	  
	  $validator = Validator::make($request->all(), [
			'title' => 'required|max:50|unique:news',
			'description' => 'required',
			//'image' => 'required|image|mimes:png|size:2048|dimensions:width=754,height=361',
			//'image' => 'required|mimes:png|dimensions:width=750,height=360',
			//'file' => 'required|mimes:pdf',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/news')
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

      $fileName = null;
      if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/news/', $fileName);
      }
	  
	  $pdfName = null;
	  if (request()->hasFile('file')) {
        $pdf = request()->file('file');
        $pdfName = md5($pdf->getClientOriginalName() . time()) . "." . $pdf->getClientOriginalExtension();
        $pdf->move('./uploads/news/', $pdfName);
      }

      $add = new News();
      $add->title = request('title');
      $add->description = request('description');
      $add->image = $fileName;
	  $add->pdf = $pdfName;
      $add->save();
      return redirect('admin/news')->with(array('modal'=>'myModal','success'=>'Saved Successfully'));
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
        'title' => 'Title',
        'description' => 'Description',
		'oldimg' => 'Old Image',
        'image' => 'Image',
		'oldpdf' => 'Old File',
		'file' => 'File',
      );
	  
	  $validator = Validator::make($request->all(), [
			'title' => 'required|max:50|unique:news,id,'.$id,
			'description' => 'required',
			//'oldimg' => 'required',
			//'image' => 'image|mimes:png|size:2048|dimensions:width=754,height=361',
			'image' => 'mimes:png|dimensions:width=750,height=360',
			//'oldpdf' => 'required',
			'file' => 'mimes:pdf',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/news')
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

      $add = News::find($id);
      if (request()->hasFile('image')) {
        $file = request()->file('image');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('./uploads/news/', $fileName);
        unlink('./uploads/news/'.request('oldimg'));
        $add->image = $fileName;
      }
	  if (request()->hasFile('file')) {
        $pdf = request()->file('file');
        $pdfName = md5($pdf->getClientOriginalName() . time()) . "." . $pdf->getClientOriginalExtension();
        $pdf->move('./uploads/news/', $pdfName);
        unlink('./uploads/news/'.request('oldpdf'));
        $add->pdf = $pdfName;
      }

      $add->title = request('title');
      $add->description = request('description');
      $add->save();
      return redirect('admin/news')->with(array('modal'=>'myModal'.$id,'success'=>'Saved Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = News::find($id);
		if($data->id)
		{
			if(file_exists('./uploads/news/'.$data->pdf)) unlink('./uploads/news/'.$data->pdf);
			if(file_exists('./uploads/news/'.$data->image)) unlink('./uploads/news/'.$data->image);
			$data->delete();
		}
		return back()->with(array('del_success'=>'Saved Successfully'));
    }
}
