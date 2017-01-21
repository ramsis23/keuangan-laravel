<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaksi;
use App\JurnalPenerimaan;
use App\PaketPembayaran;
use App\ItemPembayaran;
use App\User;
use Auth;
use DB;
use Validator;

class BendaharaPenerimaan extends Controller
{
    //
	public function input_data(){
		$data = JurnalPenerimaan::join('transaksi', 'penerimaan.id_transaksi', '=', 'transaksi.id')
								->join('kode_rekening','penerimaan.kode_rekening','=','kode_rekening.id_rekening')
								->orderBy('transaksi.created_at','desc')
								->take(10)
								->get();
		return view('penerimaan.input',compact('data'));
	}
	
	public function upload_data(Request $request){
		//------------------------- Validation -----------------------------
		$validator = Validator::make($request->all(), [
            'nim_mhs' => 'required',
            'nama_mhs' => 'required',
			//'tanggal' => 'required|date_format:Y-m-d',
            'setoran' => 'numeric'
        ]);

        if ($validator->fails()) {
            return back()
					->withErrors($validator)
					->withInput();
        }
		//------------------------ End Validation -------------------------
		
		$total_tr = $request->total_data;
		
		if($total_tr == 0){
			return back()->with('error','Anda Belum Memilih Satupun Kode Rekening');
		}
		
		$i = 1;
		while($i <= $total_tr){
			
			echo $request->input('kode_rek_'.$i)." - ".$request->input('setoran_'.$i)." <br>";
			
			if($request->input('kode_rek_'.$i)){
				$jurnal = new Transaksi($request->all());
				$jurnal->id = uniqueId($i);
				$jurnal->created_by = Auth::user()->id;
				$jurnal->save();
				
				$transaksi = new JurnalPenerimaan($request->all());
				$transaksi->kode_rekening = $request->input('kode_rek_'.$i);
				$transaksi->setoran = $request->input('setoran_'.$i);
				$transaksi->id_transaksi = $jurnal->id;
				$transaksi->save();
			}
			
			$i++;
		}
		
		if($transaksi){
			return back()->with('success','Data Berhasil Disimpan');
		}else{
			return back()->with('error','Terjadi Kesalahan Komunikasi Data');
		}
		
	}
	
	public function riwayat(){
		$data = JurnalPenerimaan::join('transaksi', 'penerimaan.id_transaksi', '=', 'transaksi.id')
								->join('kode_rekening','penerimaan.kode_rekening','=','kode_rekening.id_rekening')
								->orderBy('transaksi.created_at','desc')
								->paginate(20);
		return view('penerimaan.riwayat',compact('data'));
	}
	
	public function laporan_harian(){		
		return view('penerimaan.laporan_harian');
	}
	
	public function laporan_harian_load(Request $request){
		$tanggal = $request->tanggal;
		
		return view('penerimaan.laporan_harian_load',compact('tanggal'));
	}
	
	public function get_laporan_harian(Request $request){
				
		$tanggal = $request->tanggal;
		
		$data = DB::table('penerimaan')
						->select('nim_mhs','nama_mhs','prodi','tanggal')
						->where('tanggal','=',$tanggal)
						->distinct()
						->get();
							
		if($request->ajax()){
			return view('penerimaan._item_laporan_harian')->with(compact('data','tanggal'))->render();
		}
	}
	
	public function laporan_bulanan(){		
		return view('penerimaan.laporan_bulanan');
	}
	
	public function laporan_bulanan_load(Request $request){
		$maxDay = date("t",strtotime($request->tanggal));
		$tanggal = $request->tanggal;
		
		return view('penerimaan.laporan_bulanan_load',compact('maxDay','tanggal'));
	}
	
	public function item_laporan_bulanan(Request $request){
				
		$tanggal = $request->tanggal;
		$bulan = date("m",strtotime($request->tanggal));
		$maxDay = $request->maxDay;
		
		$data = DB::table('penerimaan')
						->select('kode_rekening')
						->whereRaw('extract(month from tanggal) = ?', [$bulan])
						->distinct()
						->get();
						
		//var_dump($data);
							
		if($request->ajax()){
			return view('penerimaan._item_laporan_bulanan')->with(compact('data','tanggal','maxDay'))->render();
		}
	}
	
	public function laporan_mahasiswa(){		
		return view('penerimaan.laporan_mahasiswa');
	}
	
	public function laporan_mahasiswa_load(Request $request){
		$nim = $request->nim;		
		return view('penerimaan.laporan_mahasiswa_load',compact('nim'));
	}
	
	public function item_laporan_mahasiswa(Request $request){
		
		$nim = $request->nim;
		
		$data = ItemPembayaran::where('paket',1)->get();
						
		//var_dump($data);
							
		if($request->ajax()){
			return view('penerimaan._item_laporan_mahasiswa')->with(compact('data','nim'))->render();
		}
	}
	
}
