<?php

namespace App\Repositories;

use App\Interfaces\EvenParticipantRepositoryInterface;
use App\Models\EvenParticipant;

class EvenParticipantRepository implements EvenParticipantRepositoryInterface
{
    public function getAll(
        ?string $search,
        ?int $limit,
        bool $execute
    ) {
        $query = EvenParticipant::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });

        $query->orderBy('created_at', 'desc');

        if ($limit) {
            $query->limit($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginate(
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
        $query = EvenParticipant::where('id', $id);

        return $query->first();
    }

    public function create(
        array $data
    ) {
        DB::beginTransaction();

        try {
            $event = Event::where('id', $data['event_id'])->first();

            $evenParticipant = new EventParticipant();
            $evenParticipant->event_id = $data['event_id'];
            $evenParticipant->head_of_family_id = $data['head_of_family_id'];
            $evenParticipant->quantity = $data['quantity'];
            $evenParticipant->total_price = $event->price * $data['quantity'];
            $evenParticipant->payment_status = "Pending";
            $evenParticipant->save();

            DB::commit();

            return $evenParticipant;
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
            $event = Event::where('id', $data['event_id'])->first();

            $evenParticipant = EventParticipant::find($id);
            $evenParticipant->event_id = $data['event_id'];
            $evenParticipant->head_of_family_id = $data['head_of_family_id'];

            if (isset($data['quantity'])) {
                $evenParticipant->quantity = $data['quantity'];
            } else {
                $data['quantity'] = $evenParticipant->quantity;
            }

            $evenParticipant->total_price = $event->price * $data['quantity'];
            $evenParticipant->payment_status = $data['payment_status'];
            $evenParticipant->save();

            DB::commit();

            return $evenParticipant;
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
            $evenParticipant = EventParticipant::find($id);

            $evenParticipant->delete();

            DB::commit();

            return $evenParticipant;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());  
        };
    }
}