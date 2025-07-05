<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    /**
     * Login a user.
     *
     * @param array<string, mixed> $credentials
     * @return array<string, mixed>
     */
    public function login(array $data);
    
    /**
     * Logout the authenticated user.
     *
     * @return void
     */
    public function logout();
    
    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User|null
     */
    public function me();
}


