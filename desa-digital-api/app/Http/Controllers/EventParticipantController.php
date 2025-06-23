<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventParticipantController extends Controller
{

    private EvenParticipantRepositoryInterface $evenParticipantRepository;

    public function __construct(EvenParticipantRepositoryInterface $evenParticipantRepository)
    {
        $this->evenParticipantRepository = $evenParticipantRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $evenParticipants = $this->evenParticipantRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Pendaftaran Event Berhasil Diambil', EvenParticipantResource::collection($evenParticipants), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }


    public function getAllPaginate(Request $request)
    {
        $request = $request->validate([
            'search' => 'nullable|string',
            'row_Per_Page' => 'nullable|integer'
        ]);

        try {
            $evenParticipants = $this->evenParticipantRepository->getAllPaginate(
                $request['search'] ?? null,
                $request['row_Per_Page']
            );

            return ResponseHelper::jsonResponse(true, 'Data Pendaftaran Event Berhasil Diambil', PaginateResource::make($evenParticipants, EvenParticipantResource::class), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventParticipantStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $evenParticipants = $this->evenParticipantRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data Pendaftaran Event Berhasil Ditambahkan', new EvenParticipantResource($evenParticipant), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $evenParticipant = $this->eventParticipantRepository->getById($id);

            if (!$evenParticipant) {
                return ResponseHelper::jsonResponse(false, 'Data Pendaftar Event Tidak Ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data Event Berhasil Diambil', new EventParticipantResource($evenParticipant), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(eventParticipantUpdateRequest $request, string $id)
    {
        $request = $request->validated();

        try {
            $evenParticipant = $this->eventParticipantRepository->getById($id);

            if (!$evenParticipant) {
                return ResponseHelper::jsonResponse(false, 'Data Pendaftar Event Tidak DiUpdate', null, 404);
            }

            $evenParticipant = $this->eventParticipantRepository->update($id, $request);

            return ResponseHelper::jsonResponse(true, 'Data Event Berhasil Diambil', new EventParticipantResource($evenParticipant), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $evenParticipant = $this->eventParticipantRepository->getById($id);

            if (!$evenParticipant) {
                return ResponseHelper::jsonResponse(false, 'Data Pendaftar Event Tidak Ditemukan', null, 404);
            }

            $this->eventParticipantRepository->delete($id);

            return ResponseHelper::jsonResponse(true, 'Data Event Berhasil DiHapus', null, 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
