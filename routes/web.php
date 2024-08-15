<?php

use Illuminate\Support\Facades\Route;

// import frontend contoller
use App\Http\Controllers\FrontendController;

// import backend contoller
use App\Http\Controllers\Backend\UserController as BackendUserController;
use App\Http\Controllers\Backend\DepartmentController as BackendDepartmentController;
use App\Http\Controllers\Backend\EmployeController as BackendEmployeController;
use App\Http\Middleware\IsAdmin;

// frontend
Route::get('/', [FrontendController::class, 'index'])->name("frontend.home");
Route::get('/department/{slug?}', [FrontendController::class, 'department'])->name("frontend.department");
Route::get('/employe/{slug?}', [FrontendController::class, 'employe'])->name("frontend.employe");

// user
Route::get('/backend/manage/user', [BackendUserController::class, 'index'])->name("backend.manage.user");
Route::middleware([IsAdmin::class])->group(function(){
    Route::get('/backend/create/user', [BackendUserController::class, 'create'])->name("backend.create.user");
    Route::post('/backend/create/process/user', [BackendUserController::class, 'create_process'])->name("backend.create.process.user");
    Route::get('/backend/edit/user/{id?}', [BackendUserController::class, 'edit'])->name("backend.edit.user");
    Route::post('/backend/edit/process/user', [BackendUserController::class, 'edit_process'])->name("backend.edit.process.user");
    Route::get('/backend/show/user/{id?}', [BackendUserController::class, 'show'])->name("backend.show.user");
    Route::delete('/backend/destroy/process/user', [BackendUserController::class, 'destroy'])->name("backend.destroy.process.user");
});
Route::get('/backend/edit/me', [BackendUserController::class, 'edit_me'])->name("backend.edit.user.me");
Route::post('/backend/edit/process/me', [BackendUserController::class, 'edit_process_me'])->name("backend.edit.process.user.me");
Route::get('/backend/show/me', [BackendUserController::class, 'show_me'])->name("backend.show.user.me");


Route::middleware([IsAdmin::class])->group(function(){
// department
Route::get('/backend/manage/department', [BackendDepartmentController::class, 'index'])->name("backend.manage.department");
Route::get('/backend/create/department', [BackendDepartmentController::class, 'create'])->name("backend.create.department");
Route::post('/backend/create/process/department', [BackendDepartmentController::class, 'create_process'])->name("backend.create.process.department");
Route::get('/backend/edit/department/{id?}', [BackendDepartmentController::class, 'edit'])->name("backend.edit.department");
Route::post('/backend/edit/process/department', [BackendDepartmentController::class, 'edit_process'])->name("backend.edit.process.department");
Route::delete('/backend/destroy/process/department', [BackendDepartmentController::class, 'destroy'])->name("backend.destroy.process.department");

// employe
Route::get('/backend/manage/employe', [BackendEmployeController::class, 'index'])->name("backend.manage.employe");
Route::get('/backend/create/employe', [BackendEmployeController::class, 'create'])->name("backend.create.employe");
Route::post('/backend/create/process/employe', [BackendEmployeController::class, 'create_process'])->name("backend.create.process.employe");
Route::get('/backend/edit/employe/{id?}', [BackendEmployeController::class, 'edit'])->name("backend.edit.employe");
Route::post('/backend/edit/process/employe', [BackendEmployeController::class, 'edit_process'])->name("backend.edit.process.employe");
Route::get('/backend/show/employe/{id?}', [BackendEmployeController::class, 'show'])->name("backend.show.employe");
Route::delete('/backend/destroy/process/employe', [BackendEmployeController::class, 'destroy'])->name("backend.destroy.process.employe");

});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('route:cache');
    // return what you want
});

Route::get('/error-access', function(){
    return view('error-access');
})->name('error.access');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
