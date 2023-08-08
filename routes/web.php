<?php

use App\Http\Livewire\Admin\Home;
use App\Http\Livewire\Admin\Role;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Login::class)->name('auth.login');
Route::get('/register', Register::class)->name('auth.register');
Route::get('/home', Home::class)->name('home');
Route::get('/roles', Role::class)->name('admin.role');
