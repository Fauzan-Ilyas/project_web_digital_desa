<?php

namespace App\Repositories;

use App\Interfaces\SocialAssistanceRepositoryInterface;
use App\Models\SocialAssistance;
use Illuminate\Support\Facades\DB;

class SocialAssistanceRepository implements SocialAssistanceRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = SocialAssistance::where( function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        })->with('socialAssistanceRecipients');

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search, 
        ?int $rowPerPage
    ){
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false
        );

        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id
    ) {
        $query = SocialAssistance::where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ){
        DB::beginTransaction();
        try {
            $socialAssistance = new SocialAssistance;
            $socialAssistance->thumbnail = $data['thumbnail']->store('assets/social-assistances', 'public');
            $socialAssistance->name = $data['name'];
            $socialAssistance->category = $data['category'];
            $socialAssistance->amount = $data['amount'];
            $socialAssistance->provider = $data['provider'];
            $socialAssistance->description = $data['description'];
            $socialAssistance->is_available = $data['is_available'];
            $socialAssistance->save();

            DB::commit();

            return $socialAssistance;
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function update(
        string $id,
        array $data
    ) {
        DB::beginTransaction();
        try {
            $socialAssistance = SocialAssistance::find($id);
            // if (!$socialAssistance) {
            //     throw new \Exception('Bantuan sosial tidak ditemukan');
            // }

            if (isset($data['thumbnail'])) {
                $socialAssistance->thumbnail = $data['thumbnail']->store('assets/social-assistances', 'public');
            }
            $socialAssistance->name = $data['name'] ?? $socialAssistance->name;
            $socialAssistance->category = $data['category'] ?? $socialAssistance->category;
            $socialAssistance->amount = $data['amount'] ?? $socialAssistance->amount;
            $socialAssistance->provider = $data['provider'] ?? $socialAssistance->provider;
            $socialAssistance->description = $data['description'] ?? $socialAssistance->description;
            $socialAssistance->is_available = isset($data['is_available']) ? (bool)$data['is_available'] : $socialAssistance->is_available;
            $socialAssistance->save();

            DB::commit();

            return $socialAssistance;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function delete(
        string $id
    ) {
        DB::beginTransaction();
        try {
            $socialAssistance = SocialAssistance::find($id);
            if (!$socialAssistance) {
                throw new \Exception('Bantuan sosial tidak ditemukan');
            }

            $socialAssistance->delete();

            DB::commit();

            return $socialAssistance;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}