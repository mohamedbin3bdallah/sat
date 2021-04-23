<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Doctype;
use App\Document;
use Auth;

class DoctypesController extends Controller
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
      $data = Doctype::all();
      return view('admin/documentstype' , array('alldata'=>$data));
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
        'type_name' => 'Name',
      );
	  
	  $validator = Validator::make($request->all(), [
			'type_name' => 'required|max:50|unique:document_types'
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

      $add = new Doctype();
      $add->type_name = request('type_name');
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
        'type_name' => 'Name',
      );
	  
	  $validator = Validator::make($request->all(), [
			'type_name' => 'required|max:50|unique:document_types,id,'.$id
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

      $edit = Doctype::find($id);
      $edit->type_name = request('type_name');
      $edit->save();

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
        $data = Doctype::find($id);
		if($data->id)
		{
			$documents = Document::where('document_type_id',$id);
			if($documents->count()) return back()->with(array('del_fail'=>'There are some Documents in this Document Type'));
			else
			{
				$data->delete();
				return back()->with(array('del_success'=>'Deleted Successfully'));
			}
		}
		else return back()->with(array('del_fail'=>'There is no Document Type'));
    }
}
