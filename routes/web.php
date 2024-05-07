<?php

use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'about'])->name('about');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified', 'roleCheck'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/user.php';
require __DIR__.'/event.php';
require __DIR__.'/ticket.php';
require __DIR__.'/esewa.php';
require __DIR__.'/organizer.php';
require __DIR__.'/payment.php';
require __DIR__.'/roleandpermission.php';
require __DIR__.'/receipt.php';
require __DIR__.'/invoice.php';
require __DIR__.'/result.php';
require __DIR__.'/email.php';
require __DIR__.'/khalti.php';
