<?php

namespace App\Providers;

use App\interface\FamilyMemberRepositoryInterface;
use App\Interface\HeadOfFamilyResponseInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\HeadOfFamilyRepositoryInterface;
use App\Repositories\HeadOfFamilyRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(HeadOfFamilyRepositoryInterface::class, HeadOfFamilyRepository::class);
        $this->app->bind(FamilyMemberRepositoryInterface::class, FamilyMemberRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
