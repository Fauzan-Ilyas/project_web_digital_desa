<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\SocialAssistanceRecipientsController;

Route::apiResource('social-assistance-recipient', SocialAssistanceRecipientsController::class);
Route::get('social-assistance-recipient/all/paginated', [SocialAssistanceRecipientsController::class, 'getAllPaginated']);

Route::apiResource('event', EventController::class);
Route::get('event/all/paginated', [EventController::class, 'getAllPaginated']);