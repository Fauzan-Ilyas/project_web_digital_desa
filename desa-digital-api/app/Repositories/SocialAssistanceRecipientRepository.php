<?php

namespace App\Repositories;

use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use App\Models\SocialAssistanceRecipient;
use Exeception;
use Illuminate\Support\Facades\DB;

class SocialAssistanceRecipientRepository implements SocialAssistanceRecipientRepositoryInterface {
    public function getAll(?string $search, ?int $limit, bool $execute)
    {
        $query = SocialAssistanceRecipient::where(function($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');

        if($limit){
            $query->take($limit);
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search, ?int $rowsPerPage)
    {
        $query = $this->getAll(
            $search,
            $rowsPerPage,
            false
        );

        return $query->paginate($rowsPerPage);
    }

    public function getById(string $id)
    {
        $query = SocialAssistanceRecipient::where('id', $id);

        return $query->first();
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $socialAssistanceRecipient = new SocialAssistanceRecipient;
            $socialAssistanceRecipient->social_assistance_id = $data['social_assistance_id'];
            $socialAssistanceRecipient->head_of_family_id = $data['head_of_family_id'];
            $socialAssistanceRecipient->amount = $data['amount'];
            $socialAssistanceRecipient->reason = $data['reason'];
            $socialAssistanceRecipient->bank = $data['bank'];
            $socialAssistanceRecipient->account_number = $data['account_number'];

            if (isset($data['proof'])) {
                $socialAssistanceRecipient->proof = $data['proof'];
            }

            if (isset($data['status'])) {
                $socialAssistanceRecipient->status = $data['status'];
            }

            $socialAssistanceRecipient->save();

            DB::commit();

            return $socialAssistanceRecipient;
        } catch (\Exeception $e) {
            DB::roolBack();

            throw new Exeception($e->getMessage());
        }
    }

    public function update(string $id, array $data) 
    {
         DB::beginTransaction();

        try {
            $socialAssistanceRecipient = SocialAssistanceRecipient::find($id);
            $socialAssistanceRecipient->social_assistance_id = $data['social_assistance_id'];
            $socialAssistanceRecipient->head_of_family_id = $data['head_of_family_id'];
            $socialAssistanceRecipient->amount = $data['amount'];
            $socialAssistanceRecipient->reason = $data['reason'];
            $socialAssistanceRecipient->bank = $data['bank'];
            $socialAssistanceRecipient->account_number = $data['account_number'];

            if (isset($data['proof'])) {
                $socialAssistanceRecipient->proof = $data['proof'];
            }

            if (isset($data['status'])) {
                $socialAssistanceRecipient->status = $data['status'];
            }

            $socialAssistanceRecipient->save();

            DB::commit();

            return $socialAssistanceRecipient;
        } catch (\Exeception $e) {
            DB::roolBack();

            throw new Exeception($e->getMessage());
        }
    }

    public function delete(
        string $id
    ) {
        DB::beginTransaction();

        try {
            $socialAssistanceRecipient = SocialAssistanceRecipient::find($id);
            $socialAssistanceRecipient->delete();

            DB::commit();

            return $socialAssistanceRecipient;
        } catch (\Exeception $e) {
            DB::roolBack();

            throw new Exeception($e->getMessage());
        }
    }
}