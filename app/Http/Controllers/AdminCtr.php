<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\KodeRekening;
use App\SiteConfig;
use App\TandaTangan;
use App\JurnalPenerimaan;
use App\PaketPembayaran;
use App\ItemPembayaran;
use Auth;
use DB;
use Validator;
use File;
use Image;


class AdminCtr extends Controller
{
    //
	public function kode_rekening(){
		$data = KodeRekening::paginate(20);
		return view('admin.kode_rekening',compact('data'));
	}
	
	public function setting(){
		$conf = SiteConfig::find(1);
		$ttd1 = TandaTangan::find(1);
		$ttd2 = TandaTangan::find(2);
		$ttd3 = TandaTangan::find(3);
		return view('admin.setting',compact('conf','ttd1','ttd2','ttd3'));
	}
	
	public function update_setting(Request $request){
		
		$path=public_path().'/upload/img/';
		
		$conf = SiteConfig::find(1);
		$conf->name_app = $request->name_app;
		if ($request->hasFile('file_logo')) {
			$name_cover = 'logo200x200.'.$request->file('file_logo')->getClientOriginalExtension();
			
			//Original
			$request->file('file_logo')->move($path, $name_cover);
			
			//Thumbnails
			$image = $path.$name_cover;
			$thumb1 = Image::make($image);
			$thumb1->fit(200, 200)->save($path.$name_cover)->destroy(); //crop the image fit the size
			
			$conf->logo = $name_cover;
		}
		if ($request->hasFile('file_welcome')) {
			$name_cover = 'welcome_image750x308.'.$request->file('file_welcome')->getClientOriginalExtension();
			
			//Original
			$request->file('file_welcome')->move($path, $name_cover);
			
			//Thumbnails
			$image = $path.$name_cover;
			$thumb1 = Image::make($image);
			$thumb1->fit(750, 308)->save($path.$name_cover)->destroy(); //crop the image fit the size
			
			$conf->image_welcome = $name_cover;
		}
		$conf->save();
		
		$ttd1 = TandaTangan::find(1);
		$ttd1->nama = $request->bendahara_penerimaan;
		$ttd1->jabatan = $request->jabatan_penerimaan;
		$ttd1->save();
		
		$ttd2 = TandaTangan::find(2);
		$ttd2->nama = $request->ketua_keuangan;
		$ttd2->jabatan = $request->jabatan_ketua;
		$ttd2->save();
		
		$ttd3 = TandaTangan::find(3);
		$ttd3->nama = $request->ketua;
		$ttd3->jabatan = $request->ketua_jabatan;
		$ttd3->save();
		
		if($conf && $ttd1 && $ttd2 && $ttd3){
			return back()->with('success','Data Berhasil Disimpan');
		}else{
			return back()->with('error','Terdapat Data Yang Tidak Bisa Disimpan');
		}
		
	}
	
	public function rekening_add(Request $request){
		
		$conf = new KodeRekening($request->all());
		$conf->save();
		
		if($conf){
			return back()->with('success','Data Berhasil Disimpan');
		}else{
			return back()->with('error','Terjadi Kesalahan Komunikasi Data');
		}
		
	}
	
	public function rekening_edit(Request $request){
		
		if($request->id_rekening != $request->no_rekening){
			$cek = JurnalPenerimaan::where('kode_rekening',$request->id_rekening)->count();
			if($cek > 0){
				return back()->with('error','Rekening Tidak Dapat Diedit Karena Sedang Digunakan');
			}
		}
		
		$conf = KodeRekening::find($request->id_rekening);
		$conf->id_rekening = $request->no_rekening;
		$conf->nama_rekening = $request->nama_rekening;
		$conf->balance = $request->balance;
		$conf->biaya = $request->biaya;
		$conf->save();
		
		if($conf){
			return back()->with('success','Data Berhasil Diupdate');
		}else{
			return back()->with('error','Terjadi Kesalahan Komunikasi Data');
		}
		
	}
	
	public function rekening_remove(Request $request){
		
		$find = JurnalPenerimaan::where('kode_rekening',$request->id)->count();
		
		if($find > 0){
			return back()->with('error','Rekening Tidak Dapat Hapus Karena Sedang Digunakan');
		}
		
		$conf = KodeRekening::destroy($request->id);
		
		if($conf){
			return back()->with('success','Data Berhasil Dihapus');
		}else{
			return back()->with('error','Terjadi Kesalahan Komunikasi Data');
		}
		
	}
	
	public function paket(){
		$data = PaketPembayaran::all();
		return view('admin.paket_pembayaran',compact('data'));
	}
	
	public function paket_baru(Request $request){
		
		$conf = new PaketPembayaran($request->all());
		$conf->save();
		
		if($conf){
			return back()->with('success','Data Berhasil Disimpan');
		}else{
			return back()->with('error','Terjadi Kesalahan Komunikasi Data');
		}
	}
	
	public function paket_item($id){
		$paket = PaketPembayaran::find($id);
		$data = ItemPembayaran::where('paket',$id)->get();
		return view('admin.item_pembayaran',compact('paket','data'));
	}
	
	public function paket_item_new(Request $request){
		$paket = $request->paket;
		$max = $request->total_data;
		$i=0;
		while($i<=$max){
			if($request->input('kode_rek_'.$i)){
				$data = new ItemPembayaran();
				$data->paket = $paket;
				$data->rekening = $request->input('kode_rek_'.$i);
				$data->save();
			}
			$i++;
		}
		
		if($data){
			return back()->with('success','Data Berhasil Disimpan');
		}else{
			return back()->with('error','Terjadi Kesalahan Komunikasi Data');
		}
	}
		
}
