<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cities', function () {
    $flights = App\City::all();
    return response()->json($flights);        
});
Route::get('/provinces', function () {
    $flights = App\Province::all();
    return response()->json($flights);        
});
Route::get('/search/cities/', function () {
    try{
    $key=$_GET['key'];
    $id=$_GET['id'];
    
    if(empty($key)&&empty($id)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{
    $flights = App\City::where('city_id', $id)->get();
    return response()->json($flights);    
        }
    }
    
    
    
    }catch(Exception $e){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);            
    }
    
});
Route::get('/search/provinces/', function () {
    try{
    $key=$_GET['key'];
    $id=$_GET['id'];
    
    if(empty($key)&&empty($id)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu","haha"=>"huhu"]);                
        }else{
    $flights = App\Province::where('province_id', $id)->get();
    return response()->json($flights);    
        }
    }
    
    
    
    }catch(Exception $e){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);            
    }
});
Route::get('/login', function () {
    try{
  $user=$_GET['user'];
  $pass=$_GET['pass'];
  $flights = App\Orang::where('user', $user)->where('pass', $pass)->get();      
  if(count($flights)==0){
      return response()->json(["error"=>"username atau password salah"]);    
  }else{
  $cubi=hash('sha256', $user.$pass);
  $flights = App\Orang::where('user', $user)->where('pass', $pass);
  $flights->update(['key' => $cubi]);
  
  return response()->json(["key"=>$cubi,"keterangan"=>"gunakan key untuk search/cities?id={city_id} atau search/provinces?id={province_id}"]);    
  }
  
    }catch(Exception $e){
    return response()->json(["error"=>"user pass parameter tidak diisi"]);    
    }
  
    
    
});
Route::get('/register', function () {
    try{
  $user=$_GET['user'];
  $pass=$_GET['pass'];      
  if(!empty($user)&&!empty($pass)){
  $user = App\Orang::firstOrCreate(['user' => $user,'pass' => $pass]);
    return response()->json($user);    
  }else{
      return response()->json(["error"=>"mohon isi username pass"]);      
  }
    }catch(Exception $e){
      return response()->json(["error"=>"mohon isi username pass"]);      
    }
  
  
  
});
