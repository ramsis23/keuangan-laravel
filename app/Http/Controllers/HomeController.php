<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\JurnalPenerimaan;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
		
        return view('home',[]);
    }
	
    public function profile(){
        return view('profile');
    }
	
	public function profile_update(Request $request){
		
		$conf = User::find(Auth::user()->id);
		$conf->email = $request->email;
		$conf->name = $request->name;
		if($request->password_baru != '' || $request->password_baru != null){
			$conf->password = Hash::make($request->password_baru);
		}
		$conf->save();
		
		if($conf){
			return back()->with('success','Data Berhasil Disimpan');
		}else{
			return back()->with('error','Terjadi Kesalahan Komunikasi Data');
		}
		
	}
	
}
