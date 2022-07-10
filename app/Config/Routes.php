<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth\AuthController');
// $routes->setDefaultController('Admin\Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    // UKPD
    $routes->get('ukpd', 'Admin\Ukpd::index');
    $routes->post('save/ukpd', 'Admin\Ukpd::save');
    $routes->get('edit/ukpd', 'Admin\Ukpd::edit');
    $routes->post('update/ukpd', 'Admin\Ukpd::update');
    $routes->post('delete/ukpd', 'Admin\Ukpd::delete');

    //J_Penindakan
    $routes->get('jenis_penindakan', 'Admin\Penindakan::index');
    $routes->post('save/jenis_penindakan', 'Admin\Penindakan::save');
    $routes->get('edit/jenis_penindakan', 'Admin\Penindakan::edit');
    $routes->post('update/jenis_penindakan', 'Admin\Penindakan::update');
    $routes->post('delete/jenis_penindakan', 'Admin\Penindakan::delete');

    //Jenis_Kendaraan
    $routes->get('jenis_kendaraan', 'Admin\JenisKendaraan::index');
    $routes->post('save/jenis_kendaraan', 'Admin\JenisKendaraan::save');
    $routes->get('edit/jenis_kendaraan', 'Admin\JenisKendaraan::edit');
    $routes->post('update/jenis_kendaraan', 'Admin\JenisKendaraan::update');
    $routes->post('delete/jenis_kendaraan', 'Admin\JenisKendaraan::delete');

    //K_Kendaraan
    $routes->get('k_kendaraan', 'Admin\Kendaraan::index');
    $routes->post('save/k_kendaraan', 'Admin\Kendaraan::save');
    $routes->get('edit/k_kendaraan', 'Admin\Kendaraan::edit');
    $routes->post('update/k_kendaraan', 'Admin\Kendaraan::update');
    $routes->post('delete/k_kendaraan', 'Admin\Kendaraan::delete');

    // T_Kendaraan
    $routes->get('type_kendaraan', 'Admin\Typekendaraan::index');
    $routes->post('save/type_kendaraan', 'Admin\Typekendaraan::save');
    $routes->get('edit/type_kendaraan', 'Admin\Typekendaraan::edit');
    $routes->post('update/type_kendaraan', 'Admin\Typekendaraan::update');
    $routes->post('delete/type_kendaraan', 'Admin\Typekendaraan::delete');

    // Pool Penyimpanan
    $routes->get('pool_penyimpanan', 'Admin\PoolPenyimpanan::index');
    $routes->post('save/pool_penyimpanan', 'Admin\PoolPenyimpanan::save');
    $routes->get('edit/pool_penyimpanan', 'Admin\PoolPenyimpanan::edit');
    $routes->post('update/pool_penyimpanan', 'Admin\PoolPenyimpanan::update');
    $routes->post('delete/pool_penyimpanan', 'Admin\PoolPenyimpanan::delete');

    //rolemanagement
    $routes->get('role_management', 'Admin\RoleManagement::index');
    $routes->post('save/role_management', 'Admin\RoleManagement::save');
    $routes->get('edit/role_management', 'Admin\RoleManagement::edit');
    $routes->post('update/role_management', 'Admin\RoleManagement::update');
    $routes->post('delete/role_management', 'Admin\RoleManagement::delete');

    //usersmanagement
    $routes->get('usersManagement', 'Admin\UsersManagement::index');
    $routes->post('save/usersManagement', 'Admin\UsersManagement::save');
    $routes->get('edit/usersManagement', 'Admin\UsersManagement::edit');
    $routes->post('update/usersManagement', 'Admin\UsersManagement::update');
    $routes->post('delete/usersManagement', 'Admin\UsersManagement::delete');
    $routes->post('update_status/usersManagement', 'Admin\UsersManagement::update_status');
    // statusSurat
    $routes->get('statusSurat', 'Admin\StatusSurat::index');
    $routes->post('save/statusSurat', 'Admin\StatusSurat::save');
    $routes->get('edit/statusSurat', 'Admin\StatusSurat::edit');
    $routes->post('update/statusSurat', 'Admin\StatusSurat::update');
    $routes->post('delete/statusSurat', 'Admin\StatusSurat::delete');

    // status Bap
    $routes->get('statusBap', 'Admin\StatusBap::index');
    $routes->post('save/statusBap', 'Admin\StatusBap::save');
    $routes->get('edit/statusBap', 'Admin\StatusBap::edit');
    $routes->post('update/statusBap', 'Admin\statusBap::update');
    $routes->post('delete/statusBap', 'Admin\statusBap::delete');

    // Unit / Regu
    $routes->get('unit_penindak', 'Admin\UnitPenindak::index');
    $routes->post('save/unit_penindak', 'Admin\UnitPenindak::save');
    $routes->get('edit/unit_penindak', 'Admin\UnitPenindak::edit');
    $routes->post('update/unit_penindak', 'Admin\UnitPenindak::update');
    $routes->post('delete/unit_penindak', 'Admin\UnitPenindak::delete');

    // Lokasi Sidang
    $routes->get('lokasi_sidang', 'Admin\LokasiSidang::index');
    $routes->post('save/lokasi_sidang', 'Admin\LokasiSidang::save');
    $routes->get('edit/lokasi_sidang', 'Admin\LokasiSidang::edit');
    $routes->post('update/lokasi_sidang', 'Admin\LokasiSidang::update');
    $routes->post('delete/lokasi_sidang', 'Admin\LokasiSidang::delete');

    // Pasal Pelanggaran
    $routes->get('pasal_pelanggaran', 'Admin\PasalPelanggaran::index');
    $routes->post('save/pasal_pelanggaran', 'Admin\PasalPelanggaran::save');
    $routes->get('edit/pasal_pelanggaran', 'Admin\PasalPelanggaran::edit');
    $routes->post('update/pasal_pelanggaran', 'Admin\PasalPelanggaran::update');
    $routes->post('delete/pasal_pelanggaran', 'Admin\PasalPelanggaran::delete');

    // Jenis Pelanggaran
    $routes->get('jenis_pelanggaran', 'Admin\JenisPelanggaran::index');
    $routes->post('save/jenis_pelanggaran', 'Admin\JenisPelanggaran::save');
    $routes->get('edit/jenis_pelanggaran', 'Admin\JenisPelanggaran::edit');
    $routes->post('update/jenis_pelanggaran', 'Admin\JenisPelanggaran::update');
    $routes->post('delete/jenis_pelanggaran', 'Admin\JenisPelanggaran::delete');

    // BAP Penindakan
    $routes->get('jenis_bap', 'Admin\JenisBap::index');
    $routes->post('save/jenis_bap', 'Admin\JenisBap::save');
    $routes->get('edit/jenis_bap', 'Admin\JenisBap::edit');
    $routes->post('update/jenis_bap', 'Admin\JenisBap::update');
    $routes->post('delete/jenis_bap', 'Admin\JenisBap::delete');
});

// Petugas
$routes->get('/petugas/dashboard', 'Petugas\Dashboard::index');
$routes->get('/petugas/bap', 'Petugas\BapController::index');
$routes->get('/petugas/laporanPenindakan', 'Petugas\LaporanPenindakan::index');
$routes->get('/petugas/tambah_penindakan/(:num)', 'Petugas\LaporanPenindakan::add_penindakan/$1');
$routes->post('/petugas/laporanPenindakan/getPoolPenyimpanan', 'Petugas\LaporanPenindakan::getPoolPenyimpanan');
$routes->post('/petugas/laporanPenindakan/getKlasifikasiKendaraan', 'Petugas\LaporanPenindakan::getKlasifikasiKendaraan');
$routes->post('/petugas/laporanPenindakan/getTypeKendaraan', 'Petugas\LaporanPenindakan::getTypeKendaraan');
$routes->post('/petugas/laporanPenindakan/save', 'Petugas\LaporanPenindakan::save');

$routes->post('/petugas/laporanPenindakan/edit-data', 'Petugas\LaporanPenindakan::editData');
$routes->post('/petugas/laporanPenindakan/hapus', 'Petugas\LaporanPenindakan::hapus');
$routes->post('/petugas/laporanPenindakan/update', 'Petugas\LaporanPenindakan::update');
$routes->get('/petugas/laporanPenindakan/view/(:any)', 'Petugas\LaporanPenindakan::view/$1');

// kota
$routes->post('/petugas/laporanPenindakan/getKota', 'Petugas\LaporanPenindakan::getKota');
$routes->post('/petugas/laporanPenindakan/getKecamatan', 'Petugas\LaporanPenindakan::getKecamatan');
$routes->post('/petugas/laporanPenindakan/getKelurahan', 'Petugas\LaporanPenindakan::getKelurahan');
// operator
$routes->get('/operator/dashboard/', 'Operator\Dashboard::index');
// surat pengeluaran
$routes->get('/operator/suratPengeluaran', 'Operator\SuratPengeluaran::index');
$routes->get('/operator/suratPengeluaran/(:num)', 'Operator\SuratPengeluaran::detail_surat/$1');
$routes->get('/operator/arsipSurat', 'Operator\SuratPengeluaran::arsipSuratPengeluaran');
$routes->get('/operator/tambahPengeluaran', 'Operator\SuratPengeluaran::tambahSurat');
$routes->get('/operator/edit_surat/(:num)', 'Operator\SuratPengeluaran::editSurat/$1');
// getBap
$routes->post('/operator/getNoBap', 'Operator\SuratPengeluaran::getNoBap');
// $routes->get('/operator/editPengeluaran/(:num)', 'Operator\SuratPengeluaran::editSurat/$1');
$routes->get('/operator/getUkpdId', 'Operator\SuratPengeluaran::ukpdData');
$routes->post('/operator/saveSurat', 'Operator\SuratPengeluaran::saveSurat');
$routes->get('/operator/editSurat', 'Operator\SuratPengeluaran::edit');
$routes->post('/operator/update_surat', 'Operator\SuratPengeluaran::update_surat');
$routes->post('/operator/hapusSurat', 'Operator\SuratPengeluaran::hapus');

// Bap
$routes->get('/operator/noBap', 'Operator\BapController::index');
$routes->post('/operator/save/noBap', 'Operator\BapController::save');
$routes->get('/operator/edit/noBap', 'Operator\BapController::edit');
$routes->post('/operator/update/noBap', 'Operator\BapController::update');
$routes->post('/operator/delete/noBap', 'Operator\BapController::delete');

// laporan penindakan
$routes->get('/operator/laporan_penindakan', 'Operator\LaporanPenindakan::index');
$routes->post('/operator/laporan_penindakan/getBap', 'Operator\LaporanPenindakan::getBap');
$routes->post('/operator/laporan_penindakan/getPool', 'Operator\LaporanPenindakan::getPool');
$routes->post('/operator/laporan_penindakan/getTypeKendaraan', 'Operator\LaporanPenindakan::getTypeKendaraan');
$routes->post('/operator/laporan_penindakan/edit', 'Operator\LaporanPenindakan::Edit');
$routes->post('/operator/laporan_penindakan/save', 'Operator\LaporanPenindakan::Save');
$routes->get('/operator/laporan_penindakan/tambah_penindakan', 'Operator\LaporanPenindakan::tambah_penindakan');
$routes->post('/operator/laporan_penindakan/add', 'Operator\LaporanPenindakan::add');
$routes->post('/operator/laporan_penindakan/delete', 'Operator\LaporanPenindakan::Delete');
$routes->get('/operator/laporan_penindakan/detail_data/(:any)', 'Operator\LaporanPenindakan::detail_data/$1');
$routes->get('/operator/laporan_penindakan/download/(:any)', 'Operator\LaporanPenindakan::download/$1');

// Pengantar Sidang
$routes->get('/operator/pengantar_sidang', 'Operator\PengantarSidang::index');
$routes->POST('/operator/laporan_penindakan/getPenindakanByUkpd', 'Operator\PengantarSidang::getPenindakanByUkpd');
$routes->post('/operator/pengantar_sidang/edit', 'Operator\PengantarSidang::Edit');
$routes->post('/operator/pengantar_sidang/save', 'Operator\PengantarSidang::Save');
$routes->post('/operator/pengantar_sidang/delete', 'Operator\PengantarSidang::Delete');

// pengandangan
$routes->get('/operator/kendaraan_pengandangan', 'Operator\Pengandangan::index');

// End Operator

// Verifikator
$routes->get('/verifikator/dashboard', 'Verifikator\Dashboard::index');
// Verifikator Surat Pengeluaran
$routes->get('/verifikator/surat_masuk', 'Verifikator\SuratPengeluaran::index');
$routes->get('/verifikator/surat_masuk/(:num)', 'Verifikator\SuratPengeluaran::detail_surat/$1');
$routes->get('/verifikator/arsipSurat', 'Verifikator\SuratPengeluaran::arsipSurat');
// Verifikator Profil
$routes->get('/verifikator/profil', 'Verifikator\Profile::index');
$routes->post('/verifikator/profile/save_profile', 'Verifikator\Profile::save_profile');
$routes->get('/verifikator/profile/getProfile', 'Verifikator\Profile::getProfile');
// End Profil

// PDF Controller
$routes->get('cetak_surat/SKRD/(:any)', 'Pdf\PdfController::index/$1');
$routes->get('surat_pengeluaran/(:num)', 'Pdf\PdfController::pengeluaran/$1');
$routes->get('/lihat_gambar/(:num)', 'Pdf\PdfController::viewImage/$1');
$routes->get('/bap/(:num)', 'Pdf\PdfController::bap/$1');
// End Pdf Controller
// Excel Controller

$routes->get('/exportExcel_ArsipLaporan', 'Excel\ExcelController::arsip_laporan');
$routes->get('/exportExcel_DataSidang/(:num)/(:any)/(:num)', 'Excel\ExcelController::exportDataSidang/$1/$2/$3');
$routes->get('/exportExcel/(:any)', 'Excel\ExcelController::exportLaporanPenindakan/$1');
// End Excel Controller

// Kepala Seksi 
$routes->get('/kasie/dashboard', 'Kasie\Dashboard::index');
// Surat Pengeluaran
$routes->get('/kasie/surat_masuk', 'Kasie\SuratPengeluaran::index');
$routes->get('/kasie/surat_masuk/(:num)', 'Kasie\SuratPengeluaran::detail_surat/$1');
$routes->post('/kasie/surat_masuk/update_surat', 'Kasie\SuratPengeluaran::update_surat');
// Kasie Profil
$routes->get('/kasie/profil', 'Kasie\Profile::index');
$routes->post('/kasie/profile/save_profile', 'Kasie\Profile::save_profile');
$routes->get('/kasie/profile/getProfile', 'Kasie\Profile::getProfile');
// End Kepala Seksi

// Kepala Bidang 
$routes->get('/kabid/dashboard', 'Kabid\Dashboard::index');
// Surat Pengeluaran
$routes->get('/kabid/surat_masuk', 'Kabid\SuratPengeluaran::index');
$routes->get('/kabid/surat_masuk/(:num)', 'Kabid\SuratPengeluaran::detail_surat/$1');
$routes->post('/kabid/surat_masuk/update_surat', 'Kabid\SuratPengeluaran::update_surat');
// Kabid Profil
$routes->get('/kabid/profil', 'Kabid\Profile::index');
$routes->post('/kabid/profile/save_profile', 'Kabid\Profile::save_profile');
$routes->get('/kabid/profile/getProfile', 'Kabid\Profile::getProfile');

// Image 
$routes->get('/image', 'image\ImageView::index');

// Auth
$routes->get('/', 'Auth\AuthController::index');
$routes->get('/register', 'Auth\AuthController::register');
$routes->get('getUkpd', 'Auth\AuthController::getUkpd');
$routes->post('save/auth', 'Auth\AuthController::registerProgres');
$routes->post('login/auth', 'Auth\AuthController::getLogin');
$routes->get('/logout', 'Auth\AuthController::logout');

// pengandangan
$routes->get('/pengandangan/dashboard', 'Pengandangan\Dashboard::index');
$routes->get('/pengandangan/kendaraan_masuk', 'Pengandangan\KendaraanController::index');
$routes->get('/pengandangan/kendaraan_keluar', 'Pengandangan\KendaraanController::kendaraanKeluar');
$routes->get('/pengandangan/data_kendaraan', 'Pengandangan\KendaraanController::data_kendaraan');
$routes->post('/pengandangan/getPenindakan', 'Pengandangan\KendaraanController::getPenindakan');
$routes->post('/pengandangan/save', 'Pengandangan\KendaraanController::save');
$routes->post('/pengandangan/edit', 'Pengandangan\KendaraanController::edit');
$routes->post('/pengandangan/update', 'Pengandangan\KendaraanController::update');

//sudinHub


// $routes->get('getData', 'SudinHub\Laporan::getDataPenindakan');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
