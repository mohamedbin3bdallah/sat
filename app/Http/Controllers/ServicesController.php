<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Service;
use App\Image;
use App\Document;
use Auth;

class ServicesController extends Controller
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
				$this->flag = array('products'=>1,'solutions'=>2);
				return $next($request);
			}
		});
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = NULL)
    {
      if(!$type or !array_key_exists($type, $this->flag)) return redirect('admin/services/products');
      //$data = Service::where('flag', $this->flag[$type])->paginate(10);
	  $data = DB::table('products_services')->select(array('title'))->where('flag', $this->flag[$type])->groupBy('title')->get();
	  foreach($data as $key => $dat)
	  {
		  $servs = Service::where('title', $dat->title)->get();
		  foreach($servs as $serv)
		  {
			  $data[$key]->id = $serv->id;
			  $data[$key]->brief = $serv->brief;
			  $data[$key]->flag_view = $serv->flag_view;
			  $data[$key]->cats[] = $serv->category()->first()->title;
		  }
		  
	  }
	  //echo '<pre>'; print_r($data); echo '</pre>';
      $parents = Category::where('parent', NULL)->get();
	  $categories = DB::table('categories')->select(array('title'))->where('parent', '!=', 'NULL')->groupBy('title')->get();
      return view('admin/'.$type , array('alldata'=>$data, 'categories'=>$categories));
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
      $attrs = array(
        'title' => 'Title',
		'brief' => 'Brief',
        'description' => 'Description',
        'service' => 'Service',
        'category' => 'Category',
        'image' => 'Image',
      );
	  
	  $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z ]+$/u|max:100|unique:products_services',
			'brief' => 'required',
			'description' => 'required',
			'service' => 'required',
			'category' => 'required|array',
			//'image' => 'required|image|mimes:png|size:2048|array|max:5|dimensions:width=432,height=349',
			//'image' => 'image|mimes:png|size:2048|array|max:5',
			'image' => 'required|array|max:5',
			//'image.*' => 'mimes:png|dimensions:width=432,height=349',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/services/'.array_search(request('service'), $this->flag))
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }
		  
		$fileNames = array();
		if (request()->hasFile('image')) {
			$files = request()->file('image');
			foreach ($files as $file) {
			$fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
			$file->move('./uploads/services/', $fileName);
			$fileNames[] = $fileName;
			}
		}

	  foreach(request('category') as $category)
	  {
		  //echo $category;
		$finds = Category::where('title','like',$category)->get();
		foreach ($finds as $find)
		{
			$add = new Service();
			$add->title = request('title');
			$add->brief = request('brief');
			$add->description = request('description');
			$add->flag = request('service');
			$add->category_id = $find->id;
			$add->save();

			foreach ($fileNames as $fileName) {
				$add_img = new Image();
				$add_img->media_name = $fileName;
				$add_img->type = 1;//$file->getClientOriginalExtension();
				$add_img->product_service_id = $add->id;
				$add_img->save();
			}
		}
      }

      return redirect('admin/services/'.array_search(request('service'), $this->flag))->with(array('modal'=>'myModal','success'=>'Saved Successfully'));
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
    public function update(Request $request)
    {
      // dirname(__FILE__);
      $attrs = array(
        'title' => 'Title',
		'brief' => 'Brief',
        'description' => 'Description',
        'service' => 'Service',
        'category' => 'Category',
      );
	  
	  $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z ]+$/u|max:100|unique:products_services,id,'.request('id'),
			'description' => 'required',
			'brief' => 'required',
			'service' => 'required|integer',
			'category' => 'required|array',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal4'));
          }

		Service::where(array('title'=>request('oldtitle')))->update(array('flag_view'=>0));
		
	  $cat_ids = array();
      foreach(request('category') as $category)
	  {
		  //echo $category;
		$finds = Category::where('title','like',$category)->get();
		foreach ($finds as $find)
		{
			$cat_ids[] = $find->id;
			$add = Service::where(array('title'=>request('oldtitle'),'category_id'=>$find->id))->first();
			if(empty($add))
			{
				$new = new Service;
				$new->title = request('title');
				$new->brief = request('brief');
				$new->description = request('description');
				$new->flag = request('service');
				$new->category_id = $find->id;
				$new->save();
				
				$fileNames = Image::where(array('product_service_id'=>request('id')))->get();
				foreach ($fileNames as $fileName) {
					$add_img = new Image();
					$add_img->media_name = $fileName->media_name;
					$add_img->type = 1;//$file->getClientOriginalExtension();
					$add_img->product_service_id = $new->id;
					$add_img->save();
				}
				
				$docNames = Document::where(array('product_service_id'=>request('id')))->get();
				foreach ($docNames as $docName) {
					$add_doc = new Document();
					$add_doc->document_name = $docName->document_name;
					$add_doc->document_type_id = $docName->document_type_id;
					$add_doc->product_service_id = $new->id;
					$add_doc->save();
				}
			}
			else
			{
				$add->title = request('title');
				$add->brief = request('brief');
				$add->description = request('description');
				$add->flag = request('service');
				$add->category_id = $find->id;
				$add->save();
			}
		}
      }
	  
	  $dels = DB::table('products_services')->select('id')->where(array('title'=>request('oldtitle')))->whereNotIn('category_id',$cat_ids)->get();
	  if(!empty($dels))
	  {
		$mydels = array();
		foreach($dels as $del) { $mydels[] = $del->id; }
		DB::table('product_service_images')->whereIn('product_service_id',$mydels)->delete();
		DB::table('documents')->whereIn('product_service_id',$mydels)->delete();
		DB::table('products_services')->whereIn('id',$mydels)->delete();
	  }

      return back()->with(array('modal'=>'myModal4','success'=>'Saved Successfully'));
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function property($type = NULL, $id, $property)
    {
		$pro_count = Service::where('flag_view',$property)->count();

		if($property == 1 and $pro_count < 3)
		{
			$ser_update = Service::find($id)->update(array('flag_view'=>$property));
		}
		elseif($property == 1 and $pro_count = 3)
		{
			return back()->with(array('Message_pro_fail'=>'There are more than three popular products'));
		}
		elseif($property == 2)
		{
			$ser_update = Service::find($id)->update(array('flag_view'=>$property));
		}
		else $ser_update = Service::find($id)->update(array('flag_view'=>0));

		return back()->with(array('Message_pro_success'=>'Saved Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type=NULL, $title)
    {
        $alldata = Service::where('title',str_replace('_',' ',$title))->get();
		if(!empty($alldata))
		{
			foreach($alldata as $data)
			{
				$images = Image::where('product_service_id',$data->id)->get();
				if(!empty($images))
				{
					$images_del = array();
					foreach($images as $image)
					{
						if(file_exists('./uploads/services/'.$image->media_name)) unlink('./uploads/services/'.$image->media_name);
						$images_del[] = $image->id;
					}
					if(!empty($images_del)) DB::table('product_service_images')->whereIn('id',$images_del)->delete();
				}

				$documents = Document::where('product_service_id',$data->id)->get();
				if(!empty($documents))
				{
					$documents_del = array();
					foreach($documents as $document)
					{
						if(file_exists('./uploads/documents/'.$document->document_name)) unlink('./uploads/documents/'.$document->document_name);
						$documents_del[] = $document->id;
					}
					if(!empty($documents_del)) DB::table('documents')->whereIn('id',$documents_del)->delete();
				}
				
				$data->delete();
			}

			return back()->with(array('del_success'=>'Saved Successfully'));
		}
		return back();
    }
}
