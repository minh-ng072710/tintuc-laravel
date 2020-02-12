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

Route::get('/', function () {
    return view('welcome');
});
Route::get('chao/',function(){
    return View::make('xinchao',array('Ho'=>'Nguyễn','Ten'=>'Minh'));
});
Route::get('tinhtich/{a}/{b}','TheLoaiController@tinhtich');
Route::get('tich/{a}/{b}','TheLoaiController@tinhtich');
Route::get('db1',function(){
    $kq=DB::table("tin")->pluck('TieuDe');
    foreach($kq as $t){
        print_r ($t."<br>");
    };
});
Route::get('db2',function(){
    $td = DB::table("tin")->where("idTin","=",3)->value("TieuDe");
    print($td);
});

Route::get('db3',function(){
    // $kq=DB::table("loaitin")->pluck("Ten","idLT");
    // foreach($kq as $idLT=>$ten){
    //     echo $idLT.":".$ten."</br>";
    // }
//     $kq = DB::table('loaitin')->orderBy("idLT",'asc')->pluck('Ten','idLT');
//     foreach($kq as $idLT=>$Ten) {
//    echo $idLT, " : ", $Ten,"<br>";
// }

DB::table('tin')->orderBy('SoLanXem','desc')->chunk(20, function ($t) {
    $kq=DB::table("users")->count();

	foreach ($t as $t1) {	
        echo "<p class='td'>$t1->TieuDe . Xem: $t1->SoLanXem</p>"."<h1> Số user:".$kq."</h1>";
    }
	return false;
});
});

//check tồn ti user 
Route::get('db4',function(){
   $kq = DB::table('users')->where('username', 'teo')->exists();
if (!$kq)  {
	echo "Không tồn tại user này";
}


});

Route::get('db6',function(){
//     $kq= DB::table('tin')->offset(0)->limit(10)->pluck("TieuDe","SoLanXem");
	
//     //do tổng hơp nhiều quá nên phải get();
// foreach ($kq as $r=>$t) {
// 	echo "<p>$r:". $t."</p>";
// }
$sodong = DB::delete("Delete From theloai WHERE idTL=?",[23]);
echo "Số dòng xóa "  . $sodong,"<br/>";
$kq = DB::select("select TenTL, ThuTu TT from theloai");
foreach($kq as $r)echo "<p>{$r->TenTL}-{$r->TT}</p>";


});

Route::get('db7',function(){
 $user=DB::table("users")->where('username', 'teo')->exists();


 if(!$user){
     echo"User này không tồn tại";
 }
 else {
    $user1=DB::table("users")->first();
    echo "Tồn Tại User: ".$user1->name ;
 }

});


route::get('db10',function(){
    $kq = DB::table('loaitin')
    ->select(DB::raw("concat(lang , '-', Ten) as LT"))//ghép cột ghép cột thật sự 
    ->where('anhien',"<>", 0)->get();
 echo "<ul>";
 foreach($kq as $row) echo "<li>$row->LT</li>";
 echo "</ul>";
 
   
});
// $kq= DB::table('tin')->select('idTin', 'TieuDe', 'SoLanXem','Ngay')
// 	->orderby('SoLanXem','desc')->offset(0)->limit(10)
//     ->get();//do tổng hơp nhiều quá nên phải get();
// foreach ($kq as $r) {
// 	echo "<p>{$r->TieuDe} ({$r->SoLanXem})</p>";
// }




Route::get("insert",function(){
    $insert=DB::table("theloai")->insert(array('TenTL'=>'Gâs','ThuTu'=>23));

        $showfromtheloai=DB::table("theloai")->get();
        foreach($showfromtheloai as $t){
            echo "{$t->TenTL}-Thứ Tự:{$t->ThuTu}";
        }
        
    });


route::get('update',function(){
    $update=DB::table("theloai")->where("idTL","=","6")->update(array('TenTL'=>'NewCat',"lang"=>"en"));
    if($update=""){
        echo"loi";
    }
    else
    {
        $newdata=DB::table("theloai")->get();
        foreach($newdata as $r){
            echo "<p>{$r->TenTL}-{$r->lang}</p>";
        }
       
       
}
});
$table->increments('id');
$table->string('tensp',30)->unique();
$table->float('gia',8,2);
$table->string('urlhinh',100);

