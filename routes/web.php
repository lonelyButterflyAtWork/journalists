<?php

use App\Http\Controllers\AdminController;
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

Route::get('/',  [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth'])
                                                          ->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home/vote', [App\Http\Controllers\HomeController::class, 'vote'])->name('home.vote');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('dashboard/show-votes', [AdminController::class, 'showVotesAjax'])->middleware(['auth'])->name('dashboard.showVotes');

Route::post('dashboard/del-journalist', [AdminController::class, 'delJournalist'])->middleware(['auth'])->name('dashboard.delJournalist');

Route::post('dashboard/del-vote', [AdminController::class, 'delVoteAjax'])->middleware(['auth'])->name('dashboard.delVote');

Route::get('dashboard/edit-journalist/{id}', [AdminController::class, 'editJournalistPage'])->middleware(['auth'])->name('dashboard.editJournalistPage');

Route::post('dashboard/edit-journalist/edit-data', [AdminController::class, 'editJournalistEditData'])->middleware(['auth'])->name('dashboard.editJournalistPage.editData');

Route::get('dashboard/add-journalist', [AdminController::class, 'addJournalistPage'])->middleware(['auth'])->name('dashboard.addJournalistPage');

Route::post('dashboard/add-journalist/add-data', [AdminController::class, 'addJournalistPageAddData'])->middleware(['auth'])->name('dashboard.addJournalistPage.addData');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
