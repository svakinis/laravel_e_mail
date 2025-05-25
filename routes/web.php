<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');


Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
Route::delete('students/{id}/forceDelete', [StudentController::class, 'forceDelete'])->name('students.forceDelete');
//Route::get('/students', [StudentController::class, 'index']);
Route::resource('students', StudentController::class);


Route::resource('students', StudentController::class);
/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::prefix('c')->group(function () {
Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->middleware('auth')->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->middleware('auth')->name('contacts.store');
});