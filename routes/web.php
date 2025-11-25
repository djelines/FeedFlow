<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SurveyController;
use \App\Http\Controllers\MemberController;

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
    Route::get('/organizations', [OrganizationController::class, 'view'])->name('organizations.view');
    Route::get('/organizations/view/{id}', [OrganizationController::class, 'viewOrganization'])->name('organizations.viewOrganization');

    Route::post('/organizations/member/create', [MemberController::class, 'store'])->name('organizations.member.store');
    Route::delete('/organizations/member/{user_id}/delete', [MemberController::class, 'delete'])->name('organizations.member.delete');


    Route::get('/organizations/{id}', [OrganizationController::class, 'view'])->name('organizations.view');


    //Route for add question and Survey
    Route::get('/survey/show/{id}', [SurveyController::class, 'showSurvey'])->name('survey.show');
    Route::get('/survey/add/{id}', [SurveyController::class, 'add'])->name('survey.add');
    Route::post('/survey/question/create', [SurveyController::class, 'storeQuestion'])->name('survey.question.store');
    Route::delete('/survey/question/delete/{question}', [SurveyController::class, 'destroyQuestion'])->name('survey.question.destroy');
});

Route::middleware('auth')->group(function(){
    Route::get('/survey' , [SurveyController::class ,  'view'])->name('survey.view');
    Route::post('/survey/create' , [SurveyController::class ,'store'])->name('survey.store');
    Route::delete('/surveys/{survey}', [SurveyController::class, 'destroySurvey'])->name('surveys.destroy');
});

require __DIR__.'/auth.php';
