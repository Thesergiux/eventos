<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\SpecialistController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\TypeExpenseController;
use App\Http\Controllers\Admin\StudyController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Admin\RaceController;
use App\Http\Controllers\Admin\RaceRegistrationController;


use Illuminate\Support\Facades\Auth;


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

Route::get('/', [HomeController::class, 'index']);
Route::get('especialistas', [HomeController::class, 'specialists']);
Route::get('especialista/{slug}', [HomeController::class, 'specialist']);
Route::get('actividades/{id}', [HomeController::class, 'actividad']);


Auth::routes(['register' => false]);
Route::get('/iniciar-sesion', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Route::get('notas/{id}', [PdfController::class, 'pdfnote']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'noCache']], function() {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('pdf/{id}', [PdfController::class, 'pdf']);

    Route::get('pdf-carrera/{id}', [PdfController::class, 'pdfRace']);

    Route::get('pdf-egreso/{id}', [PdfController::class, 'pdfEgreso']);
    Route::get('pdf-gasto/{id}', [PdfController::class, 'pdfGasto']);
        
    Route::post('ultimo_rx/{id}', [ServiceController::class, 'getrx']);

    //perfil
    Route::view('perfil/editar','admin.editar-perfil');
    Route::put('perfil/editar', [ProfileController::class, 'update']);

    //Password
    Route::view('perfil/cambiar-contrasena', 'admin.cambiar-contrasena');
    Route::post('perfil/cambiar-contrasena', [PasswordController::class, 'update']);

    // usuarios
    Route::get('usuarios', [UserController::class, 'index']);
    Route::get('usuarios/crear', [UserController::class, 'create']);
    Route::post('usuarios/crear', [UserController::class, 'save']);
    Route::get('usuarios/{id}/editar',[UserController::class, 'edit']);
    Route::put('usuarios/{id}/actualizar',[UserController::class, 'update']);
    Route::delete('usuarios/eliminar/{id}',[UserController::class, 'destroy']);
    //permisos
    Route::get('permisos', [PermissionController::class, 'index']);
    Route::view('agregar-permisos', 'admin.permisos.crear');
    Route::post('permiso/crear', [PermissionController::class, 'save']);
    Route::get('permiso/{id}/editar', [PermissionController::class, 'edit']);
    Route::put('permiso/{id}/actualizar', [PermissionController::class, 'update']);
    Route::delete('permiso/eliminar/{id}', [PermissionController::class, 'delete']);

    //roles
    Route::get('roles', [RoleController::class, 'index']);
    Route::view('agregar-roles', 'admin.roles.crear');
    Route::post('roles/crear', [RoleController::class, 'save']);
    Route::get('roles/{id}/editar', [RoleController::class, 'edit']);
    Route::put('roles/{id}/actualizar', [RoleController::class, 'update']);
    Route::delete('roles/eliminar/{id}', [RoleController::class, 'delete']);

    //Posts
    Route::get('posts', [PostController::class, 'index']);
    Route::get('agregar-post', [PostController::class, 'create']);
    Route::post('post/crear', [PostController::class, 'save']);
    Route::get('post/{id}/editar', [PostController::class, 'edit']);
    Route::put('post/{id}/actualizar', [PostController::class, 'update']);
    Route::delete('post/eliminar/{id}', [PostController::class, 'delete']);

    //Actividades
    Route::get('actividades', [ActivityController::class, 'index']);
    Route::get('agregar-actividad', [ActivityController::class, 'create']);
    Route::post('actividad/crear', [ActivityController::class, 'save']);
    Route::get('actividad/{id}/editar', [ActivityController::class, 'edit']);
    Route::put('actividad/{id}/actualizar', [ActivityController::class, 'update']);
    Route::delete('actividad/eliminar/{id}', [ActivityController::class, 'delete']);

    //Ubicaciones
    Route::get('ubicaciones', [LocationController::class, 'index']);
    Route::view('agregar-ubicacion', 'admin.ubicaciones.crear');
    Route::post('ubicacion/crear', [LocationController::class, 'save']);
    Route::get('ubicacion/{id}/editar', [LocationController::class, 'edit']);
    Route::put('ubicacion/{id}/actualizar', [LocationController::class, 'update']);
    Route::delete('ubicacion/eliminar/{id}', [LocationController::class, 'delete']);

    //Especialistas
    Route::get('especialistas', [SpecialistController::class, 'index']);
    Route::view('agregar-especialista', 'admin.especialistas.crear');
    Route::post('especialista/crear', [SpecialistController::class, 'save']);
    Route::get('especialista/{id}/editar', [SpecialistController::class, 'edit']);
    Route::put('especialista/{id}/actualizar', [SpecialistController::class, 'update']);
    Route::delete('especialista/eliminar/{id}', [SpecialistController::class, 'delete']);









    //Tipo de gastos
    Route::get('tipos-gastos', [TypeExpenseController::class, 'index']);
    Route::view('agregar-tipos-gastos', 'admin.tipogastos.crear');
    Route::post('tipos-gastos/crear', [TypeExpenseController::class, 'save']);
    Route::get('tipos-gastos/{id}/editar', [TypeExpenseController::class, 'edit']);
    Route::put('tipos-gastos/{id}/actualizar', [TypeExpenseController::class, 'update']);
    Route::delete('tipos-gastos/eliminar/{id}', [TypeExpenseController::class, 'delete']);

    //Estudios
    Route::get('estudios', [StudyController::class, 'index']);
    Route::view('agregar-estudios', 'admin.estudios.crear');
    Route::post('estudios/crear', [StudyController::class, 'save']);
    Route::get('estudios/{id}/editar', [StudyController::class, 'edit']);
    Route::put('estudios/{id}/actualizar', [StudyController::class, 'update']);
    Route::delete('estudios/eliminar/{id}', [StudyController::class, 'delete']);
    
    // Estadísticas
    Route::get('estadisticas-servicios', [StatisticsController::class, 'index']);

    Route::get('estadisticas-gastos', [StatisticsController::class, 'gastos']);

    //Usuarios
    Route::get('usuarios', [UserController::class, 'index']);

    //Password
    Route::view('cambiar-contrasena', 'principal.cambiar-contrasena');
    Route::post('cambiar-contrasena', 'Auth\PasswordController@update');

    //Carreras
    Route::get('carreras', [RaceController::class, 'index']);
    Route::view('carreras/crear', 'admin.carreras.crear');
    Route::post('carreras/crear', [RaceController::class, 'save']);
    Route::get('carreras/{id}/editar', [RaceController::class, 'edit']);
    Route::put('carreras/{id}/actualizar', [RaceController::class, 'update']);
    Route::delete('carreras/eliminar/{id}', [RaceController::class, 'delete']);

    //Participantes
    Route::get('carrera-participantes', [RaceRegistrationController::class, 'index']);
    Route::get('carrera-participantes/crear', [RaceRegistrationController::class, 'create']);
    Route::post('carrera-participantes/crear', [RaceRegistrationController::class, 'save']);
    Route::get('carrera-participantes/{id}/editar', [RaceRegistrationController::class, 'edit']);
    Route::put('carrera-participantes/{id}/actualizar', [RaceRegistrationController::class, 'update']);
    Route::delete('carrera-participantes/eliminar/{id}', [RaceRegistrationController::class, 'delete']);

    Route::get('carrera-estadistica', [RaceRegistrationController::class, 'statics']);

});