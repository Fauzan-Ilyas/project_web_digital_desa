<?php

namespace App\Interfaces;

interface EventParticipantRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?string $limit,
        bool $execute
    );

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    );

    public function getById(
        string $id
    );

    public function create(
        array $data
    );

    public function update(
        string $id,
        array $data
    );

    public function delete(
        string $id
    );
}