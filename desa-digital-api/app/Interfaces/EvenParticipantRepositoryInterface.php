<?php

namespace App\Interfaces;

interface EvenParticipantRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    );

    public function getAllPaginate(
        ?string $search,
        ?int $rowPerPage
    );
}