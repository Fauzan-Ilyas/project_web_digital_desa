<?php

<<<<<<< HEAD
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::get('user/all/paginated', [UserController::class, 'getAllPaginated']);
=======
use App\Http\Controllers\DevelopmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SocialAssistanceRecipientsController;

Route::apiResource('social-assistance-recipient', SocialAssistanceRecipientsController::class);
Route::get('social-assistance-recipient/all/paginated', [SocialAssistanceRecipientsController::class, 'getAllPaginated']);

Route::apiResource('event', EventController::class);
Route::get('event/all/paginated', [EventController::class, 'getAllPaginated']);

Route::apiResource('development', DevelopmentController::class);
Route::get('development/all/paginated', [DevelopmentController::class, 'getAllPaginated']);
>>>>>>> main
