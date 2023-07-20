<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
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
    if(Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('login');
    }
});

    //index
    Route::get('/', function () {return view('login');}); //, ['title'=>'Dashboard']
    
    //user_list
    Route::post('/user_list',function () {return view('user_list', ['title'=>'Dashboard']);})->name('user_list');

    //view_user
    Route::post('/view_user',[UserController::class,'findUser'])->name('view_user');

    //delete_user
    Route::get('/delete_user/{id}', [UserController::class,'delete_user'])->name('delete_user');

    //delete project
    Route::get('/delete_project/{id}',[ProjectController::class,'delete_project'])->name('delete_project');
    
    //home
    Route::get('/home', [HomeController::class,'index'])->name('home');
    
    //new project
    Route::get('/new_project',[ProjectController::class,'newProjectIndex'])->name('new_project');

    //project_list
    Route::get('/project_list', function () {return view('project_list', ['title'=>'Task List']);})->name('project_list');
    
    //new_user
    Route::get('/new_user', function () {return view('new_user', ['title'=>'New User']);})->name('new_user');
    
    //user_list
    Route::get('/user_list', function () {return view('user_list', ['title'=>'User List']);})->name('user_list');

    //view_project
    Route::post('/view_project',[ProjectController::class,'findProject'])->name('view_project');
    
    //edit_project
    Route::post('/edit_project',[ProjectController::class,'findProjectForEditing'])->name('edit_project');
    
    //save_user
    Route::get('/save_user',[UserController::class,'saveUser'])->name('save_user');

    //save_user
    Route::post('/save_user',[UserController::class,'update_user'])->name('save_user');
    
    //save_project
    Route::get('/save_project',[ProjectController::class,'save_project'])->name('save_project');

    //login
    Route::get('/login',[AuthController::class,'login'])->name('login');

    //login data save
    Route::post('/login', [AuthController::class,'loginPost'])->name('login');
    
    //logout
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');

    Route::get('/manage_user', [UserController::class,function(){ return view('manage_user',['title'=>'Edit User']);}])->name('manage_user');

    Route::post('/edit', [UserController::class , 'edit']);

    Route::get('/edit/{id}', [UserController::class,function($id){ return view('edit',['title'=>'Edit User','user' => User::find($id)]);}])->name('edit');

    Route::post('/update_status', [ProjectController::class,'updateStatus']);

