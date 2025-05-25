<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('Tai yra testinis laiškas!', function ($message) {
        $message->to('pipyneainis@gmail.com')
                ->subject('Testas iš Laravel');
    });

    return 'Laiškas išsiųstas!';
});

Route::post('/submit-form', [FormController::class, 'submit'])->name('submit.form');

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('/send-pdf-email', [PDFController::class, 'sendPDFEmail']);

Route::get('students/trashed', [StudentController::class, 'trashed'])->name('students.trashed');

Route::post('students/{id}/restore', [StudentController::class, 'restore'])->name('students.restore');
Route::delete('students/{id}/forceDelete', [StudentController::class, 'forceDelete'])->name('students.forceDelete');

Route::resource('students', StudentController::class);

/*
Route::get('/', function () {
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