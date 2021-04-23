<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\User;
use Auth;

class CompaniesController extends Controller
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
      $data = Company::all();
      return view('admin/companies' , array('alldata'=>$data));
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
        'code' => 'Code',
        'name' => 'Name',
      );

		$validator = Validator::make($request->all(), [
            'code' => 'required|max:50|unique:companies',
			'name' => 'required|max:100',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/companies')
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

      $add = new Company();
      $add->code = request('code');
      $add->name = request('name');
      $add->save();
      return redirect('admin/companies')->with(array('modal'=>'myModal','success'=>'Saved Successfully'));
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
        'code' => 'Code',
        'name' => 'Name',
      );
	  
	  $validator = Validator::make($request->all(), [
            'code' => 'required|max:50|unique:companies,id,'.$id,
			'name' => 'required|max:100',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/companies')
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

      $edit = Company::find($id);
      $edit->code = request('code');
      $edit->name = request('name');
      $edit->save();

      return redirect('admin/companies')->with(array('modal'=>'myModal'.$id,'success'=>'Saved Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Company::find($id);
		if($data->id)
		{
			$users = User::where('company_id',$id);
			if($users->count()) return back()->with(array('del_fail'=>'There are some Users in this Company'));
			else
			{
				$data->delete();
				return back()->with(array('del_success'=>'Deleted Successfully'));
			}
		}
		else return back()->with(array('del_fail'=>'There is no Company'));
    }
}
