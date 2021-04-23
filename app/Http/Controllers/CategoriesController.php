<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Customer;
use App\Service;
use App\Document;
use App\Image;
use Auth;

class CategoriesController extends Controller
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
				$this->types = array('categories','subcategories');
				return $next($request);
			}
		});
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
      if(in_array($type, $this->types))
      {
        if($type == 'categories')
        {
          $data = Category::where('parent', NULL)->orderBy('order','ASC')->get();
          $max = Category::where('parent', NULL)->max('order');
          return view('admin/categories' , array('alldata'=>$data,'max'=>$max));
        }
        else
        {
          //$data = Category::where('parent', '!=', 'NULL')->paginate(10);		  
		  //$alldata = DB::table('categories')->select(array('title'))->where('parent', '!=', 'NULL')->orderBy('order','ASC')->groupBy('title')->paginate(10);
		  $alldata = DB::table('categories')->select(array('order'))->where('parent', '!=', 'NULL')->orderBy('order','ASC')->groupBy('order')->get();
		  //$data = Category::select('title', DB::raw('COUNT(*) as count'))->where('parent', '!=', 'NULL')->groupBy('title')->orderBy('count', 'DESC')->paginate(10);
		  foreach($alldata as $key => $data)
		  {
			$arrs = Category::where('order',  $data->order)->where('parent', '!=', 'NULL')->get();  
			foreach($arrs as $arr)
			{
				$alldata[$key]->parents[] = $arr->parent;
				$data->title = $arr->title;
				$data->id = $arr->id;
				$data->description = $arr->description;
			}
		  }
          $parents = Category::where('parent', NULL)->get();
          $max = Category::where('parent', '!=', NULL)->max('order');
          //print_r($alldata);
          return view('admin/subcategories' , array('alldata'=>$alldata, 'parents'=>$parents, 'max'=>$max));
        }
      }
      else return redirect('admin/404');
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
    public function store(Request $request,$type)
    {
      if(in_array($type, $this->types))
      {
        if($type == 'categories')
        {
          $attrs = array(
            'title' => 'Title',
          );
		 
		  $validator = Validator::make($request->all(), [
            'title' => 'required|max:50|unique:categories',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/'.$type)
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

		$maxOrder = Category::where('parent', NULL)->max('order');
		
		$add = new Category();
        $add->title = request('title');
		$add->type = request('type');
        //$add->description = request('description');
        //$add->image = $fileName;
		if($maxOrder) $add->order = $maxOrder+1;
		else $add->order = 1;
		if(request('form')) $add->form = request('form');
        $add->save();
        }
        else
        {
			//print_r(request('parent'));
			$attrs = array(
				'title' => 'Title',
				'description' => 'Description',
				'parent' => 'Category',
			);
			
			$validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z ]+$/u|max:50|unique:categories',
			'description' => 'required',
			'parent' => 'required|array',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/'.$type)
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }

			$maxOrder = Category::where('parent', '!=', NULL)->max('order');

			foreach(request('parent') as $parent)
			{
				$add = new Category();
				$add->title = request('title');
				$add->description = request('description');
				$add->parent = $parent;
				if($maxOrder) $add->order = $maxOrder+1;
				else $add->order = 1;
				$add->save();
			}
        }
		return redirect('admin/'.$type)->with(array('modal'=>'myModal','success'=>'Saved Successfully'));
      }
      else return redirect('admin/404');
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
    public function update(Request $request, $type, $id)
    {
      if(in_array($type, $this->types))
      {
        if($type == 'categories')
        {
          $attrs = array(
            'title' => 'Title',
          );
		  
		  $validator = Validator::make($request->all(), [
            'title' => 'required|max:50|unique:categories,id,'.$id,
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/'.$type)
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }
		
		  $add = Category::find($id);
		  $add->title = request('title');
		  $add->form = request('form');
		  $add->type = request('type');
		  $add->save();
        }
        else
        {
          $attrs = array(
            'title' => 'Title',
            'description' => 'Description',
            //'image' => 'Image',
            'parent' => 'Category',
          );
		  
		  $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z ]+$/u|max:50|unique:categories,id,'.$id,
            'description' => 'required',
			'parent' => 'required|array',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return redirect('admin/'.$type)
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

          /*$this->validate(request(),array(
            'title' => 'required|max:50|unique:categories,id,'.$id,
            'description' => 'required',
            //'oldimg' => 'required',
            //'image' => 'image|mimes:png|max:2048|dimensions:width=863,height=863',
			//'image' => 'image|mimes:png|max:2048',
            'parent' => 'required|array',
          ), array(), $attrs);*/
		  
		  $sers = Service::where('category_id',request('id'))->get();
		  
		  foreach(request('parent') as $parent)
		  {
			$add = Category::where(array('title'=>str_replace('_',' ',$id),'parent'=>$parent))->first();		
			if($add)
			{
				$add->title = request('title');
				$add->description = request('description');
				$add->save();
			}
			else
			{
				$newadd = new Category();
				$newadd->title = request('title');
				$newadd->description = request('description');
				$newadd->parent = $parent;
				$newadd->order = request('order');
				$newadd->save();
				
				if(!empty($sers))
				{
					foreach($sers as $ser)
					{
						$docs = Document::where('product_service_id',$ser->id)->get();
						$imgs = Image::where('product_service_id',$ser->id)->get();
					
						$new_s = new Service();
						$new_s->title = $ser->title;
						$new_s->brief = $ser->brief;
						$new_s->description = $ser->description;
						$new_s->flag = $ser->flag;
						$new_s->category_id = $newadd->id;
						$new_s->created_at = $ser->created_at;
						$new_s->updated_at = $ser->updated_at;
						$new_s->save();
					
						if(!empty($docs))
						{
							foreach($docs as $doc)
							{
								$new_d = new Document();
								$new_d->document_name = $doc->document_name;
								$new_d->document_type_id = $doc->document_type_id;
								$new_d->product_service_id = $new_s->id;
								$new_d->created_at = $doc->created_at;
								$new_d->updated_at = $doc->updated_at;
								$new_d->save();
							}
						}
					
						if(!empty($imgs))
						{
							foreach($imgs as $img)
							{
								$new_i = new Image();
								$new_i->media_name = $img->media_name;
								$new_i->type = $img->type;
								$new_i->product_service_id = $new_s->id;
								$new_i->created_at = $img->created_at;
								$new_i->updated_at = $img->updated_at;
								$new_i->save();
							}
						}
					}
				}
			}
		  }
		  
		  $cat_dels = DB::table('categories')->select('id')->where(array('title'=>str_replace('_',' ',$id)))->whereNotIn('parent',request('parent'))->get();
		  if(!empty($cat_dels))
		  {
			foreach($cat_dels as $cat_del) { $cat_ids[] = $cat_del->id; }
			if(!empty($cat_ids))
			{
				$dels = DB::table('products_services')->select('id')->whereIn('category_id',$cat_ids)->get();
				if(!empty($dels))
				{
					$mydels = array();
					foreach($dels as $del) { $mydels[] = $del->id; }
					DB::table('product_service_images')->whereIn('product_service_id',$mydels)->delete();
					DB::table('documents')->whereIn('product_service_id',$mydels)->delete();
					DB::table('products_services')->whereIn('id',$mydels)->delete();
				}
			}
			DB::table('categories')->select('id')->where(array('title'=>str_replace('_',' ',$id)))->whereNotIn('parent',request('parent'))->delete();
		  }
        }
        return redirect('admin/'.$type)->with(array('modal'=>'myModal'.$id,'success'=>'Saved Successfully'));
      }
      else return redirect('admin/404');
    }
	
	/*public function reorder($type, $reorder)
    {
      if($type == 'categories')
      {
		  $arr = array();
		  $arr1 = array();
		  $arr2 = array();

		  $arr = explode('_',$reorder);
		  $arr1 = explode(':',$arr[0]);
		  $arr2 = explode(':',$arr[1]);
		  
		  $edit1 = Category::find($arr1[0]);
		  $edit1->order = $arr1[1];
		  $edit1->save();
		  
		  $edit2 = Category::find($arr2[0]);
		  $edit2->order = $arr2[1];
		  $edit2->save();
		  
		  return redirect('admin/'.$type);
      }
      else return redirect('admin/404');
    }*/
	
	public function reorder($type, $reorder)
    {
      if($type == 'categories')
      {
		  $arr = array();

		  $arr = explode('_',$reorder);
		  $cat1 = Category::where(array('parent'=>NULL,'order'=>$arr[0]))->get()->first();
		  $cat2 = Category::where(array('parent'=>NULL,'order'=>$arr[1]))->get()->first();
		  
		  $cat1->order = $arr[1];
		  $cat1->save();
		  
		  $cat2->order = $arr[0];
		  $cat2->save();
		  
		  return back();
      }
      else return redirect('admin/404');
    }
	
	/*public function reorder_title($type, $reorder)
    {
      if($type == 'subcategories')
      {
		  $arr = array();
		  $arr1 = array();
		  $arr2 = array();

		  $arr = explode('_',$reorder);
		  $arr1 = explode(':',$arr[0]);
		  $arr2 = explode(':',$arr[1]);
		  
		  $edit1 = Category::where('title', str_replace('-',' ',$arr1[0]));
		  //$edit1->order = $arr1[1];
		  $edit1->update(array('order'=>$arr1[1]));
		  
		  $edit2 = Category::where('title', str_replace('-',' ',$arr2[0]));
		  //$edit2->order = $arr2[1];
		  $edit2->update(array('order'=>$arr2[1]));
		  
		  return redirect('admin/'.$type);
      }
      else return redirect('admin/404');
    }*/
	
	public function reorder_title($type, $reorder)
    {
      if($type == 'subcategories')
      {
		  $arr = array();

		  $arr = explode('_',$reorder);
		  $cat1 = Category::where('parent','!=', NULL)->where('order',$arr[0]);
		  $cat1->update(array('order'=>999999999));
		  $cat2 = Category::where('parent','!=', NULL)->where('order',$arr[1]);
		  $cat2->update(array('order'=>$arr[0]));
		  $cat3 = Category::where('parent','!=', NULL)->where('order',999999999);
		  $cat3->update(array('order'=>$arr[1]));

		  return back();
      }
      else return redirect('admin/404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $id)
    {
        if($type == 'categories')
		{
			$cats_count = Category::where('parent',$id)->get()->count();
			if($cats_count) return back()->with(array('del_fail'=>'There are some Sub-Categories'));
			else
			{
				Category::find($id)->delete();
				return back()->with(array('del_success'=>'Deleted Successfully'));
			}
		}
		elseif($type == 'subcategories')
		{
			$cats = Category::where('title',str_replace('_',' ',$id))->get();
			if($cats->count()==0) return back()->with(array('del_fail'=>'There are no Sub-Categories'));
			else
			{
				foreach($cats as $cat)
				{
					$sers = Service::where('category_id',$cat->id)->get();
					if($sers->count()) return back()->with(array('del_fail'=>'There are some Products or Solutions'));
				}
				Category::where('title',str_replace('_',' ',$id))->delete();
				return back()->with(array('del_success'=>'Deleted Successfully'));
				
			}
		}
		else return back();
    }
}
