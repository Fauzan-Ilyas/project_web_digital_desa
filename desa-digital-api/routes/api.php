<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\HeadOfFamilyController;
use App\Http\Controllers\SocialAssistanceRecipientsController;
use App\Http\Controllers\DevelopmentController;
use App\Http\Controllers\EventController;


Route::apiResource('user', UserController::class);
Route::get('user/all/paginated', [UserController::class, 'getAllPaginated']);

Route::apiResource('head-of-family', HeadOfFamilyController::class);
Route::get('head-of-family/all/paginated', [HeadOfFamilyController::class, 'getAllPaginated']);

Route::apiResource('family-member', FamilyMemberController::class);
Route::get('family-member/all/paginated', [FamilyMemberController::class, 'getAllPaginated']);

Route::apiResource('social-assistance-recipient', SocialAssistanceRecipientsController::class);
Route::get('social-assistance-recipient/all/paginated', [SocialAssistanceRecipientsController::class, 'getAllPaginated']);

Route::apiResource('event', EventController::class);
Route::get('event/all/paginated', [EventController::class, 'getAllPaginated']);

Route::apiResource('development', DevelopmentController::class);
Route::get('development/all/paginated', [DevelopmentController::class, 'getAllPaginated']);

Route::apiResource('event-participant', EvenParticipantController::class);
Route::get('event-participant/all/paginated', [evenParticipantController::class, 'getAllPaginated']);

