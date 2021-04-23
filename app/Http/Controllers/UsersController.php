<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;

class UsersController extends Controller
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
      //$data = User::paginate(10);
	  $data = User::find(auth()->user()->id);
      return view('admin/admins' , array('data'=>$data));
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
		'password' => 'Password',
      );
	  
      $validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255|unique:users,name,'.$id,
			'email' => 'required|string|email|max:255|unique:users,email,'.$id,
			'phone' => 'required|numeric|unique:users,phone,'.$id,
			'password' => 'nullable|min:8',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

      $edit = User::find($id);
	  if(request('password')!='' and strlen(request('password')) >= 8) $edit->password = bcrypt(request('password'));
      $edit->name = request('name');
	  $edit->email = request('email');
	  $edit->phone = request('phone');
      $edit->save();

      return back()->with(array('modal'=>'myModal','success'=>'Saved Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
