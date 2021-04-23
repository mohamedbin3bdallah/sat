<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Service;
use App\Doctype;
use App\Document;
use App\Image;
use Auth;

class ServicedetailsController extends Controller
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
    public function index($type = NULL,$title = NULL)
    {
      if(!$type and !$title) return redirect('admin/services/products');
      if(!$type or !array_key_exists($type, $this->flag)) return redirect('admin/services/products');
      $data = Service::where(array('flag'=>$this->flag[$type],'title'=>str_replace('_',' ',$title)))->get();
      if(empty($data)) return redirect('admin/services/products');
      //$parents = Category::where('parent', NULL)->get();
      //$categories = Category::all();
	  foreach($data as $dat)
	  {
		  $cats[] = $dat->category()->first()->title;		  
	  }
	  $categories = DB::table('categories')->select(array('title'))->where('parent', '!=', 'NULL')->groupBy('title')->get();
	    $doctypes = Doctype::all();
      return view('admin/'.$type.'details' , array('alldata'=>$data[0], 'cats'=>$cats, 'doctypes'=>$doctypes, 'categories'=>$categories));
    }

    /*public function children($id)
    {
      $return = '';
      //if(!$id) $id = 1;
      $children = Category::where('parent', $id)->get();
      if(!empty($children))
      {
        foreach ($children as $key => $value) {
          $return .= '<option value="'.$value->id.'">'.$value->title.'</option>';
        }
      }
      else $return .= '<option value="">Nothing</option>';
      return $return;
      //return response()->json(['response'=>$children]);

    }*/

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
      //
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

    public function upload(Request $request)
    {
		$count = Image::where('product_service_id', request('id'))->count();
		if($count < 5)
		{
			$attrs = array(
				'image' => 'Image',
			);
			
			$validator = Validator::make($request->all(), [
			//'image' => 'image|mimes:png|max:2048|dimensions:width=432,height=349',
		  //'image' => 'required|mimes:png|dimensions:width=432,height=349',
		  //'image' => 'required|mimes:png',
		  'image' => 'required',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal2'));
          }

			$fileName = null;
			if (request()->hasFile('image')) {
				$file = request()->file('image');
				$fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
				$file->move('./uploads/services/', $fileName);
				
				$srvs = Service::where('title', request('title'))->get();
				foreach($srvs as $srv)
				{
					$add_img = new Image();
					$add_img->media_name = $fileName;
					$add_img->type = 1;//$file->getClientOriginalExtension();
					$add_img->product_service_id = $srv->id;
					$add_img->save();
				}
			}
			return back()->with(array('modal'=>'myModal2','success'=>'Saved Successfully'));
		}
		else	return back()->withErrors('The Images must be less or equal than 5 items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $service
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function img_delete($service,$media)
    {
        if(file_exists('./uploads/services/'.$media))
        {
          if(unlink('./uploads/services/'.$media))  $del = Image::where('media_name',$media)->delete();
        }
        return back()->with(array('modal'=>'myModal5','success'=>'Saved Successfully'));
    }

    public function img_edit(Request $request)
    {
        $attrs = array(
          'image' => 'Image',
        );
		
		$validator = Validator::make($request->all(), [
			//'image' => 'image|mimes:png|max:2048|dimensions:width=432,height=349',
		  //'image' => 'mimes:png|dimensions:width=432,height=349',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal5'));
          }

        $fileName = null;
        if (request()->hasFile('image')) {
          $file = request()->file('image');
          $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
          $file->move('./uploads/services/', $fileName);
          $add_img = Image::where('media_name',request('oldimg'))->update(['media_name'=>$fileName,'type'=>1]);
          unlink('./uploads/services/'.request('oldimg'));
          /*$add_img->media_name = $fileName;
          $add_img->type = 1;//$file->getClientOriginalExtension();
          $add_img->save();*/
        }
        return back()->with(array('modal'=>'myModal5','success'=>'Saved Successfully'));
    }
}
