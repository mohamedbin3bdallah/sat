<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Service;
use App\News;
use App\Image;
use App\Cms;
use App\User;
use Mail;
use Auth;

class FrontController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
        $this->types = array('product','solution');
		$this->footer = Cms::where(array('page_flag'=>0,'section'=>'footer'))->get();
		$this->smedia = Cms::where(array('page_flag'=>0,'section'=>'s.media'))->get();
		$this->web_phone = Cms::where(array('page_flag'=>3,'title'=>'phone'))->get()->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //return view('web/index');
      $pop_services = Service::where(array('flag_view'=>1))->take(3)->get();
      $ftr_services = Service::where(array('flag_view'=>2))->take(5)->get();
      $sliders = Cms::where(array('page_flag'=>1,'section'=>'slider'))->get();
      $testimons = Cms::where(array('page_flag'=>1,'section'=>'testimon'))->get();
      $accordions = Cms::where(array('page_flag'=>1,'section'=>'accordion'))->get();
      //$new = Cms::where(array('page_flag'=>1,'section'=>'news'))->get();
	  $new = News::orderBy('updated_at','DESC')->take(1)->get();
      $video = Cms::where(array('page_flag'=>1,'section'=>'video'))->get();
      return view('web/index' , array('pop_services'=>$pop_services,'ftr_services'=>$ftr_services,'sliders'=>$sliders,'testimons'=>$testimons,'accordions'=>$accordions,'new'=>$new,'video'=>$video,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function search(Request $request)
    {
      if(request('q')) $data = Service::where('title','like', '%'.request('q').'%')->paginate(1);
      else $data = Service::paginate(3);
      return view('web/search' , array('alldata'=>$data,'q'=>request('q')));
    }*/
    public function search($q=NULL)
    {
      if($q) $alldata = DB::table('products_services')->select(array('title'))->where('title','like', '%'.$q.'%')->groupBy('title')->paginate(9);
	  else $alldata = DB::table('products_services')->select(array('title'))->groupBy('title')->paginate(9);
	  foreach($alldata as $key => $value)
	  {
		$service = Service::where('title', 'like', $value->title)->first();
		$image = Image::where('product_service_id', $service->id)->first();
		$alldata[$key]->id = $service->id;
		$alldata[$key]->brief = $service->brief;
		$alldata[$key]->flag = $service->flag;
		$alldata[$key]->image = $image->media_name;
	  }
      return view('web/search' , array('alldata'=>$alldata,'q'=>$q,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function service($id = NULL)
    {
      if(in_array(request()->segment(1), $this->types))
      {
        $alldata = Category::where(array('parent'=>NULL))->where('title','!=','Solutions')->orderBy('order','ASC')->get();
		$solution = Category::where('title','Solutions')->first();
        if($id) $subcategory = Category::find($id);
		elseif(request()->segment(1) == 'product') $subcategory = Category::where('title','!=','Solutions')->where(array('parent'=>NULL))->first()->children()->first();
		else $subcategory = Category::where('title','Solutions')->first()->children()->first();
		//echo '<pre>'; print_r($subcategory); echo '</pre>';
        return view('web/'.request()->segment(1) , array('alldata'=>$alldata, 'solution'=>$solution, 'subcategory'=>$subcategory,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
      }
      else return redirect('web/404');
    }*/
	
	public function service($id = NULL)
    {
      if(in_array(request()->segment(1), $this->types))
      {
        if(request()->segment(1) == 'product') $alldata = Category::where(array('parent'=>NULL,'type'=>0))->orderBy('order','ASC')->get();
		else $alldata = Category::where(array('parent'=>NULL,'type'=>1))->orderBy('order','ASC')->get();
        if($id) $subcategory = Category::find($id);
		elseif(request()->segment(1) == 'product') $subcategory = Category::where(array('parent'=>NULL,'type'=>0))->first()->children()->first();
		else $subcategory = Category::where(array('parent'=>NULL,'type'=>1))->first()->children()->first();
		//echo '<pre>'; print_r($subcategory); echo '</pre>';
        return view('web/'.request()->segment(1) , array('alldata'=>$alldata,'subcategory'=>$subcategory,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
      }
      else return redirect('web/404');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function service_details($id = NULL)
    {
      if(in_array(strtok(request()->segment(1), '_'), $this->types))
      {
        $alldata = Category::where(array('parent'=>NULL))->where('title','!=','Solutions')->orderBy('order','ASC')->get();
		$solution = Category::where('title','Solutions')->first();
        if($id) $service = Service::find($id); else $service = '';
        return view('web/'.request()->segment(1) , array('alldata'=>$alldata, 'solution'=>$solution, 'service'=>$service,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
      }
      else return redirect('web/404');
    }*/
	
	public function service_details($id = NULL)
    {
      if(in_array(strtok(request()->segment(1), '_'), $this->types))
      {
        if(strtok(request()->segment(1), '_') == 'product') $alldata = Category::where(array('parent'=>NULL,'type'=>0))->orderBy('order','ASC')->get();
		else $alldata = Category::where(array('parent'=>NULL,'type'=>1))->orderBy('order','ASC')->get();
        if($id) $service = Service::find($id); else $service = '';
        return view('web/'.request()->segment(1) , array('alldata'=>$alldata, 'service'=>$service,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
      }
      else return redirect('web/404');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function news($id = NULL)
    {
        //$alldata = News::all();
		$alldata = News::orderBy('updated_at','DESC')->get();
        if($id) $new = News::find($id); else $new = $alldata->first();
        return view('web/news' , array('alldata'=>$alldata, 'new'=>$new,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $alldata = Cms::where('page_flag',2)->get();
		$timelines = Cms::where('section','timeline')->get();
        return view('web/about' , array('alldata'=>$alldata,'timelines'=>$timelines,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signin()
    {
        if(!Auth::check()) return view('web/sign', array('footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
        else return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        if(request('submit'))
        {
          $attrs = array(
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'campany' => 'Company',
            'message' => 'Message',
          );

          $this->validate(request(),array(
            'name' => 'required|max:250',
            'email' => 'required|max:250',
            'phone' => 'integer|max:15',
            'campany' => 'max:250',
            'message' => 'required',
          ), array(), $attrs);

          $data = array(
			'name' => request('name'),
			'email' => request('email'),
			'phone' => request('phone'),
			'company' => request('company'),
			'message' => request('message'),
		   );
          Mail::send(['html'=>'web/mail/contact'], ['data'=>$data], function($message){
			$message->to('sales@satengco.com', 'SAT Site')->subject('Contact Form');
            $message->from(request('email'),request('name'));
          });
          return redirect('contact')->with(array('message'=>'Message was sent successfully', 'color'=>'green'));
        }
        else
		{
			$contact = Cms::where(array('page_flag'=>3,'section'=>'contact'))->get();
			$contact_2 = Cms::where(array('page_flag'=>3,'section'=>'contact2'))->get();
			return view('web/contact' ,array('contact'=>$contact,'contact_2'=>$contact_2,'footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
		}
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $attrs = array(
			'email' => 'Email',
        );

        $this->validate(request(),array(
			'email' => 'required|email|max:250||unique:users',
        ), array(), $attrs);

		$add = new User;
		$add->role = 'subscriber';
		$add->email = request('email');
		$add->save();
		 
        return back()->with(array('message'=>'Email was sent successfully', 'color'=>'white'));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Request $request, $form)
    {
        if(request('submit'))
        {
          Mail::send(['html'=>'web/mail/'.$form], ['data'=>$request], function($message){
            $message->to('satengsite@gmail.com', 'SAT Site')->subject(request('form').' Form');
            $message->from(request('email'),request('name'));
          });
          return redirect('form/'.$form)->with(array('message'=>'Message was sent successfully', 'color'=>'green'));
        }
        else return view('web/'.$form, array('footer'=>$this->footer,'smedia'=>$this->smedia,'web_phone'=>$this->web_phone));
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
            'description' => 'Description',
            'image' => 'Image',
          );

          $this->validate(request(),array(
            'title' => 'required|max:50|unique:categories',
            'description' => 'required',
            'image' => 'required|image|mimes:png|max:2048',
          ), array(), $attrs);
        }
        else
        {
          $attrs = array(
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'parent' => 'Category',
          );

          $this->validate(request(),array(
            'title' => 'required|max:50|unique:categories',
            'description' => 'required',
            'image' => 'required|image|mimes:png|max:2048',
            'parent' => 'required|integer',
          ), array(), $attrs);
        }
        $fileName = null;
        if (request()->hasFile('image')) {
          $file = request()->file('image');
          $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
          $file->move('./uploads/categories/', $fileName);
        }

        $add = new Category();
        $add->title = request('title');
        $add->description = request('description');
        $add->image = $fileName;
        $add->parent = request('parent');
        $add->save();
        return redirect('admin/'.$type);
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
            'description' => 'Description',
            'image' => 'Image',
          );

          $this->validate(request(),array(
            'title' => 'required|max:50|unique:categories,id,'.$id,
            'description' => 'required',
            'oldimg' => 'required',
            'image' => 'image|mimes:png|max:2048',
          ), array(), $attrs);
        }
        else
        {
          $attrs = array(
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'parent' => 'Category',
          );

          $this->validate(request(),array(
            'title' => 'required|max:50|unique:categories,id,'.$id,
            'description' => 'required',
            'oldimg' => 'required',
            'image' => 'image|mimes:png|max:2048',
            'parent' => 'required|integer',
          ), array(), $attrs);
        }

        $fileName = null;
        $add = Category::find($id);
        if (request()->hasFile('image')) {
          $file = request()->file('image');
          $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
          $file->move('./uploads/categories/', $fileName);
          unlink('./uploads/categories/'.request('oldimg'));
          $add->image = $fileName;
        }

        $add->title = request('title');
        $add->description = request('description');
        $add->parent = request('parent');
        $add->save();
        return redirect('admin/'.$type);
      }
      else return redirect('admin/404');
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
