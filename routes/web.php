<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Controller;






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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//students
Route::get('/students',[StudentController::class,'index'])->name('students.index');
Route::get('/students/create',[StudentController::class,'create'])->name('students.create');
Route::put('/students/update',[StudentController::class,'update'])->name('students.update');
Route::get('/students/edit/{id}',[StudentController::class,'edit'])->name('students.edit');
Route::get('/students/show/{id}',[StudentController::class,'show'])->name('students.show');
Route::post('/students/store',[StudentController::class, 'store'])->name('students.store');
Route::get('/students/delete/{student}',[StudentController::class, 'destroy'])->name('students.delete');
//units
Route::get('/units',[UnitController::class,'index'])->name('units.index');
Route::get('/units/create',[UnitController::class,'create'])->name('units.create');
Route::put('/units/update/{unit}',[UnitController::class,'update'])->name('units.update');
Route::get('/units/edit/{id}',[UnitController::class,'edit'])->name('units.edit');
Route::get('/units/show/{id}',[UnitController::class,'show'])->name('units.show');
Route::post('/units/store',[UnitController::class, 'store'])->name('units.store');
Route::get('/units/delete/{unit}',[UnitController::class, 'destroy'])->name('units.delete');
//departments
Route::get('/departments',[DepartmentController::class,'index'])->name('departments.index');
Route::get('/departments/create',[DepartmentController::class,'create'])->name('departments.create');
Route::put('/departments/update/{department}',[DepartmentController::class,'update'])->name('departments.update');
Route::get('/departments/edit/{id}',[DepartmentController::class,'edit'])->name('departments.edit');
Route::get('/departments/show/{id}',[DepartmentController::class,'show'])->name('departments.show');
Route::post('/departments/create',[DepartmentController::class, 'store'])->name('departments.store');
Route::get('/departments/delete/{department}',[DepartmentController::class, 'destroy'])->name('departments.delete');
//staff
Route::get('/staff',[StaffController::class,'index'])->name('staff.index');
Route::get('/staff/create',[StaffController::class,'create'])->name('staff.create');
Route::put('/staff/update/{staff}',[StaffController::class,'update'])->name('staff.update');
Route::get('/staff/edit/{id}',[StaffController::class,'edit'])->name('staff.edit');
Route::get('/staff/show/{id}',[StaffController::class,'show'])->name('staff.show');
Route::post('/staff/create',[StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/delete/{staff}',[StaffController::class, 'destroy'])->name('staff.delete');
//courses
Route::get('/courses',[CourseController::class,'index'])->name('courses.index');
Route::get('/courses/create',[CourseController::class,'create'])->name('courses.create');
Route::put('/courses/update/{course}',[CourseController::class,'update'])->name('courses.update');
Route::get('/courses/edit/{id}',[CourseController::class,'edit'])->name('courses.edit');
Route::get('/courses/show/{id}',[CourseController::class,'show'])->name('courses.show');
Route::post('/courses/create',[CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/delete/{course}',[CourseController::class, 'destroy'])->name('courses.delete');
//roles
Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
Route::put('/roles/update/{role}',[RoleController::class,'update'])->name('roles.update');
Route::get('/roles/edit/{id}',[RoleController::class,'edit'])->name('roles.edit');
Route::get('/roles/show/{id}',[RoleController::class,'show'])->name('roles.show');
Route::post('/roles/store',[RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/delete/{role}',[RoleController::class, 'destroy'])->name('roles.delete');
//categories
Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::put('/categories/update/{category}',[CategoryController::class,'update'])->name('categories.update');
Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
Route::get('/categories/show/{id}', [CategoryController::class,'show'])->name('categories.show');   
Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
Route:: get('/categories/delete/{category}',[CategoryController::class,'destroy'])-> name ('categories.delete') ; //students
//register
Route::get('sign-up/',[Controller::class,'direct'])->name('auth.register');
//login
Route::get('log-in/',[Controller::class,'redirect'])->name('auth.login');
Route::post('/user', [UserController::class,'store']);
Auth::routes();
//dashboard
Route::group(['middleware' => ['auth']], function ()
{
    Route::view('/', '/home')->name('/');
});
Route::get('dashboard/',[Controller::class,'dashboard'])->name('pages.dashboard');
Route::get('billing/')->name('pages.billing');
Route::get('/', 'DepartmentController@index'); // localhost:8000/
Route::post('/getEmployees/{id}',[StaffController::class,'getEmployees'])->name('get.roles');


