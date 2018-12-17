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

Route::post('/update/cities/{id}', function ($id,\Illuminate\Http\Request $request) {
    try{
    $key=$request->header('Key');    
    // $province=$request->input('province');
    $provinceId=$_POST['province_id'];
    $type=$_POST['type'];
    $cityName=$_POST['city_name'];
    $postalCode=$_POST['postal_code'];
    if(empty($key)&&empty($id)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{
    $user = App\City::where('city_id', '=', $id);
    
    if(count($user->get())==0){
    return response()->json(["error"=>"id yang anda cari tidak ada"]);        
    }else{
        $userd = App\Province::where('province_id', '=', $provinceId)->get();
        if(count($userd)==0){
        return response()->json(["error"=>"province_id $provinceId tidak ditemukan"]);        
        }else{
        $user->update(["province"=>$userd[0]->province,
        "province_id"=>$provinceId,
        "city_name"=>$cityName,
        "type"=>$type,
        "postal_code"=>$postalCode
        
        ]);    
        return response()->json($user->get());
        }
        
        
        
    }
    
        }
    }
    }catch(Exception $e){
    return response()->json(["error"=>"isi semua parameter tanpa terkecuali province_id,city_name,type,postal_code"]);            
    }
});
Route::post('/update/provinces/{id}', function ($id,\Illuminate\Http\Request $request) {
    try{
    $key=$request->header('Key');    
    $province=$_POST['province'];
    if(empty($key)&&empty($id)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{
    $user = App\Province::where('province_id', '=', $id);
    
    if(count($user->get())==0){
    return response()->json(["error"=>"id yang anda cari tidak ada"]);        
    }else{
        $user->update(["province"=>$province]);
        
        return response()->json($user->get());    
    }
    
        }
    }
    }catch(Exception $e){
    return response()->json(["error"=>"isi parameter province"]);            
    }
});
Route::delete('/delete/cities/{id}', function ($id,\Illuminate\Http\Request $request) {
    try{
    $key=$request->header('Key');    
    
    if(empty($key)&&empty($id)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{
    $user = App\City::where('city_id', '=', $id);
    
    if(count($user->get())==0){
    return response()->json(["error"=>"id yang anda cari tidak ada"]);        
    }else{
        $user->delete();
        return response()->json(["sukses"=>"sukses delete id $id"]);    
    }
    
        }
    }
    }catch(Exception $e){
    return response()->json(["error"=>"isi semua parameter tanpa terkecuali"]);            
    }
});
Route::delete('/delete/provinces/{id}', function ($id,\Illuminate\Http\Request $request) {
    try{
    $key=$request->header('Key');    
    
    
    
    if(empty($key)&&empty($id)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{
    $user = App\Province::where('province_id', '=', $id);
    
    if(count($user->get())==0){
    return response()->json(["error"=>"id yang anda cari tidak ada"]);        
    }else{
        $user->delete();
        return response()->json(["sukses"=>"sukses delete id $id"]);    
    }
    
        }
    }
    }catch(Exception $e){
    return response()->json(["error"=>"masukkan key dan id yang mau didelete"]);            
    }
    
});
Route::post('/create/cities/', function (\Illuminate\Http\Request $request) {


try{
    $key=$request->header('Key');    
    $provinceId=$_POST['province_id'];
    $type=$_POST['type'];
    $cityName=$_POST['city_name'];
    $postalCode=$_POST['postal_code'];
    if(empty($key)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{

$user = new App\City;
$userd = App\Province::where('province_id', '=', $provinceId)->get();
if(count($userd)!=0){
$user->province_id =$provinceId;
$user->province =$userd[0]->province;
$user->city_id =count(App\City::all())+1;
$user->city_name =$cityName;
$user->postal_code =$postalCode;
$user->type =$type;
$user->save();
    return response()->json($user);                        
}else{
    return response()->json(["error"=>"province_id tidak ditemukan"]);                
}
}
}
    
    }catch(Exception $e){
        // return response()->json(["error"=>$e]);            
    return response()->json(["error"=>"masukkan semua parameter province_id,city_name,postal_code,type"]);            
    }
});
Route::post('/create/provinces/', function (\Illuminate\Http\Request $request) {
    

try{
    $key=$request->header('Key');    
    $province= $_POST['province'];
    
    if(empty($key)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{

$user = new App\Province;
$userd = App\Province::where('province', '=', $province)->get();
if(count($userd)==0){
$user->province =$province;
$user->province_id =count(App\Province::all())+1;
$user->save();
    return response()->json($user);                        
}else{
    return response()->json(["error"=>"nama provinsi yang anda masukkan sudah ada di database silahkan ganti yang lain"]);                
}
}
}
    
    }catch(Exception $e){
    return response()->json(["error"=>$e]);            
    }
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/cities', function (\Illuminate\Http\Request $request) {
    $key=$request->header('Key');
    if(empty($key)){
    return response()->json(['error'=>'header key tidak ada']);           
    }else{
    $flights = App\City::all();
    return response()->json($flights);            
    }
    
});

Route::get('/provinces', function (\Illuminate\Http\Request $request) {
    $key=$request->header('Key');
    if(empty($key)){
    return response()->json(['error'=>'header key tidak ada']);               
    }else{
    $flights = App\Province::all();
    return response()->json($flights);            
    }
    
});
Route::post('/search/cities/', function (\Illuminate\Http\Request $request) {
    try{
    $key=$request->header('Key');
    $id=$_POST['id'];
    
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
Route::post('/search/provinces/', function (\Illuminate\Http\Request $request) {
    try{
    $key=$request->header('Key');
    $id=$_POST['id'];
    
    if(empty($key)&&empty($id)){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);        
    }else{
        $flights = App\Orang::where('key', $key)->get();
        if(count($flights)==0){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);                
        }else{
    $flights = App\Province::where('province_id', $id)->get();
    return response()->json($flights);    
        }
    }
    
    
    
    }catch(Exception $e){
    return response()->json(["error"=>"key yang anda masukkan salah silahkan login terlebih dahulu"]);            
    }
});
Route::post('/login', function () {
    try{
  $user=$_POST['user'];
  $pass=$_POST['pass'];
  $flights = App\Orang::where('user', $user)->where('pass', hash('sha256',$pass))->get();      
  if(count($flights)==0){
      return response()->json(["error"=>"username atau password salah"]);    
  }else{
  $cubi=hash('sha256', $user.$pass);
  $flights = App\Orang::where('user', $user)->where('pass', hash('sha256',$pass));
  $flights->update(['key' => $cubi]);
  
  return response()->json(["key"=>$cubi,"keterangan"=>"gunakan key untuk POST dan GET beberapa API"]);    
  }
  
    }catch(Exception $e){
    return response()->json(["error"=>"user pass parameter tidak diisi"]);    
    }
  
    
    
});
Route::post('/register', function () {
    try{
  $user=$_POST['user'];
  $pass=$_POST['pass'];      
  if(!empty($user)&&!empty($pass)){
      $flights = App\Orang::where('user', $user)->get();
      if(count($flights)==1){
    return response()->json(["error"=>"username sudah terpakai pilih username lainnya"]);          
      }else{
  $user = App\Orang::firstOrCreate(['user' => $user,'pass' => hash('sha256', $pass)]);
    return response()->json($user);            
      }
  
  }else{
      return response()->json(["error"=>"mohon isi username pass"]);      
  }
    }catch(Exception $e){
      return response()->json(["error"=>"mohon isi username pass"]);      
    }
  
  
  
});
