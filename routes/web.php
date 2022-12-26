<?php

use App\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Auth::routes(['register' => false]);

Route::get('/', 'PagesController@home')->name('index');
Route::get('/empresa', 'PagesController@empresa')->name('empresa');
Route::get('/valvulas', 'PagesController@categorias')->name('valvulas');
Route::get('/productos', 'PagesController@productos')->name('productos');
Route::get('/valvulas/{id}', 'PagesController@categoria')->name('categoria');
Route::get('/producto/{id}', 'PagesController@producto')->name('producto');
Route::get('/servicios', 'PagesController@servicios')->name('servicios');
Route::get('/calidad', 'PagesController@calidad')->name('calidad');
Route::get('/clientes', 'PagesController@clientes')->name('clientes');
Route::get('/contacto', 'PagesController@contacto')->name('contacto');
Route::post('enviar-contacto', 'MailController@contact')->name('send-contact');
Route::get('/descargar-archivo/{id}/{reg}', 'ContentController@descargarArchivo')->name('descargar-archivo');
Route::get('/descargar-certificado/{id}', 'CertificateController@descargarCertificado')->name('descargar-certificado');

Route::get('/ficha-tecnica/{id}', 'ProductController@fichaTecnica')->name('ficha-tecnica');
Route::delete('/ficha-tecnica/{id}', 'ProductController@borrarFichaTecnica')->name('borrar-ficha-tecnica');
Route::post('newsletter', 'NewsLetterController@storeNewsletter')->name('newsletter.store');
Route::middleware('auth')->prefix('admin')->group(function () {
    /** Page Home */
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('home/content', 'HomeController@content')->name('home.content');
    Route::post('home/content/generic-section/store', 'HomeController@store')->name('home.content.store');
    Route::post('home/content/generic-section/update', 'HomeController@update')->name('home.content.update');
    Route::post('home/content/update', 'HomeController@updateSection')->name('home.content.update-section');
    Route::delete('home/content/{id}', 'HomeController@destroy')->name('home.content.destroy');
    Route::get('home/content/slider/get-list', 'HomeController@sliderGetList')->name('home.slider.get-list');
    /** Fin home*/

    /** Page Company */
    Route::get('company/content', 'CompanyController@content')->name('company.content');
    Route::post('company/content/store-slider', 'CompanyController@storeSlider')->name('company.content.storeSlider');
    Route::post('company/content/update-slider', 'CompanyController@updateSlider')->name('company.content.updateSlider');
    Route::post('company/qualities/store', 'CompanyController@createInfo')->name('company.info.store');
    Route::post('company/content/update-info', 'CompanyController@updateInfo')->name('company.content.updateInfo');
    Route::post('company/content/generic-section/update', 'CompanyController@updateHomeGenericSection')->name('company.content.generic-section.update');
    Route::delete('company/content/{id}', 'CompanyController@destroySlider')->name('company.content.destroy');
    Route::get('company/content/slider/get-list', 'CompanyController@sliderGetList')->name('company.slider.get-list');
    Route::get('company/content/service/get-list', 'CompanyController@serviceGetList')->name('company.service.get-list');
    /** Fin company*/

    // images
    Route::get('company/content/get-images/{id}', 'CompanyController@images')->name('company.slider.get-images');
    Route::post('company/images/store', 'CompanyController@imagesStore')->name('company.images.store');
    Route::post('company/images/update', 'CompanyController@imagesUpdate')->name('company.images.update');
    Route::get('company/content/image/{id?}', 'CompanyController@findImage');
    Route::delete('company/content/image/{id}', 'CompanyController@imageDestroy')->name('company.image.destroy');

    /** Page Category */
    Route::get('category/content', 'CategoryController@content')->name('category.content');
    Route::get('category/create', 'CategoryController@create')->name('category.content.create');
    Route::post('category/store', 'CategoryController@store')->name('category.content.store');
    Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.content.edit');
    Route::post('category/update/{id}', 'CategoryController@update')->name('category.content.update');
    Route::delete('category/content/{id}', 'CategoryController@destroy')->name('category.content.destroy');
    Route::get('category/content/get-list', 'CategoryController@getList')->name('category.slider.get-list');
    /** Fin Category*/

    /** Page Product */
    Route::get('product/content', 'ProductController@content')->name('product.content');
    Route::get('product/content/create', 'ProductController@create')->name('product.content.create');
    Route::post('product/content/store', 'ProductController@store')->name('product.content.store');
    Route::get('product/content/{id}/edit', 'ProductController@edit')->name('product.content.edit');
    Route::put('product/content', 'ProductController@update')->name('product.content.update');
    Route::delete('product/content/{id}', 'ProductController@destroy')->name('product.content.destroy');
    Route::get('product/content/get-list', 'ProductController@getList')->name('product.content.get-list');
    Route::get('product/content/find-product/{id?}', 'ProductController@find')->name('product.content.find');
    Route::delete('product/description-image/{id}/{field}', 'ProductController@destroyDescriptionImage')->name('product.destroy.descriptionImage');

    // images
    Route::get('product/content/get-images/{id}', 'ProductController@imagesProduct')->name('product.slider.get-images');
    Route::post('product/images/store', 'ProductController@imagesStore')->name('product.images.store');
    Route::post('product/images/update', 'ProductController@imagesUpdate')->name('product.images.update');
    Route::get('product/content/image-product/{id?}', 'ProductController@findImageProduct');
    Route::delete('product/content/image/{id}', 'ProductController@imageDestroyProduct')->name('product.image.destroy');

    // Application
    Route::get('product/content/get-application/{id}', 'ProductController@applicationProduct')->name('product.slider.get-application');
    Route::post('product/application/store', 'ProductController@applicationStore')->name('product.application.store');
    Route::post('product/application/update', 'ProductController@applicationUpdate')->name('product.application.update');
    Route::get('product/content/application-product/{id?}', 'ProductController@findApplicationProduct');
    Route::delete('product/content/application/{id}', 'ProductController@applicationDestroyProduct')->name('product.application.destroy');
    /** Fin product*/

    /** Page Services */
    Route::get('services/content', 'ServiceController@content')->name('services.content');
    Route::post('services/create', 'ServiceController@createInfo')->name('services.content.createInfo');
    Route::post('services/content/update-info', 'ServiceController@updateInfo')->name('services.content.updateInfo');
    Route::delete('services/content/{id}', 'ServiceController@destroySlider')->name('services.content.destroy');
    Route::get('services/content/slider/get-list', 'ServiceController@sliderGetList')->name('services.slider.get-list');
    /** Fin Services*/

    Route::get('services/content/get-images/{id}', 'ServiceController@images')->name('services.slider.get-images');
    Route::post('services/images/store', 'ServiceController@imagesStore')->name('services.images.store');
    Route::post('services/images/update', 'ServiceController@imagesUpdate')->name('services.images.update');
    Route::get('services/content/image/{id?}', 'ServiceController@findImage');
    Route::delete('services/content/image/{id}', 'ServiceController@imageDestroy')->name('services.image.destroy');

    /** Page Quality */
    Route::get('quality/content', 'QualityController@content')->name('quality.content');
    Route::post('quality/content/store-slider', 'QualityController@storeSlider')->name('quality.content.storeSlider');
    Route::post('quality/content/update-slider', 'QualityController@updateSlider')->name('quality.content.updateSlider');
    Route::post('quality/qualities/store', 'QualityController@createInfo')->name('quality.info.store');
    Route::post('quality/content/update-info', 'QualityController@updateInfo')->name('quality.content.updateInfo');
    Route::post('quality/content/generic-section/update', 'QualityController@updateHomeGenericSection')->name('quality.content.generic-section.update');
    Route::delete('quality/content/{id}', 'QualityController@destroySlider')->name('quality.content.destroy');
    Route::get('quality/content/slider/get-list', 'QualityController@sliderGetList')->name('quality.slider.get-list');
    Route::get('quality/content/service/get-list', 'QualityController@serviceGetList')->name('quality.service.get-list');
    /** Fin quality*/

    Route::get('quality/content/get-images/{id}', 'QualityController@images')->name('quality.slider.get-images');
    Route::post('quality/images/store', 'QualityController@imagesStore')->name('quality.images.store');
    Route::post('quality/images/update', 'QualityController@imagesUpdate')->name('quality.images.update');
    Route::get('quality/content/image/{id?}', 'QualityController@findImage');
    Route::delete('quality/content/image/{id}', 'QualityController@imageDestroy')->name('quality.image.destroy');

    /** Page Clients */
    Route::get('clients/content', 'ClientController@content')->name('clients.content');
    Route::post('clients/create', 'ClientController@createInfo')->name('clients.content.createInfo');
    Route::post('clients/content/update-info', 'ClientController@updateInfo')->name('clients.content.updateInfo');
    Route::delete('clients/content/{id}', 'ClientController@destroySlider')->name('clients.content.destroy');
    Route::get('clients/content/slider/get-list', 'ClientController@sliderGetList')->name('clients.slider.get-list');
    /** Fin client*/

    
    Route::get('clients/content/get-images/{id}', 'ClientController@images')->name('clients.slider.get-images');
    Route::post('clients/images/store', 'ClientController@imagesStore')->name('clients.images.store');
    Route::post('clients/images/update', 'ClientController@imagesUpdate')->name('clients.images.update');
    Route::get('clients/content/image/{id?}', 'ClientController@findImage');
    Route::delete('clients/content/image/{id}', 'ClientController@imageDestroy')->name('clients.image.destroy');

    /** Page newsletter */
    Route::get('newsletter/content', 'NewsLetterController@content')->name('newsletter.content');
    Route::get('newsletter/content/get-list', 'NewsLetterController@getList')->name('newsletter.content.get-list');
    Route::delete('newsletter/content/{id}', 'NewsLetterController@destroy')->name('newsletter.content.destroy');
    /** Fin newsletter*/

    /** Page company */
    Route::get('data/content', 'DataController@content')->name('data.content');
    Route::put('data/content', 'DataController@update')->name('data.content.update');
    /** Fin company*/


    Route::get('page/content', 'AdminPageController@content')->name('page.content');
    Route::put('page/content', 'AdminPageController@update')->name('page.content.update');

    Route::get('content/', 'ContentController@content')->name('content');
    Route::get('content/{id}', 'ContentController@findContent');
    Route::post('content/hero-update', 'ContentController@heroUpdate')->name('content.hero-update');
    Route::post('content/image/{id}/{reg}', 'ContentController@destroyImage')->name('content.destroy-image');

    Route::get('user/get-list', 'UserController@getList')->name('user.get-list');
    Route::resource('user', 'UserController');
});
