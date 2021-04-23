<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Doctype;
use App\Document;
use App\Service;
use Auth;

class DocumentsController extends Controller
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
				$this->flag = array('product'=>1,'solution'=>2);
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
      //
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
        'doctype' => 'Document Type',
		'document' => 'Title',
        'file' => 'File',
      );
	  
	  	$validator = Validator::make($request->all(), [
			'doctype' => 'required',
			'document' => 'required|max:50',
			'file' => 'required|mimes:pdf',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

      $fileName = null;
      if (request()->hasFile('file')) {
        $file = request()->file('file');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
		//$fileName = $file->getClientOriginalName();
        $file->move('./uploads/documents/', $fileName);
      }
	  
	  $srvs = Service::where('title', request('title'))->get();
	  foreach($srvs as $srv)
	  {
		$add = new Document;
		$add->document_name = $fileName;
		$add->title = request('document');
		$add->product_service_id = $srv->id;
		$add->document_type_id = request('doctype');
		$add->save();
	  }
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
        'doctype' => 'Document Type',
		'document' => 'Title',
        'file' => 'File',
      );
	  
	  	$validator = Validator::make($request->all(), [
			'doctype' => 'required',
			'document' => 'required|max:50',
			'file' => 'mimes:pdf',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal-'.$id));
          }

      $fileName = null;
      if (request()->hasFile('file')) {
        $file = request()->file('file');
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
		//$fileName = $file->getClientOriginalName();
        $file->move('./uploads/documents/', $fileName);
		$add_doc = Document::where('document_name',request('oldfile'))->update(['document_name'=>$fileName,'document_type_id'=>request('doctype')]);
        unlink('./uploads/documents/'.request('oldfile'));
      }
	  else $add_doc = Document::where('document_name',request('oldfile'))->update(['document_type_id'=>request('doctype'),'title'=>request('document')]);

      return back()->with(array('modal'=>'myModal-'.$id,'success'=>'Saved Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Document::find($id);
		if($data->id)
		{
			unlink('./uploads/documents/'.$data->document_name);
			$data->delete();
		}
		return back()->with(array('success'=>'Saved Successfully'));
    }
}
