<?php

namespace App\Repositories;

use App\Models\EventParticipant;
use App\Interfaces\EventParticipantRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class EventParticipantRepository implements EventParticipantRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?string $limit,
        bool $execute
    ) {
        $query = EventParticipant::where(function ($query) use ($search){
            if ($search) {
                $query->search($search);
            }
        });

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
        ?int $rowPerPage
    ) {
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
        $query = EventParticipant::where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ) {
        DB::beginTransaction();

        try {
            $eventParticipant = new EventParticipant();
            $eventParticipant->event_id = $data['event_id'];
            $eventParticipant->head_of_family_id = $data['head_of_family_id'];
            $eventParticipant->quantity = $data['quantity'];
            $eventParticipant->total_price = $data['total_price'];
            $eventParticipant->payment_status = $data['payment_status'];
            $eventParticipant->save();

            DB::commit();

            return $eventParticipant;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());  
        }
    }

    public function update(
        string $id,
        array $data
    ) {
        DB::beginTransaction();

        try {
            $eventParticipant = EventParticipant::find($id);

            if (!$eventParticipant) {
                throw new Exception("EventParticipant not found.");
            }

            $eventParticipant->fill($data);
            $eventParticipant->save();

            DB::commit();

            return $eventParticipant;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());  
        }
    }

    public function delete(
        string $id
    ) {
        DB::beginTransaction();

        try {
            $eventParticipant = EventParticipant::find($id);

            if (!$eventParticipant) {
                throw new Exception("EventParticipant not found.");
            }

            $eventParticipant->delete();

            DB::commit();

            return $eventParticipant;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());  
        }
    }
}
