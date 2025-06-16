<?php

namespace App\Providers;

use App\Http\Controllers\SocialAssistanceRecipientsController;
use App\Interface\UserrepositoryInterface;
use App\Interfaces\HeadOfFamilyRepositoryInterface;
use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use App\Models\SocialAssistance;
use App\Repositories\HeadOfFamilyRepository;
use App\Repositories\SocialAssistanceRecipientRepository;
use App\Repositories\UserRepository;
use FamilyMemberRepository;
use FamilyMemberRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */

    public function register(): void 
    {
        $this->app->bind(UserrepositoryInterface::class, UserRepository::class);
        $this->app->bind(HeadOfFamilyRepositoryInterface::class, HeadOfFamilyRepository::class);
        $this->app->bind(FamilyMemberRepositoryInterface::class, FamilyMemberRepository::class);
        $this->app->bind(SocialAssistanceRecipientRepositoryInterface::class, SocialAssistanceRecipientsController::class);

    }

    /**
     * Bootstrap services 
     */
    
    public function boot(): void
    {
        //
    }
}