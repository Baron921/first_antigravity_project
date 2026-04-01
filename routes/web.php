<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\ApplicationController;

// Page d'accueil avec la liste des offres d'emploi
Route::get('/', [JobOfferController::class, 'index'])->name('home');

// Authentification
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Détail d'une offre (accessible à tous les connectés)
    Route::get('jobs/{jobOffer}', [JobOfferController::class, 'show'])->name('jobs.show');

    // Espace Candidat
    Route::middleware('role:candidate')->group(function() {
        Route::post('jobs/{jobOffer}/apply', [ApplicationController::class, 'store'])->name('applications.store');
        Route::get('my-applications', [ApplicationController::class, 'index'])->name('candidate.applications');
    });

    // Espace Entreprise
    Route::middleware('role:company')->group(function() {
        Route::resource('company/jobs', JobOfferController::class)->names('company.jobs')->except(['index', 'show']);
        Route::get('company/dashboard', [JobOfferController::class, 'companyDashboard'])->name('company.dashboard');
        Route::get('company/jobs/{jobOffer}/applications', [ApplicationController::class, 'companyApplications'])->name('company.jobs.applications');
        Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
    });
});
