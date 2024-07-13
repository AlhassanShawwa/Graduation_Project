<?php

use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\GroupServicesController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/Dashboard_Admin', [DashboardController::class,'index']);
Route::get('/counter', Counter::class)->name('counter');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

//***********************user dashboard********************/
Route::get('/dashboard/user', function () {
    return view('Dashboard.User.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard.user');
//***********************end user dashboard*****************/

//***********************admin dashboard********************/
Route::get('/dashboard/admin', function () {
    return view('Dashboard.Admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('dashboard.admin');
//***********************end admin dashboard****************/

// *********************************************************
Route::middleware(['auth:admin'])->group( function () {
// **********************SectionController********************

    Route::resource('sections', SectionController::class);
// **********************************************************
// ***********************DoctorController*******************

    Route::resource('Doctors', DoctorController::class);
    Route::post('update_password', [DoctorController::class,'update_password'])->name('update_password');
    Route::post('update_status', [DoctorController::class,'update_status'])->name('update_status');
// **********************************************************
// ***********************SectionController*******************

    Route::resource('Service', SingleServiceController::class);

// ***********************End SectionController*******************


//############################# insurance route ##########################################

    Route::resource('insurance', InsuranceController::class);

//############################# end insurance route ######################################


//############################# Ambulance route ##########################################

    Route::resource('Ambulance', AmbulanceController::class);

//############################# end Ambulance route ######################################


//############################# Patients route ##########################################

    Route::resource('Patients', PatientController::class);

//############################# end Patients route ######################################


//############################# GroupServices route ##########################################

    Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');

//############################# end GroupServices route ######################################

// //############################# GroupServices route ######################################

// Route::get('/group-services', [GroupServicesController::class, 'index'])->name('group-services.index');
// Route::post('/group-services/add-service', [GroupServicesController::class, 'addService'])->name('group-services.addService');
// Route::post('/group-services/edit-service/{index}', [GroupServicesController::class, 'editService'])->name('group-services.editService');
// Route::post('/group-services/save-service/{index}', [GroupServicesController::class, 'saveService'])->name('group-services.saveService');
// Route::post('/group-services/remove-service/{index}', [GroupServicesController::class, 'removeService'])->name('group-services.removeService');
// Route::post('/group-services/save-group', [GroupServicesController::class, 'saveGroup'])->name('group-services.saveGroup');

// //############################# end GroupServices route ######################################


});
// **********************************************************
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

});
