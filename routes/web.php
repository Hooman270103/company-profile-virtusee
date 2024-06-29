<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\IndoRegionController;
use App\Http\Controllers\admin\PostsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\EventsController;
use App\Http\Controllers\admin\HeroesController;
use App\Http\Controllers\admin\VideosController;
use App\Http\Controllers\admin\CounterController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\SectionController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\TestimoniController;
use App\Http\Controllers\SummernoteUploadController;
use App\Http\Controllers\admin\LogoSlidersController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\admin\GalleryCategoryController;
use App\Http\Controllers\admin\HeroImageSlidersController;

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

Route::get('get-province', [IndoRegionController::class, 'getDataProvince'])->name('get-province');
Route::get('get-regency/{id}', [IndoRegionController::class, 'getDataRegency'])->name('get-regency');
Route::get('get-district/{id}',[IndoRegionController::class, 'getDataDistrict'])->name('get-district');
Route::get('get-village/{id}', [IndoRegionController::class, 'getDataVillage'])->name('get-village');

//get data from components
Route::get('setting/get-datas', [SettingController::class, 'allData'])->name('setting.get-datas');
Route::post('videos/get-datas', [VideosController::class, 'allData'])->name('videos.get-datas');

Route::prefix('posts')->name('posts.')->group(function () {
    Route::post('getData', [PostsController::class, 'getDataPost'])->name('getData');
    Route::get('detail/{slug}/{type}/{pageId}', [PostsController::class, 'detailDataPost'])->name('detailData');
    Route::get('allData/{type}/{pageId}', [PostsController::class, 'allDataPost'])->name('allData');
});


Route::prefix('events')->name('events.')->group(function () {
    Route::post('getData', [EventsController::class, 'getData'])->name('getData');
    Route::get('detail/{slug}', [EventsController::class, 'detailData'])->name('detailData');
    Route::get('allData', [EventsController::class, 'allData'])->name('allData');
});

Route::prefix('heroes')->name('heroes.')->group(function () {
    Route::post('getData', [HeroesController::class, 'getData'])->name('getData');
});

Route::prefix('photos')->name('photos.')->group(function () {
    Route::post('getData', [GalleryCategoryController::class, 'getData'])->name('getData');
    Route::get('detail/{slug}', [GalleryController::class, 'detailData'])->name('detailData');
});

Route::prefix('section')->name('section.')->group(function () {
    Route::post('getData', [SectionController::class, 'getData'])->name('getData');
});

Route::prefix('faq')->name('faq.')->group(function () {
    Route::post('getData', [FaqController::class, 'getData'])->name('getData');
});

Route::prefix('logo-sliders')->name('logo-sliders.')->group(function () {
    Route::get('getData', [LogoSlidersController::class, 'getData'])->name('getData');
});

Route::prefix('hero')->name('hero.')->group(function () {
    Route::get('getData', [HeroImageSlidersController::class, 'getData'])->name('getData');
});

Route::prefix('counter')->name('counter.')->group(function () {
    Route::post('getData', [CounterController::class, 'getData'])->name('getData');
});

Route::prefix('testimoni')->name('testimoni.')->group(function () {
    Route::post('getData', [TestimoniController::class, 'getData'])->name('getData');
});





Route::get('/', function () {
    return redirect()->route('page.display', 'home');
});

Route::get('page/{slug}', [HomepageController::class, 'pageDisplay'])->name('page.display');
// Route::get('kontak-kami', [HomepageController::class, 'kontakKami'])->name('kontak-kami');
Route::get('kebijakan-privasi', [HomepageController::class, 'kebijakanPrivasi'])->name('kebijakan-privasi');

Route::prefix('request-demo')->name('request-demo.')->group(function () {
    Route::get('/', [HomepageController::class, 'requestDemo'])->name('index');
    Route::post('store', [HomepageController::class, 'storeRequestDemo'])->name('store');
});

Route::prefix('events')->name('events.')->group(function () {
    Route::post('getData', [EventsController::class, 'getData'])->name('getData');
    Route::get('detail/{slug}', [EventsController::class, 'detailData'])->name('detailData');
    Route::get('allData', [EventsController::class, 'allData'])->name('allData');
});

Route::prefix('photos')->name('photos.')->group(function () {
    Route::get('getData', [GalleryCategoryController::class, 'getData'])->name('getData');
    Route::get('detail/{slug}', [GalleryController::class, 'detailData'])->name('detailData');
});

Route::post('/summernote-upload', [SummernoteUploadController::class, 'upload'])->name('summernote.upload');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        //pengaturan
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::put('update/{id}', [SettingController::class, 'update'])->name('update');
        });


        //counter
        Route::prefix('counter')->name('counter.')->group(function () {
            Route::get('get-table', [CounterController::class, 'getTable'])->name('getTable');
        });

        //hero image sliders
        Route::prefix('hero-image-sliders')->name('hero-image-sliders.')->group(function () {
            Route::get('/', [HeroImageSlidersController::class, 'index'])->name('index');
            Route::post('store', [HeroImageSlidersController::class, 'store'])->name('store');
            Route::get('allData', [HeroImageSlidersController::class, 'allData'])->name('all-data');
            Route::delete('destroy-all', [HeroImageSlidersController::class, 'destroyAll'])->name('destroy-all');
            Route::delete('destroy/{id}', [HeroImageSlidersController::class, 'destroy'])->name('destroy');
            Route::post('update-position', [HeroImageSlidersController::class, 'updatePosition'])->name('update-position');
        });


        Route::prefix('gallery')->name('gallery.')->group(function () {
            Route::get('/{galleryCategoryId}/{galleryCategoryName}', [GalleryController::class, 'index'])->name('index');
            Route::post('store/{galleryCategoryId}', [GalleryController::class, 'store'])->name('store');
            Route::post('allData', [GalleryController::class, 'allData'])->name('all-data');
            Route::delete('destroy-all/{galleryCategoryId}', [GalleryController::class, 'destroyAll'])->name('destroy-all');
            Route::delete('destroy/{id}', [GalleryController::class, 'destroy'])->name('destroy');
            Route::post('update-position', [GalleryController::class, 'updatePosition'])->name('update-position');
        });


        Route::prefix('logo-sliders')->name('logo-sliders.')->group(function () {
            Route::get('/', [LogoSlidersController::class, 'index'])->name('index');
            Route::post('store', [LogoSlidersController::class, 'store'])->name('store');
            Route::get('allData', [LogoSlidersController::class, 'allData'])->name('all-data');
            Route::delete('destroy-all', [LogoSlidersController::class, 'destroyAll'])->name('destroy-all');
            Route::delete('destroy/{id}', [LogoSlidersController::class, 'destroy'])->name('destroy');
            Route::post('update-position', [LogoSlidersController::class, 'updatePosition'])->name('update-position');
        });


        Route::middleware(['role:Superadmin'])->group(function () {
            Route::resource('posts', PostsController::class)->only('destroy');
            Route::resource('events', EventsController::class)->only('destroy');
            Route::resource('videos', VideosController::class)->only('destroy');
            Route::resource('counter', CounterController::class)->only('destroy');
            Route::resource('gallery-category', GalleryCategoryController::class)->only('destroy');
            Route::resource('faq', FaqController::class)->only('destroy');
            Route::resource('testimoni', TestimoniController::class)->only('destroy');
            Route::resource('section', SectionController::class)->only('destroy');
            Route::resource('heroes', HeroesController::class)->only('destroy');
            Route::resource('menu', MenuController::class);
            Route::resource('users', UsersController::class);
        });

        Route::middleware(['role:Superadmin|Admin'])->group(function () {
            Route::resource('posts', PostsController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('events', EventsController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('videos', VideosController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('counter', CounterController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('gallery-category', GalleryCategoryController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('faq', FaqController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('testimoni', TestimoniController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('section', SectionController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::resource('heroes', HeroesController::class)->only('index', 'create', 'store', 'show', 'edit', 'update');
        });
    });
});

require __DIR__.'/auth.php';
