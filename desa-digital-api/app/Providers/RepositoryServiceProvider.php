<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\HeadOfFamilyRepositoryInterface;
use App\Interfaces\FamilyMemberRepositoryInterface;
use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use App\Interfaces\SocialAssistanceRepositoryInterface;
use App\Interfaces\EventRepositoryInterface;
use App\Interfaces\EventParticipantRepositoryInterface;
use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\DevelopmentRepositoryInterface;
use App\Interfaces\DevelopmentApplicationsRepositoryInterface;
use App\Interfaces\EventRepositoryInterface;
use App\Interfaces\DevelopmentRepositoryInterface;


use App\Repositories\UserRepository;
use App\Repositories\HeadOfFamilyRepository;
use App\Repositories\FamilyMemberRepository;
use App\Repositories\SocialAssistanceRecipientRepository;

use App\Repositories\ProfileRepository;
use App\Repositories\EventRepository;
use App\Repositories\SocialAssistanceRepository;
use App\Repositories\EventParticipantRepository;
use App\Repositories\DevelopmentApplicationsRepository;
use App\Repositories\EventRepository;
use App\Repositories\DevelopmentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void 
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(HeadOfFamilyRepositoryInterface::class, HeadOfFamilyRepository::class);
        $this->app->bind(FamilyMemberRepositoryInterface::class, FamilyMemberRepository::class);
        $this->app->bind(SocialAssistanceRepositoryInterface::class, SocialAssistanceRepository::class);
        $this->app->bind(SocialAssistanceRecipientRepositoryInterface::class, SocialAssistanceRecipientRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(EvenParticipantRepositoryInterface::class, EvenParticipantRepository::class);
        $this->app->bind(DevelopmentRepositoryInterface::class, DevelopmentRepository::class);
        $this->app->bind(DevelopmentApplicantRepositoryInterface::class, DevelopmentApplicantRepository::class);
        $this->app->bind(DevelopmentApplicationsRepositoryInterface::class, DevelopmentApplicationsRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(SocialAssistanceRecipientRepositoryInterface::class, SocialAssistanceRecipientsController::class);
    }

    public function boot(): void
    {
        //
    }
}