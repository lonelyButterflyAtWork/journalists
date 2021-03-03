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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth'])
                                                          ->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('dashboard/show-votes', [AdminController::class, 'showVotesAjax'])->middleware(['auth'])->name('dashboard.showVotes');

Route::post('dashboard/del-journalist', [AdminController::class, 'delJournalist'])->middleware(['auth'])->name('dashboard.delJournalist');

Route::post('dashboard/del-vote', [AdminController::class, 'delVoteAjax'])->middleware(['auth'])->name('dashboard.delVote');

Route::get('dashboard/edit-journalist/{id}', [AdminController::class, 'editJournalistPage'])->middleware(['auth'])->name('dashboard.editJournalistPage');

Route::post('dashboard/edit-journalist/edit-data', [AdminController::class, 'editJournalistEditData'])->middleware(['auth'])->name('dashboard.editJournalistPage.editData');
