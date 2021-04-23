<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('id', '[0-9]+');
Route::pattern('property', '[0-9]+');
Route::pattern('type', '[a-zA-Z]+');
Route::pattern('reorder', '[0-9:_]+');
Route::pattern('name', '[a-z0-9]+');
Route::pattern('idtitle', '[a-zA-Z0-9_]+');
Route::pattern('idtitle1', '[a-zA-Z0-9-_]+');
Route::pattern('image', '[a-zA-Z0-9.]+');

Route::get('/admin/services/{type?}/property/{id}/{property}','ServicesController@property');

Route::get('/', 'FrontController@index');
Route::get('home', 'FrontController@index');
Route::get('search/{q?}', 'FrontController@search');
Route::get('about', 'FrontController@about');
Route::get('product/{id?}', 'FrontController@service');
Route::get('solution/{id?}', 'FrontController@service');
Route::get('product_details/{id?}', 'FrontController@service_details');
Route::get('solution_details/{id?}', 'FrontController@service_details');
Route::get('news/{id?}', 'FrontController@news');
Route::get('contact', 'FrontController@contact');
Route::post('contact', 'FrontController@contact');
Route::get('form/{type}', 'FrontController@form');
Route::post('form/{type}', 'FrontController@form');
Route::post('subscribe', 'FrontController@subscribe');
Route::get('signin', 'FrontController@signin')->name('login');
Route::get('web/404',  function () {
      return view('web/404');
  });

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
/*Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');*/

// Password Reset Routes...
/*Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/

Route::middleware('auth')->group(function () {
Route::prefix('admin')->group(function () {
  Route::get('404',  function () {
      return view('admin/404');
  });

  /*Route::get('/',  function () {
      return view('admin/home');
  });*/
  Route::get('/', 'HomeController@index');
  /*Route::get('home',  function () {
      return view('admin/home');
  });*/
  Route::get('home', 'HomeController@index');
  Route::prefix('admins')->group(function () {
      Route::get('/', 'UsersController@index');
	  Route::post('edit/{id}', 'UsersController@update');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

  Route::prefix('companies')->group(function () {
    Route::get('/', 'CompaniesController@index');
    Route::post('add', 'CompaniesController@store');
    Route::post('edit/{id?}', 'CompaniesController@update');
	Route::get('delete/{id}', 'CompaniesController@destroy');
    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
  });

  Route::prefix('customers')->group(function () {
    Route::get('/', 'CustomersController@index');
    Route::post('edit/{id?}', 'CustomersController@update');
	Route::get('delete/{id}', 'CustomersController@destroy');
    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
  });

    Route::prefix('doctypes')->group(function () {
      Route::get('/', 'DoctypesController@index');
      Route::post('add', 'DoctypesController@store');
      Route::post('edit/{id?}', 'DoctypesController@update');
	  Route::get('delete/{id}', 'DoctypesController@destroy');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

    Route::prefix('services')->group(function () {
      Route::get('/', 'ServicesController@index');
      Route::get('children/{id?}', 'ServicesController@children');
      Route::get('{type?}', 'ServicesController@index');
      Route::post('{type?}/add', 'ServicesController@store');
      Route::post('{type?}/edit', 'ServicesController@update');
	  Route::get('{type?}/delete/{title}', 'ServicesController@destroy');
	  //Route::get('{type?}/property/(id)/{property}', 'ServicesController@property');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

	  Route::prefix('servicedetails')->group(function () {
	    Route::get('{type?}/{sertitle?}', 'ServicedetailsController@index');
      Route::post('upload', 'ServicedetailsController@upload');
      Route::get('image_delete/{type}/{image}', 'ServicedetailsController@img_delete');
      Route::post('image_edit', 'ServicedetailsController@img_edit');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

	  Route::prefix('documents')->group(function () {
      Route::post('add', 'DocumentsController@store');
      Route::post('edit/{id?}', 'DocumentsController@update');
	  Route::get('delete/{id}', 'DocumentsController@destroy');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

    Route::prefix('news')->group(function () {
      Route::get('/', 'NewsController@index');
      Route::post('add', 'NewsController@store');
      Route::post('edit/{id?}', 'NewsController@update');
	  Route::get('delete/{id}', 'NewsController@destroy');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });
	
	Route::prefix('cms')->group(function () {
      Route::get('/', 'CmsController@index');
      Route::post('add', 'CmsController@store');
      Route::post('edit/{id?}', 'CmsController@update');
	  Route::get('delete/{id}', 'CmsController@destroy');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

	Route::prefix('catdocs')->group(function () {
      Route::get('/', 'CatdocsController@index');
      Route::post('add', 'CatdocsController@store');
      Route::post('edit/{idtitle1?}', 'CatdocsController@update');
	  Route::get('delete/{del_title}', 'CatdocsController@destroy');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

    Route::prefix('{type}')->group(function () {
      Route::get('/', 'CategoriesController@index');
      Route::post('add', 'CategoriesController@store');
      Route::post('edit/{idtitle?}', 'CategoriesController@update');
	  Route::get('reorder/{reorder}', 'CategoriesController@reorder');
	  Route::get('reorder_title/{reorder_t}', 'CategoriesController@reorder_title');
	  Route::get('delete/{del_title}', 'CategoriesController@destroy');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
});
Route::get('{string}',  function () {
    return redirect('admin/404', 301);
});
});
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
