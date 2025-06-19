 <?php

namespace App\Repositories;

use App\Interfaces\HeadOfFamilyRepositoryInterface;
use App\Models\HeadOfFamily; // pastikan model ini benar

class HeadOfFamilyRepository implements HeadOfFamilyRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit, 
        bool $execute
    ) {
        $query = HeadOfFamily::where(function ($query) use ($search) {
            // Jika ada parameter search, lakukan pencarian berdasarkan scope search
            if ($search) {
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');

        if ($limit) {
            $query->take($limit); // ambil sejumlah data berdasarkan limit
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search,
        ?int $rowPerPage
    ) {
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false // jangan langsung eksekusi, biarkan paginate yang eksekusi
        );

        return $query->paginate($rowPerPage); // fallback jika null
    }
}
