<?php

use Carbon\Carbon;
use App\Enums\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

if (!function_exists('BulanTahunIndo')) {
	function BulanTahunIndo($tgl)
	{
		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		$bulan = $array_bulan[Carbon::createFromFormat('d/m/Y', $tgl)->format('m') + 0];
		$tahun = Carbon::createFromFormat('d/m/Y', $tgl)->format('Y');
		return strtoupper($bulan) . " " . $tahun;
	}
}

if (!function_exists('replaceRpSeparator')) {
	function replaceRpSeparator($nilai)
	{
		return str_replace('Rp', "", str_replace(',', '', $nilai));
	}
}

if (!function_exists('replaceRp')) {
	function replaceRp($nilai)
	{
		return str_replace('Rp', "", str_replace('.', '', $nilai));
	}
}

if (!function_exists('payment')) {
	function payment()
	{
		$pay = array(
			"TRANSFER",
			"CASH",
			"COD"
		);
		return $pay;
	}
}


if (!function_exists('status_payment')) {
	function status_payment($status)
	{
		if ($status == 1) {
			echo '<span  class="badge rounded-pill badge-soft-primary ">LUNAS</span>';
		}
		if ($status == 2) {
			echo '<span class="badge rounded-pill badge-soft-danger">BELUM LUNAS</span>';
		}
	}
}

if (!function_exists('status_belum_diambil_kurir')) {
	function status_belum_diambil_kurir($status)
	{
		if ($status == null) {
			echo '<span class="badge badge-info">Belum Diambil kurir</span>';
		}
		if ($status != null) {
			echo '<span class="badge badge-primary">Sudah Diambil kurir</span>';
		}
	}
}

if (!function_exists('getListTahun')) {
	function getListTahun()
	{
		$x = intval(date("Y"));
		$len = 2;
		$lang = 3;
		$tahun = [];

		for ($i = ($x - $len); $i <= ($x + $lang); $i++) {
			$tahun[$i] = $i;
		}

		return $tahun;
	}
}
if (!function_exists('getListBulan')) {
	function getListBulan()
	{
		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

		return $array_bulan;
	}
}

if (!function_exists('removeLastString')) {
	function removeLastString($string)
	{
		return substr($string, 0, -1);
	}
}


if (!function_exists('dataVillage')) {
	function dataVillage($village)
	{
		$string = "";
		foreach ($village as $value) {
			$string .= $value->name . ',';
		}
		return substr($string, 0, -1);
	}
}


if (!function_exists('dataRegencie')) {
	function dataRegencie($regencie)
	{
		$string = "";
		foreach ($regencie as $value) {
			$string .= $value->data_regencie->name . ',';
		}
		return substr($string, 0, -1);
	}
}

if (!function_exists('dataProvince')) {
	function dataProvince($province)
	{
		$string = "";
		foreach ($province as $value) {
			$string .= $value->data_province->name . ',';
		}
		return substr($string, 0, -1);
	}
}


if (!function_exists('dataDistrict')) {
	function dataDistrict($district)
	{
		$string = "";
		foreach ($district as $value) {
			$string .= $value->data_district->name . ',';
		}
		return substr($string, 0, -1);
	}
}


if (!function_exists('statusForm')) {
	function statusForm($parm)
	{
		if ($parm == 0) {
			return '<button class="border-0 btn-transition btn btn-secondary">
						<i aria-hidden="true" class="fa fa-fw" title="close"></i> Belum Konfirmasi
				</button>';
		} elseif ($parm == 1) {
			return '<button class="border-0 btn-transition btn btn-success">
					 <i class="fa fa-check"> Sudah Konfirmasi</i>
			 </button>';
		} elseif ($parm == 2) {
			return '<button class="border-0 btn-transition btn btn-warning">
					 <i class="fa fa-fw" aria-hidden="true" title="Copy to use edit"></i> Revisi
			 </button>';
		} else {
			return "";
		}
	}
}

if (!function_exists('jenisPekerjaan')) {
	function jenisPekerjaan($parm)
	{
		if ($parm == 1) {
			return "Pembuatan Baru";
		} else {
			return "Pengembangan";
		}
	}
}
if (!function_exists('typeDokumen')) {
	function typeDokumen($parm)
	{
		if ($parm == 1) {
			return "Pengajuan";
		} else {
			return "Kelengkapan";
		}
	}
}

if (!function_exists('levelUser')) {
	function levelUser($parm)
	{
		if ($parm == "1") {
			return "Superadmin Kominfo";
		} elseif ($parm == "2") {
			return "Verifikasi Kominfo";
		} else {
			return "Perangkat Daerah";
		}
	}
}

if (!function_exists('warnaLog')) {
	function warnaLog($parm)
	{
		//danger, info
		if ($parm == 1) {
			return "badge-warning"; // Permintaan Revisi
		} elseif ($parm == 2) {
			return "badge-success"; //Konfirmasi
		} elseif ($parm == 3) {
			return "badge-dark"; //Perubahan
		} elseif ($parm == 4) {
			return "badge-primary"; //Pembuatan
		} else {
			return "badge-info";
		}
	}
}


if (!function_exists('resizer')) {
	function resizer($fileName, $oldDir, $newDir)
	{
		$maxWidth = 600;
		$maxHeight = 600;
		$fixedWidth = 0;
		$fixedHeight = 0;
		$quality = 80;

		$file = $oldDir . '/' . $fileName;
		$fileDest = $newDir . '/' . $fileName;
		list($width, $height) = getimagesize($file);

		if ($width > $maxWidth || $height > $maxHeight) {
			if ($fixedWidth) {
				$newWidth  = $fixedWidth;
				$newHeight = ($newWidth / $width) * $height;
			} elseif ($fixedHeight) {
				$newHeight = $fixedHeight;
				$newWidth  = ($newHeight / $height) * $width;
			} elseif ($width < $height) {			// image is portrait
				$newHeight = $maxHeight;
				$newWidth  = ($newHeight / $height) * $width;
			} elseif ($width > $height) {			// image is landscape
				$newWidth  = $maxWidth;
				$newHeight = ($newWidth / $width) * $height;
			} else {								          	// image is square
				$newWidth  = $maxHeight;
				$newHeight = $maxHeight;
			}
		} else {
			$newWidth = $width;
			$newHeight = $height;
		}
		$extn = strtolower(pathinfo($file, PATHINFO_EXTENSION));

		// it's a jpeg
		if ($extn == 'jpg' or $extn == 'jpeg') {
			$imageSrc = imagecreatefromjpeg($file);
			// rotate image if necessary
			$exif = getimagesize($file);
			if (isset($exif['Orientation'])) {
				switch ($exif['Orientation']) {
					case 3:
						$imageSrc = imagerotate($imageSrc, 180, 0);
						break;
					case 6:
						$imageSrc = imagerotate($imageSrc, -90, 0);
						list($height, $width) = array($width, $height);
						list($newHeight, $newWidth) = array($newWidth, $newHeight);
						break;
					case 8:
						$imageSrc = imagerotate($imageSrc, 90, 0);
						list($height, $width) = array($width, $height);
						list($newHeight, $newWidth) = array($newWidth, $newHeight);
						break;
				}
			}
			$imageDest = imagecreatetruecolor($newWidth, $newHeight);
			if (imagecopyresampled($imageDest, $imageSrc, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height)) {
				imagejpeg($imageDest, $fileDest, $quality);
				imagedestroy($imageSrc);
				imagedestroy($imageDest);
				return true;
			}
			return false;
		}

		// it's a png
		if ($extn == 'png') {
			$imageSrc  = imagecreatefrompng($file);
			$imageDest = imagecreatetruecolor($newWidth, $newHeight);
			imagealphablending($imageDest, false);
			imagesavealpha($imageDest, true);
			if (imagecopyresampled($imageDest, $imageSrc, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height)) {
				imagepng($imageDest, $fileDest, ($quality / 10) - 1);
				imagedestroy($imageSrc);
				imagedestroy($imageDest);
				return true;
			}
			return false;
		}
	}
}


if (!function_exists('nilaiRatingEmot')) {
	function nilaiRatingEmot($status)
	{
		if ($status == 1) {
			$valueReview = -1;
		} elseif ($status == 2) {
			$valueReview = 1;
		} else {
			$valueReview = 2;
		}

		return $valueReview;
	}
}


if (!function_exists('getDays')) {
	function getDays()
	{
		return [
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu',
			'Sun' => 'Minggu'
		];
	}
}

if (!function_exists('getMonths')) {
	function getMonths()
	{
		return [
			1	=> "Januari",
			2	=> "Februari",
			3	=> "Maret",
			4	=> "April",
			5	=> "Mei",
			6	=> "Juni",
			7	=> "Juli",
			8	=> "Agustus",
			9	=> "September",
			10	=> "Oktober",
			11	=> "November",
			12	=> "Desember"
		];
	}
}


if (!function_exists('timeAgo')) {
	function timeAgo($oldTime, $newTime)
	{
		$timeCalc = strtotime($newTime) - strtotime($oldTime);
		if ($timeCalc >= (60 * 60 * 24 * 30 * 12 * 2)) {
			$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " tahun lalu";
		} else if ($timeCalc >= (60 * 60 * 24 * 30 * 12)) {
			$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30 / 12) . " tahun lalu";
		} else if ($timeCalc >= (60 * 60 * 24 * 30 * 2)) {
			$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " bulan lalu";
		} else if ($timeCalc >= (60 * 60 * 24 * 30)) {
			$timeCalc = intval($timeCalc / 60 / 60 / 24 / 30) . " bulan lalu";
		} else if ($timeCalc >= (60 * 60 * 24 * 2)) {
			$timeCalc = intval($timeCalc / 60 / 60 / 24) . " hari lalu";
		} else if ($timeCalc >= (60 * 60 * 24)) {
			$timeCalc = " Kemarin";
		} else if ($timeCalc >= (60 * 60 * 2)) {
			$timeCalc = intval($timeCalc / 60 / 60) . " jam lalu";
		} else if ($timeCalc >= (60 * 60)) {
			$timeCalc = intval($timeCalc / 60 / 60) . " jam lalu";
		} else if ($timeCalc >= 60 * 2) {
			$timeCalc = intval($timeCalc / 60) . " menit lalu";
		} else if ($timeCalc >= 60) {
			$timeCalc = intval($timeCalc / 60) . " menit lalu";
		} else if ($timeCalc > 0) {
			$timeCalc .= " detik lalu";
		}

		if ($timeCalc == 0) {
			return "1 detik lalu";
		}
		return $timeCalc;
	}
}

if (!function_exists('toRp')) {
	function toRp($parm)
	{
		return 'Rp. ' . number_format(floatval($parm), 0, ',', '.') . ''; //,00
	}
}
if (!function_exists('notoRp')) {
	function notoRp($parm)
	{
		return number_format(floatval($parm), 0, ',', '.') . ''; //,00
	}
}

if (!function_exists('numericToRomanMonth')) {
	function numericToRomanMonth($numericMonth)
	{
		// dd($numericMonth);
		// Check if the input is a valid month (between 1 and 12)
		$map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

		$result = '';

		foreach ($map as $roman => $arabic) {
			$matches = intval($numericMonth / $arabic);
			$result .= str_repeat($roman, $matches);
			$numericMonth %= $arabic;
		}

		return $result;
	}
}

if (!function_exists('kab_kot')) {
	function kab_kot($kota)
	{
		$kota = strtolower(str_replace(["KABUPATEN", "KOTA"], '', $kota));
		$kota = ucwords($kota);
		return $kota;
	}
}

if (!function_exists('kab_singkat')) {
	function kab_singkat($kota)
	{
		if (substr($kota, 0, 9) == "KABUPATEN") {
			return strtoupper("KAB" . substr($kota, 9));
		} else {
			return strtoupper($kota);
		}
	}
}

if (!function_exists('toDecimal')) {
	function toDecimal($parm)
	{
		return number_format(floatval($parm), 0, '', '.');
	}
}

if (!function_exists('formatRpComma')) {
	function formatRpComma($parm)
	{
		return "Rp. " . number_format($parm, 0, ",", ".");
	}
}

if (!function_exists('replaceRp')) {
	function replaceRp($parm)
	{
		$data = str_replace(["Rp. ", ".", "_", ",00"], "", $parm);
		return abs($data);
	}
}

if (!function_exists('formatDatePhp')) {
	function formatDatePhp($parm)
	{
		return date('Y-m-d', strtotime($parm));
	}
}

if (!function_exists('formatDateView')) {
	function formatDateView($parm)
	{
		return date("m/d/Y", strtotime($parm));
	}
}


if (!function_exists('doubleToInt')) {
	function doubleToInt($parm)
	{
		return number_format($parm, 0, '', '');
	}
}


if (!function_exists('formatNoRpComma')) {
	function formatNoRpComma($parm)
	{
		return number_format($parm, 2, ",", ".");
	}
}
if (!function_exists('statusFaktur')) {
	function statusFaktur($status)
	{
		if ($status == "BELUM LUNAS") {
			echo '<span class=" badge bg-primary-subtle text-primary">BELUM LUNAS</span>';
		} else {
			echo '<span class="badge bg-success-subtle text-success">LUNAS</span>';
		}
	}
}
if (!function_exists('statusUser')) {
	function statusUser($status)
	{
		if ($status == "1") {
			echo '<span class=" badge bg-success-subtle text-success">Aktif</span>';
		} else {
			echo '<span class="badge bg-danger-subtle text-danger">Tidak Aktif</span>';
		}
	}
}
if (!function_exists('statusBerangkat')) {
	function statusBerangkat($status)
	{
		if ($status == "belum") {
			echo '<span class="badge rounded-pill badge-soft-primary">Belum Berangkat</span>';
		} else {
			echo '<span class="badge rounded-pill badge-soft-success">Berangkat</span>';
		}
	}
}

if (!function_exists('strPadKode')) {
	function strPadKode($parm)
	{
		return str_pad($parm,  2, "0", STR_PAD_LEFT);
	}
}

if (!function_exists('formatVolume')) {
	function formatVolume($parm)
	{
		return round($parm, 2);
	}
}

if (!function_exists('formatVolume')) {
	function formatAnggaran($parm)
	{
		return round($parm, 2);
	}
}

if (!function_exists('discount')) {
	function discount($discount)
	{
		if ($discount != null) {
			return $discount . '%';
		}
	}
}

if (!function_exists('koma')) {
	function koma($str)
	{
		if ($str != null) {
			echo $str . ', ';
		} else {
			echo null;
		}
	}
}

if (!function_exists('background')) {
	function background()
	{
		echo 'style="color: #FF0000"';
	}
}

if (!function_exists('tglIndo')) {
	function tglIndo($parm)
	{
		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$dataBulan = date('n', strtotime($parm));
		return date('d', strtotime($parm)) . " " . $array_bulan[$dataBulan] . " " . date('Y', strtotime($parm));
	}
}

if (!function_exists('tglLblIndo')) {
	function tglLblIndo($parm)
	{
		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$dataBulan = date('n', strtotime($parm));

		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		$day = date('D', strtotime($parm));
		$tgl = date('d', strtotime($parm));
		$year = date('Y', strtotime($parm));

		$hari = $dayList[$day];
		$bulan = $array_bulan[$dataBulan];
		$tahun = terbilang($year);
		$tanggal = terbilang($tgl);
		return "$hari, tanggal $tanggal,bulan $bulan, tahun $tahun";
		// /Senin, tanggal Sepuluh, bulan Juli, tahun Dua Ribu Tujuh Belas
		// return date('d',strtotime($parm))." ".$array_bulan[$dataBulan]." ".date('Y',strtotime($parm));
	}
}

function penyebut($nilai)
{
	$nilai = abs($nilai);
	$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " " . $huruf[$nilai];
	} else if ($nilai < 20) {
		$temp = penyebut($nilai - 10) . " Belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " Seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " Seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai / 1000000000) . " Milyar" . penyebut(fmod($nilai, 1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
	}
	return $temp;
}

function terbilang($nilai)
{
	if ($nilai < 0) {
		$hasil = "minus " . trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}
	return $hasil;
}

if (!function_exists('angkalTerbilang')) {
	function angkalTerbilang($x)
	{
		$angka = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
		if ($x == 0)
			return "Nol";
		elseif ($x < 12)
			return " " . $angka[$x];
		elseif ($x < 20)
			return angkalTerbilang($x - 10) . " belas";
		elseif ($x < 100)
			return angkalTerbilang($x / 10) . " puluh" . angkalTerbilang($x % 10);
		elseif ($x < 200)
			return "seratus" . angkalTerbilang($x - 100);
		elseif ($x < 1000)
			return angkalTerbilang($x / 100) . " ratus" . angkalTerbilang($x % 100);
		elseif ($x < 2000)
			return "seribu" . angkalTerbilang($x - 1000);
		elseif ($x < 1000000)
			return angkalTerbilang($x / 1000) . " ribu" . angkalTerbilang($x % 1000);
		elseif ($x < 1000000000)
			return angkalTerbilang($x / 1000000) . " juta" . angkalTerbilang($x % 1000000);
	}
}
if (!function_exists('hariIndo')) {
	function hariIndo($parm)
	{
		$day = date('D', strtotime($parm));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}
}

if (!function_exists('tglIndoAngka')) {
	function tglIndoAngka($parm)
	{
		if ($parm != null) {
			return date('d M Y', strtotime($parm));
		}
	}
}

if (!function_exists('tglIndoAngkaJam')) {
	function tglIndoAngkaJam($parm)
	{
		if ($parm != null) {
			return date('d-m-Y H:i:s', strtotime($parm));
		}
	}
}

if (!function_exists('waktuIndo')) {
	function waktuIndo($parm)
	{
		return date('H:i', strtotime($parm));
	}
}

if (!function_exists('tglWaktuIndo')) {
	function tglWaktuIndo($parm)
	{
		if ($parm == null) {
			return "-";
		}
		if ($parm == '0000-00-00 00:00:00') {
			return "-";
		}
		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$dataBulan = date('n', strtotime($parm));
		$dataWaktu = date('H:i', strtotime($parm));
		return date('d', strtotime($parm)) . " " . $array_bulan[$dataBulan] . " " . date('Y', strtotime($parm)) . " " . $dataWaktu . " WIB";
	}
}

if (!function_exists('tglWaktuIndoAngka')) {
	function tglWaktuIndoAngka($parm)
	{
		if ($parm == '0000-00-00 00:00:00') {
			return "-";
		}
		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$dataBulan = date('m', strtotime($parm));
		$dataWaktu = date('H:i', strtotime($parm));
		return date('d', strtotime($parm)) . "-" . $dataBulan . "-" . date('Y', strtotime($parm)) . " " . $dataWaktu;
	}
}

if (!function_exists('hariTglWaktuIndo')) {
	function hariTglWaktuIndo($parm)
	{
		if ($parm == '0000-00-00 00:00:00') {
			return "-";
		}
		$array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$dataBulan = date('n', strtotime($parm));

		$array_hari = array(1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
		$dataHari = date('N', strtotime($parm));

		$dataWaktu = date('H:i', strtotime($parm));

		return $array_hari[$dataHari] . ", " . date('d', strtotime($parm)) . " " . $array_bulan[$dataBulan] . " " . date('Y', strtotime($parm)) . " " . $dataWaktu;
	}
}

if (!function_exists('timeInterval')) {
	function timeInterval($start, $end)
	{
		$date1 = date_create($start);
		$date2 = date_create($end);
		$diff = date_diff($date1, $date2);
		$jam = $diff->format('%h') + ($diff->format('%a') * 24);
		$menit = $diff->format('%i') + ($diff->format('%a') * 24);
		$detik = $diff->format('%s') + ($diff->format('%a') * 24);
		$time = ['jam' => $jam, 'menit' => $menit, 'detik' => $detik];
		return $time;
	}
}

if (!function_exists('timeInterval24')) {
	function timeInterval24($start, $end)
	{
		$date1 = date_create($start);
		$date2 = date_create($end);
		$diff = date_diff($date1, $date2);
		$jam = $diff->format('%h') + ($diff->format('%a') * 24);
		$menit = $diff->format('%i') + ($diff->format('%a') * 24);
		$detik = $diff->format('%s') + ($diff->format('%a') * 24);
		$time = Date('H:i:s', strtotime($jam . ':' . $menit . ':' . $detik));
		return $time;
	}
}

if (!function_exists('dateDiff')) {
	function dateDiff($parm)
	{
		$datetime1 = new DateTime();
		$datetime2 = new DateTime($parm);
		$interval = $datetime1->diff($datetime2);

		$year = $interval->format('%y');
		$month = $interval->format('%m');
		$day = $interval->format('%a');
		$hour = $interval->format('%h');
		$min = $interval->format('%i');

		$words = "";
		if ($year > 0) {
			$words .= $year;
			if ($year == 1) {
				$words .= " year ";
			} else {
				$words .= " years ";
			}
		}
		if ($month > 0) {
			$words .= $month;
			if ($month == 1) {
				$words .= " month ";
			} else {
				$words .= " months ";
			}
		}
		if ($day > 0) {
			$words .= $day;
			if ($day == 1) {
				$words .= " day ";
			} else {
				$words .= " days ";
			}
		}
		if ($hour > 0) {
			$words .= $hour;
			if ($hour == 1) {
				$words .= " hour ";
			} else {
				$words .= " hours ";
			}
		}
		if ($min > 0) {
			$words .= $min;
			if ($min == 1) {
				$words .= " min ";
			} else {
				$words .= " mins ";
			}
		}

		$con = $datetime1 > $datetime2 ? " ago" : " later";

		return $words . $con;
	}
}

if (!function_exists('collect_count')) {
	function collect_count($array, $count)
	{
		$return = [];
		for ($i = 0; $i <= $count - 1; $i++) {
			if (count($array) >= $count)
				array_push($return, $array[$i]);
		}
		return collect($return);
	}
}

if (!function_exists('same_collection')) {
	function same_collection($collection1, $collection2)
	{
		if (count($collection1->diffAssoc($collection2)) == 0)
			return true;
		return false;
	}
}

if (!function_exists('nullToZero')) {
	function nullToZero($num)
	{
		if ($num == NULL) {
			return 0;
		}

		return $num;
	}
}

if (!function_exists('zeroToNull')) {
	function zeroToNull($num)
	{
		if ($num == 0) {
			return null;
		}

		return $num;
	}
}

if (!function_exists('emptyToDash')) {
	function emptyToDash($ch)
	{
		if ($ch == NULL || $ch == '') {
			return '-';
		}

		return $ch;
	}
}

if (!function_exists('generateNik')) {
	function generateNik()
	{
		return strval(time()) . strval(mt_rand(1000, 9999));
	}
}

if (!function_exists('parseFormat')) {
	function parseFormat($tgl)
	{
		$tgl = Carbon::createFromFormat('d/m/Y', $tgl)->format('Y-m-d');
		return $tgl;
	}
}

if (!function_exists('parseFormat2')) {
	function parseFormat2($tgl)
	{
		$tgl = Carbon::createFromFormat('Y-m-d', $tgl)->format('d/m/Y');
		return $tgl;
	}
}

if (!function_exists('getListTahun')) {
	function getListTahun()
	{
		$x = intval(date("Y"));
		$len = 10;
		$tahun = [];

		for ($i = ($x - $len); $i <= ($x + $len); $i++) {
			$tahun[$i] = $i;
		}

		return $tahun;
	}
}

if (!function_exists('getExcelColumns')) {
	function getExcelColumns()
	{
		$x = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BB', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ'];

		return $x;
	}
}

if (!function_exists('dateFormat')) {
	function dateFormat($val, $formatFrom, $formatTo = 'Y-m-d')
	{
		$val = str_replace("/", "-", $val);

		if ($val == NULL || $val == "") {
			return null;
		}

		$date = date_create_from_format($formatFrom, $val);
		if ($date === FALSE) {
			return null;
		}

		return date_format($date, $formatTo);
	}
}

if (!function_exists('convert')) {
	function convert($size)
	{
		$unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
		return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
	}
}

if (!function_exists('getRangeData')) {
	function getRangeData($range, $total)
	{
		$sisa = $total % $range;
		$max = $total / $range;
		$max = intval($max) * $range;
		$range_picker = [];

		for ($i = 1; $i <= $max; $i += $range) {
			$range_picker[$i - 1] = angkaIndo($i) . " - " . angkaIndo(($i - 1 + $range));
		}

		if ($sisa > 0) {
			$range_picker[$max] = angkaIndo(($max + 1)) . " - " . angkaIndo(($max + $sisa));
		}

		return $range_picker;
	}
}

if (!function_exists('angkaIndo')) {
	function angkaIndo($num)
	{
		return number_format($num, 0, ",", ".");
	}
}


if (!function_exists('getRomawi')) {
	function getRomawi($bln)
	{
		switch ($bln) {
			case 1:
				return "I";
				break;
			case 2:
				return "II";
				break;
			case 3:
				return "III";
				break;
			case 4:
				return "IV";
				break;
			case 5:
				return "V";
				break;
			case 6:
				return "VI";
				break;
			case 7:
				return "VII";
				break;
			case 8:
				return "VIII";
				break;
			case 9:
				return "IX";
				break;
			case 10:
				return "X";
				break;
			case 11:
				return "XI";
				break;
			case 12:
				return "XII";
				break;
		}
	}
}


if (!function_exists("randomString")) {
	function randomString($min, $max)
	{
		return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789'), $min, $max);
	}
}



if (!function_exists("nullableVariable")) {
	function nullableVariable($data, $field)
	{
		return isset($data) ? $data->$field : '';
	}
}


if (!function_exists('getStorage')) {
	function getStorage($value)
	{
		if ($value != null) {
			return base64_encode(Storage::disk('resources')->get($value));
		}
		return null;
	}
}

if (!function_exists("setFieldCustom")) {
	function setFieldCustom($value, $type)
	{
		$html = "";
		$value = (int)$value;

		if ($type == 'status') {
			if ($value == 1) {
				$html = '<span class="badge border border-danger text-danger">Tidak Aktif</span>';
			} else {
				$html = '<span class="badge border border-success text-success">Aktif</span>';
			}
		}

		if ($type == 'menu') {
			if ($value == 1) {
				$html = '<span class="badge border border-primary text-primary">Default</span>';
			} else {
				$html = '<span class="badge border border-success text-success">URL</span>';
			}
		}

		if ($type == 'publish') {
			if ($value == 1) {
				$html = '<span class="badge border border-primary text-primary">Draft</span>';
			} else {
				$html = '<span class="badge border border-success text-success">Publish</span>';
			}
		}

		if ($type == 'post') {
			if ($value == 1) {
				$html = '<span class="badge border border-primary text-primary">Berita</span>';
			} elseif ($value == 2) {
				$html = '<span class="badge border border-warning text-warning">Artikel</span>';
			} elseif ($value == 3) {
				$html = '<span class="badge border border-info text-info">Pengumuman</span>';
			}
			else{
				$html = '<span class="badge border border-success text-success">Section Post</span>';
			}
		}

		return $html;
	}
}