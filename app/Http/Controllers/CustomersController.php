<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\User;
use Auth;

class CustomersController extends Controller
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
      $data = User::whereIn('role', array('user'))->get();
      $companies = Company::all();
      return view('admin/customers' , array('alldata'=>$data, 'companies'=>$companies));
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
      //
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
		'name' => 'Name',
		'email' => 'Email',
		'phone' => 'Phone',
        //'company' => 'Company',
		'code' => 'Code',
		'password' => 'Password',
      );
	  
      $validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255|unique:users,name,'.$id,
			'email' => 'required|string|email|max:255|unique:users,email,'.$id,
			'phone' => 'required|numeric|unique:users,phone,'.$id,
			//'company' => 'required',
			'code' => 'required|numeric|max:999999999|unique:users,code,'.$id,
			'password' => 'nullable|min:8',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

      $edit = User::find($id);
	  if(request('password')!='' and strlen(request('password')) >= 8) $edit->password = bcrypt(request('password'));
      $edit->name = request('name');
	  $edit->email = request('email');
	  $edit->code = request('code');
	  $edit->phone = request('phone');
	  if(request('company'))
	  {
		$edit->company_name = NULL;
		$edit->company_id = request('company');
	  }
	  elseif(request('company_name'))
	  {
		  $edit->company_name = request('company_name');
		  $edit->company_id = NULL;
	  }
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
        $data = User::find($id);
		if($data->id)
		{
			$data->delete();
			return back()->with(array('del_success'=>'Deleted Successfully'));
		}
		else return back()->with(array('del_fail'=>'There is no User'));
    }
}
