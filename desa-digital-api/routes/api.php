<?php
use App\Http\Controllers\SocialAssistanceRecipientsController;

Route::apiResource('social-assistance-recipient', SocialAssistanceRecipientsController::class);
Route::get('social-assistance-recipient/all/paginated', [SocialAssistanceRecipientsController::class, 'getAllPaginated']);

Route::apiResource('event-participant', EvenParticipantController::class);
Route::get('event-participant/all/paginated', [evenParticipantController::class, 'getAllPaginated']);