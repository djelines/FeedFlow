<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyResultsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SurveyController;
use \App\Http\Controllers\MemberController;
use PhpParser\Node\Name;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route for profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for organization management
    Route::post('/organizations/create', [OrganizationController::class, 'store'])->name('organizations.store');
    
    /* Fait*/Route::put('/organizations/{organization}/update', [OrganizationController::class, 'update'])->name('organizations.update');
    
    /* Fait*/Route::delete('/organizations/{organization}/delete', [OrganizationController::class, 'delete'])->name('organizations.delete');
    
    /* Fait*/Route::get('/organizations/view/{id}', [OrganizationController::class, 'viewOrganization'])->name('organizations.viewOrganization');
    Route::get('/organizations', [OrganizationController::class, 'view'])->name('organizations.view');
        /* Fait*/Route::get('/organizations/plan/{id}', [OrganizationController::class, 'viewOrganizationPlan'])->name('organizations.viewOrganizationPlan');

    // Routes for organization members management
    Route::post('/organizations/member/create', [MemberController::class, 'store'])->name('organizations.member.store');
     /* Fait*/Route::delete('/organizations/member/{organization_member}/delete', [MemberController::class, 'delete'])->name('organizations.member.delete');

    // Routes for survey question management
    Route::post('/survey/question/create', [SurveyController::class, 'storeQuestion'])->name('survey.question.store');
    /* Fait*/Route::delete('/survey/question/delete/{question}', [SurveyController::class, 'destroyQuestion'])->name('survey.question.destroy');
    /* Fait*/Route::put('/survey/question/update/{question}', [SurveyController::class, 'updateQuestion'])->name('survey.question.update');

    // Routes for survey management
   /* FAIT*/ Route::get('/survey/show/{id}', [SurveyController::class, 'showSurvey'])->name('survey.show');
   
    
    Route::get('/survey' , [SurveyController::class ,  'view'])->name('survey.view');
    Route::post('/survey/create' , [SurveyController::class ,'store'])->name('survey.store');
    /* Fait*/Route::put('/survey/update/{survey}', [SurveyController::class , 'updateSurvey'])->name('surveys.update');
    /* Fait*/Route::delete('/surveys/delete/{survey}', [SurveyController::class, 'destroySurvey'])->name('surveys.destroy');

    //Routes for survey answers and results / pdf
    /* Fait*/Route::get('/survey/questions/{id}' , action: [SurveyController::class ,  'viewQuestions'])->name('survey.view.questions');
    Route::post('/survey/answers/create/{id}' , [SurveyController::class ,'storeAnswers'])->name('survey.store.answers');
    /* Fait*/Route::get('/surveys/{survey}/results' , [SurveyResultsController::class , 'viewResults'])->name('survey.view.results');
    /* Fait*/Route::get('/surveys/{survey}/results/pdf' , [SurveyResultsController::class , 'downloadPdf'])->name('survey.answer.resultPdf');





    Route::get('/survey/add/{id}', [SurveyController::class, 'add'])->name('survey.add');

});

// Route for anonymous user
/* cour*/Route::get('/survey/{id}', [SurveyController::class, 'viewQuestionsAnonymous'])
    ->name('survey.public')
    ->middleware('signed');


/* cour*/Route::post('/survey/create/{id}', [SurveyController::class, 'storeAnswersAnonymous'])
    ->name('survey.answers.public')
    ->middleware('signed');


require __DIR__.'/auth.php';
