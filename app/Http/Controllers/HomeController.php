<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*use DB;
use App\Service;
use App\Category;
use App\Catdocs;*/
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$data = Service::find(66)->delete();
		//$data = Category::all();
		//Service::where('title','WPH pH / ORP Controllers')->update(array('title'=>'WPH pH or ORP Controllers'));
		//Category::find(40)->update(array('order'=>10));
		//Category::find(42)->update(array('order'=>11));
		//DB::table('product_service_images')->whereIn('product_service_id',array(66))->delete();
		/*$mydata = array();
		$data = Category::select('id','title','parent','order')->where('parent','!=',NULL)->orderBy('order','ASC')->get();
		foreach($data as $key => $single)
		{
			$mydata[$key]['id'] = $single->id;
			$mydata[$key]['title'] = $single->title;
			$mydata[$key]['parent'] = $single->parent;
			$mydata[$key]['order'] = $single->order;
		}*/
		//echo '<pre>'; print_r($data); echo '</pre>';
		//DB::table('product_service_images')->whereIn('product_service_id',$mydels)->delete();
		//DB::table('category_docs')->delete();
        return view('admin/home');
    }
}
