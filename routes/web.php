<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/organizations/create', [OrganizationController::class, 'store'])->name('organizations.store');
    Route::put('/organizations/{id}/update', [OrganizationController::class, 'update'])->name('organizations.update');
    Route::delete('/organizations/{id}/delete', [OrganizationController::class, 'delete'])->name('organizations.delete');
    Route::get('/organizations/{id}', [OrganizationController::class, 'view'])->name('organizations.view');
    
});

Route::middleware('auth')->group(function(){
    Route::get('/survey' , [SurveyController::class ,  'view'])->name('survey.view');
    Route::post('/survey/create' , [SurveyController::class ,'store'])->name('survey.store');
});

require __DIR__.'/auth.php';
