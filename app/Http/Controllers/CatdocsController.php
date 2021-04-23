<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Catdocs;
use Auth;

class CatdocsController extends Controller
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
    public function index()
    {
		//$data = Category::where('parent', '!=', 'NULL')->paginate(10);
		$alldata = DB::table('category_docs')->select(array('title'))->groupBy('title')->get();
		//$data = Category::select('title', DB::raw('COUNT(*) as count'))->where('parent', '!=', 'NULL')->groupBy('title')->orderBy('count', 'DESC')->paginate(10);
		foreach($alldata as $key => $data)
		{
			$arrs = Catdocs::where('title', $data->title)->get();  
			//echo $arrs[0]->category()->first()->title.'<br>';
			foreach($arrs as $arr)
			{
				//echo '<pre>'; print_r($arr->category()->first()->title); echo '</pre>';
				$alldata[$key]->cats[] = $arr->category()->first()['title'];
				$alldata[$key]->document_name  = $arr->document_name ;
			}
		}
        //$categories = Category::where('parent', '!=', NULL)->get();
		$categories = DB::table('categories')->select(array('title'))->where('parent', '!=', NULL)->groupBy('title')->get();
        return view('admin/catdocs' , array('alldata'=>$alldata, 'categories'=>$categories));
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
            'category' => 'Category',
			'title' => 'Title',
			'file' => 'File',
          );
		 
		  $validator = Validator::make($request->all(), [
            'category' => 'required|array',
			'title' => 'required|max:50',
			'file' => 'array',
			'file.*' => 'mimes:pdf',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'));
          }
		  
		  $fileNames = array();
		if (request()->hasFile('file')) {
			$files = request()->file('file');
			foreach ($files as $file) {
			$fileName = $file->getClientOriginalName();
			$file->move('./uploads/documents/', $fileName);
			$fileNames[] = $fileName;
			}
		}

       foreach(request('category') as $category)
	  {
		  //echo $category;
		$finds = Category::where('title','like',$category)->get();
		foreach ($finds as $find)
		{
			foreach ($fileNames as $fileName) {
				$add = new Catdocs();
				$add->document_name = $fileName;
				$add->category_id = $find->id;
				$add->title = request('title');
				$add->save();
			}
		}
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
            'category' => 'Category',
			'title' => 'Title',
          );
		 
		  $validator = Validator::make($request->all(), [
            'category' => 'required|array',
			'title' => 'required|max:50',
		  ]);
		  
		  $validator->SetAttributeNames($attrs);

		  if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput()
						->with(array('modal'=>'myModal'.$id));
          }

		$arr = array();
		$cats = Category::whereIn('title',request('category'))->get();
		foreach ($cats as $cat)
		{
			$arr[] = $cat->id;
			$update = Catdocs::where(array('document_name'=>request('file'),'category_id'=>$cat->id))->update(array('category_id'=>$cat->id,'title'=>request('title')));
			if(!$update)
			{
				$add = new Catdocs();
				$add->document_name = request('file');
				$add->category_id = $cat->id;
				$add->title = request('title');
				$add->save();
			}
		}
		
		$del = DB::table('category_docs')->where(array('document_name'=>request('file')))->whereNotIn('category_id',$arr)->delete();
	  
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
		$alldata = Catdocs::where('title',str_replace('_',' ',$id))->get();
		if($alldata->count())
		{
			foreach ($alldata as $data)
			{
				if(file_exists('./uploads/documents/'.$data->document_name)) unlink('./uploads/documents/'.$data->document_name);
				$data->delete();
			}
			return back()->with(array('del_success'=>'Deleted Successfully'));
		}
		else return back()->with(array('del_fail'=>'There is no Document'));
    }
}
