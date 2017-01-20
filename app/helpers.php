<?php
function uniqueId($id){
	$data = Auth::user()->id."-".date('Y-m-d H:i:s').'-'.$id;
	return md5($data);
}

function rupiah($angka){
	$jadi = "Rp " . number_format($angka,0,',','.'); //0 angka dibelakang koma
	return $jadi;
}

// Konversi tanggal ke bahasa indonesia
function format_indo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);               
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1]. " ". $tahun;
    return($result);
}

function bulanTahun($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);               
    $bulan = substr($date, 5, 2);
    $result = $BulanIndo[(int)$bulan-1]. " Tahun ". $tahun;
    return($result);
}

function bulanTahun2($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);               
    $bulan = substr($date, 5, 2);
    $result = $BulanIndo[(int)$bulan-1]. " ". $tahun;
    return($result);
}

?>