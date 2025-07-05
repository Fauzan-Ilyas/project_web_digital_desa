<?php

namespace App\Repositories;

use App\Interfaces\DevelopmentRepositoryInterface;
use App\Models\Development;
use App\Models\FamilyMember;
use Illuminate\Support\Facades\DB;

class DevelopmentRepository implements DevelopmentRepositoryInterface 
{
    public function getAll(
        ?string $search,
<<<<<<< HEAD
        ?string $status,
        ?string $limit,
=======
        ?int $limit,
>>>>>>> 57992d9b68a01eb9633a7f367bc3aa483acdd12c
        bool $execute
    ) {
        $query = Development::where(function ($query) use ($search){
            if ($search) {
                $query->search($search);
            }
        });

        if ($status === 'my-applications') {
            $query->whereHas('developmentApplicants', function ($query) {
                $members = FamilyMember::where('head_of_family_id', auth()->user()->head_of_family_id)->pluck('id');
                $members[] = auth()->user()->id;

                $query->whereIn('family_member_id', $members);
            });
        }

        $query->orderBy('created_at', 'desc');

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
        ?string $status,
        ?int $rowPerPage
    ) {
        $query = $this->getAll(
            $search,
            $status,
            $rowPerPage,
            false
        );

        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id
    ) {
        $query = Development::where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ) {
        DB::beginTransaction();

        try {
            $development = new Development;
            $development->thumbnail = $data['thumbnail']->store('assets/developments', 'public');
            $development->name = $data['name'];
            $development->description = $data['description'];
            $development->person_in_charge = $data['person_in_charge'];
            $development->start_date = $data['start_date'];
            $development->end_date = $data['end_date'];            
            $development->amount = $data['amount'];
            $development->status = $data['status'];            
            $development->save();

            DB::commit();

            return $development;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());  
        }
    }

    public function update(
        string $id,
        array $data
    ){
        DB::beginTransaction();

        try {
            $development = Development::find($id);
            if(isset($data['thumbnail'])) {
                $development->thumbnail = $data['thumbnail']->store('assets/developments', 'public');
            }
            $development->name = $data['name'];
            $development->description = $data['description'];
            $development->person_in_charge = $data['person_in_charge'];
            $development->start_date = $data['start_date'];
            $development->end_date = $data['end_date'];            
            $development->amount = $data['amount'];
            $development->status = $data['status'];            
            $development->save();

            DB::commit();

            return $development;
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
            $development = Development::find($id);

            $development->delete();

            DB::commit();

            return $development;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());  
        }
    }
}