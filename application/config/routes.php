<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['mahasiswa'] = 'Mahasiswa/masukUjian';
// $route['login'] = 'AuthController/login';
// $route['logout'] = 'AuthController/logout';
$route['login'] = 'Mahasiswa/masukUjian';
$route['logout'] = 'Mahasiswa/masukUjian';
$route['register'] = 'AuthController/register';
$route['banksoal'] = 'BankSoal/index';
$route['bankSoal/(:num)'] = 'BankSoal/daftarBab/$1';
$route['bankSoal/(:num)/tambah_ujian'] = 'Ujian/tambahUjian/$1';
$route['bankSoal/(:num)/tambah_bab'] = 'BankSoal/tambahBab/$1';
$route['bankSoal/(:num)/bab/(:num)'] = 'Soal/daftarSoal/$1/$2';
$route['bankSoal/(:num)/detail_ujian/(:num)'] = 'Ujian/detailUjian/$1/$2';
$route['bankSoal/(:num)/update_ujian/(:num)'] = 'Ujian/updateUjian/$1/$2';
$route['bankSoal/(:num)/ubah_ujian/(:num)'] = 'Ujian/ubahUjian/$1/$2';
$route['bankSoal/(:num)/ubah_bab/(:num)'] = 'BankSoal/ubahBab/$1/$2';
$route['bankSoal/(:num)/hapus_ujian/(:num)'] = 'Ujian/hapusUjian/$1/$2';
$route['bankSoal/(:num)/hapus_bab/(:num)'] = 'BankSoal/hapusBab/$1/$2';
$route['bankSoal/(:num)/simpan_ujian'] = 'Ujian/simpanUjian/$1';
$route['bankSoal/(:num)/simpan_bab'] = 'BankSoal/simpanBab/$1';
$route['bankSoal/(:num)/bab/(:num)/tambah_soal'] = 'Soal/tambahSoal/$1/$2';
$route['bankSoal/(:num)/bab/(:num)/detail_soal/(:num)'] = 'Soal/detailSoal/$1/$2/$3';
$route['bankSoal/(:num)/bab/(:num)/simpan_soal'] = 'Soal/simpanSoal/$1/$2';
$route['bankSoal/(:num)/bab/(:num)/ubah_soal/(:num)'] = 'Soal/ubahSoal/$1/$2/$3';
$route['bankSoal/(:num)/bab/(:num)/hapus_soal/(:num)'] = 'Soal/hapusSoal/$1/$2/$3';
$route['bankSoal/(:num)/update_bab/(:num)'] = 'BankSoal/updateBab/$1/$2';
$route['banksoal/mahasiswa']='Mahasiswa/masukUjian';
$route['banksoal/ujian/mendaftar_ujian']='Mahasiswa/mendaftarUjian';
$route['banksoal/mata_kuliah/tambah_mata_kuliah']='BankSoal/tambahMataKuliah';
$route['banksoal/mata_kuliah/simpan_mata_kuliah']='MataKuliah/simpanMataKuliah';
$route['banksoal/hasil_ujian']='Ujian/hasilUjian';
$route['banksoal/form_hasil_ujian']='Ujian/formHasilUjian';
$route['banksoal/mata_kuliah/(:num)/hapus_mata_kuliah']='MataKuliah/deleteMataKuliah/$1';
$route['ujian/detail_ujian/(:num)']='Mahasiswa/detailUjian/$1';
$route['ujian/mulai_ujian/(:num)']='Mahasiswa/mulaiUjian/$1';
$route['ujian/masuk_ujian/(:num)']='Mahasiswa/masukUjian/$1';
$route['bankSoal/save-code']='Ujian/saveCode';
$route['ujian/simpan_jawaban_dipilih']='Mahasiswa/simpanJawabanDipilih';
$route['ujian/hasil_ujian/(:num)']='Mahasiswa/hasilUjian/$1';
$route['ujian/export/(:num)']='Ujian/exportToExcel/$1';


