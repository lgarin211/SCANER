<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item_model;
use Illuminate\Support\Facades\DB;
class read extends Controller
{
public function index()
{
return view('base');
# code...
}
public function read()
{$flights=item_model::all();
// var_dump($flights[0]['nama_item']);
$p=$flights==null;
$data='flights';
if ($p) {
return view('input_produk');
} else {
foreach ($flights as $flight) {
if (
$flight->nama_item=="default") {
$komponen   =    $item = DB::table('komponen')->get();
$kondisi    =    $item = DB::table('kondisi_k')->get();
$lokasi =    $item = DB::table('lokasi_k')->get();
$kategory   =    $item = DB::table('katerori_k')->get();
$key    =    $item = DB::table('key_k')->get();
$run=[
$komponen,$kondisi,$lokasi,$kategory,$key
];
$view='update_produk';
$data='flight';
$final=[$flight,$data,$run];
// dd($final);
return \view($view,compact('final'));
}else{
$view='input_produk';}
}
}
return \view($view,compact('flights'));
}
// public function a(Request $request)
// { $item = DB::table('item')->where('barcode', $request->barcode)->first();
//  if ($item->pos==1) {
//     return view('pinjam',compact('item'));
// }else {
//     echo "barang sudah di pinjam";
// }
// }
public function b(Request $request)
{ $item = DB::table('item')->where('barcode', $request->barcode)->first();
$kata=1;
$data=[$item,$kata];
if ($item->pos==0) {
return view('kembali',compact('data'));
}else{
$kata='barang tidak di pinjam';
$data=[$item,$kata];
$request->session()->flash('pesan', $data[1]);
// return view('kembali',compact('data'));
return redirect('/pijam')->with('status', 'item tidak di pinjam');;
}
}

public function a(Request $request)
{ $item = DB::table('item')->where('barcode', $request->barcode)->first();
$kata=1;
$data=[$item,$kata];
if ($item->pos==1) {
return view('pinjam',compact('item'));
}else{
$kata='barang tidak di pinjam';
$data=[$item,$kata];
$request->session()->flash('pesan', $data[1]);
// return view('kembali',compact('data'));
return redirect('/pijam')->with('status', 'item sudah di pinjam');;
}
}

public function kategory(Request $request,$tabel,$view)
{
echo $view;
$item = DB::table($tabel)->get();
$data=[$item,$tabel];
return view($view,compact('data'));

}
public function out_view()
{
$flights = DB::table('item_out_table')->get();
return view('find_item',\compact('flights'));
}

public function data_out(Request $request)
{

$item = DB::table('item')->where('barcode', $request->barcode)->first();

return \view('barang_keluar',compact('item'));
}

}
