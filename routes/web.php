<?php

use App\Http\Controllers\{ChamadoController,EmpresaController,PermissionController,RoleController,UserController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {
    Route::controller(EmpresaController::class)->group(function(){
        Route::get('/empresa', 'index')->name('empresa');
        Route::get('/add-empresa', 'create')->name('create');
        Route::post('/add-empresa', 'store')->name('store');
        Route::get('/update-empresa/{id}', 'edit')->name('edit');
        Route::get('/search-empresa', 'searchEmpresa')->name('searchEmpresa');
        Route::get('/search-empresa-trash', 'searchEmpresaTrash')->name('searchEmpresaTrash');
        Route::patch('/update-empresa/{id}', 'update')->name('update');
        Route::delete('/delete-empresa/{id}', 'destroy')->name('destroy');
        Route::get('/trash-empresa', 'trashEmpresa')->name('trashEmpresa');
        Route::get('/restore-empresa/{id}', 'restoreEmpresa')->name('restoreEmpresa');
        Route::delete('/delete-trash-empresa/{id}', 'deleteEmpresa')->name('deleteEmpresa');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(ChamadoController::class)->group(function(){
        Route::get('/chamado', 'index')->name('chamado');
        Route::get('/add-chamado', 'create')->name('create');
        Route::post('/add-chamado', 'store')->name('store');
        Route::get('/update-chamado/{id}', 'edit')->name('edit');
        Route::get('/search-chamado', 'searchChamado')->name('searchChamado');
        Route::get('/search-chamado-trash', 'searchChamadoTrash')->name('searchChamadoTrash');
        Route::patch('/update-chamado/{id}', 'update')->name('update');
        Route::delete('/delete-chamado/{id}', 'destroy')->name('destroy');
        Route::get('/trash-chamado', 'trashChamado')->name('trashChamado');
        Route::get('/restore-chamado/{id}', 'restoreChamado')->name('restoreChamado');
        Route::delete('/delete-trash-chamado/{id}', 'deleteChamado')->name('deleteChamado');
    });
});

Route::middleware(['auth', 'role:Admin'])->group(function() {
    Route::controller(PermissionController::class)->group(function(){
        Route::get('/permission', 'index')->name('index');
        Route::get('/add-permission', 'create')->name('create');
        Route::post('/add-permission', 'store')->name('store');
        Route::get('/update-permission/{id}', 'edit')->name('edit');
        Route::patch('/update-permission/{id}', 'update')->name('update');
        Route::delete('/delete-permission/{id}', 'destroy')->name('destroy');
        Route::get('/search-permission', 'searchPermission')->name('searchPermission');
        Route::get('/search-permission-trash', 'searchPermissionTrash')->name('searchPermissionTrash');
        Route::get('/trash-permission', 'trashPermission')->name('trashPermission');
        Route::get('/restore-permission/{id}', 'restorePermissionTrash')->name('restorePermissionTrash');
        Route::delete('/delete-permission-trash/{id}', 'deletePermissionTrash')->name('deletePermissionTrash');
    });
});

Route::middleware(['auth', 'role:Admin'])->group(function() {
    Route::controller(RoleController::class)->group(function(){
        Route::get('/role', 'index')->name('index');
        Route::get('/add-role', 'create')->name('create');
        Route::post('/add-role', 'store')->name('store');
        Route::get('/update-role/{id}', 'edit')->name('edit');
        Route::patch('/update-role/{id}', 'update')->name('update');
        Route::delete('/delete-role/{id}', 'destroy')->name('destroy');
        Route::get('/trash-role', 'trashRole')->name('trashRole');
        Route::get('/search-role', 'searchRole')->name('searchRole');
        Route::get('/search-role-trash', 'searchRoleTrash')->name('searchRoleTrash');
        Route::get('/restore-role/{id}', 'restoreRoleTrash')->name('restoreRoleTrash');
        Route::delete('/delete-role-trash/{id}', 'deleteRoleTrash')->name('deleteRoleTrash');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(UserController::class)->group(function(){
        Route::get('/profile', 'profile')->name('profile');
        Route::patch('/update-datails', 'updateDetails')->name('updateDetails');
        Route::patch('/update-password', 'updatePassword')->name('updatePassword');

        Route::controller(UserController::class)->group(function(){
            Route::middleware('role:Admin')->group(function () {
                Route::get('/user', 'index')->name('index');
                Route::get('/add-user', 'create')->name('create');
                Route::post('/add-user', 'store')->name('store');
                Route::get('/update-user/{id}', 'edit')->name('edit');
                Route::patch('/update-user/{id}', 'update')->name('update');
                Route::delete('/delete-user/{id}', 'destroy')->name('destroy');
                Route::get('/trash-user', 'trashUser')->name('trashUser');
                Route::get('/search-user', 'searchUser')->name('searchUser');
                Route::get('/search-user-trash', 'searchUserTrash')->name('searchUserTrash');
                Route::get('/restore-user/{id}', 'restoreUserTrash')->name('restoreUserTrash');
                Route::delete('/delete-user-trash/{id}', 'deleteUserTrash')->name('deleteUserTrash');
            });
        });
    });
});
