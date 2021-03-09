
<?php

use App\Http\Controllers\MagRoleController;
use App\Http\Controllers\MagPermissionController;
use App\Http\Controllers\MagUserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'    => ['web'],], function ()
    {
        Route::resource('mag_roles', MagRoleController::class);
        Route::resource('mag_permissions', MagPermissionController::class);
        Route::resource('mag_users', MagUserController::class);
        Route::post('unckeck_permission_from_role', [MagRoleController::class,'unckeck_permission_from_role']);
        Route::post('ckeck_permission_from_role', [MagRoleController::class,'ckeck_permission_from_role']);
        Route::get('auto_insert_permission', [MagPermissionController::class,'auto_insert_permission']);
        Route::post('edit_role_user/{id}', [MagUserController::class,'edit_role_user']);
        Route::post('search_user', [MagUserController::class,'search_user']);
    });
