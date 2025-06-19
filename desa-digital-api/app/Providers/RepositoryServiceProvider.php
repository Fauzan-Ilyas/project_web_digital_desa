<?php

namespace App\Providers;

<<<<<<< HEAD
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
=======
use App\Repositories\EventRepository;
use App\Interfaces\EventRepositoryInterface;
use App\Http\Controllers\SocialAssistanceRecipientsController;
use App\Interface\UserrepositoryInterface;
use App\Interfaces\DevelopmentRepositoryInterface;
use App\Interfaces\HeadOfFamilyRepositoryInterface;
use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use App\Models\Event;
use App\Models\SocialAssistance;
use App\Repositories\HeadOfFamilyRepository;
use App\Repositories\SocialAssistanceRecipientRepository;
use App\Repositories\UserRepository;
use App\Repositories\DevelopmentRepository;
use FamilyMemberRepository;
use FamilyMemberRepositoryInterface;
>>>>>>> main
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
<<<<<<< HEAD
     * Register services.   
=======
     * Register services
>>>>>>> main
     */

    public function register(): void 
    {
<<<<<<< HEAD
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
=======
        $this->app->bind(UserrepositoryInterface::class, UserRepository::class);
        $this->app->bind(HeadOfFamilyRepositoryInterface::class, HeadOfFamilyRepository::class);
        $this->app->bind(FamilyMemberRepositoryInterface::class, FamilyMemberRepository::class);
        $this->app->bind(SocialAssistanceRecipientRepositoryInterface::class, SocialAssistanceRecipientsController::class);
        $this->app->bind(SocialAssistanceRecipientRepositoryInterface::class, SocialAssistanceRecipientRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(DevelopmentRepositoryInterface::class, DevelopmentRepository::class);

>>>>>>> main
    }

    /**
     * Bootstrap services 
     */
    
    public function boot(): void
    {
        //
    }
}