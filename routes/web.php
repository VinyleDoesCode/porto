<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// Portfolio landing page
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');

// Profile Update (POST is used for file upload compatibility)
Route::post('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');

// Experience AJAX CRUD
Route::apiResource('experiences', ExperienceController::class)->only(['store', 'update', 'destroy']);

// Education AJAX CRUD
Route::apiResource('educations', EducationController::class)->only(['store', 'update', 'destroy']);

// Project AJAX CRUD (POST is used for update due to thumbnail file upload)
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::post('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

// Skill AJAX CRUD
Route::apiResource('skills', SkillController::class)->only(['store', 'update', 'destroy']);
