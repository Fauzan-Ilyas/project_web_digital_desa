<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Interfaces\SocialAssistanceRepositoryInterface;
use App\Models\SocialAssistance;
use Illuminate\Http\Request;
use App\Http\Resources\SocialAssistanceResource;
use App\Http\Resources\PaginateResource;

class SocialAssistanceController extends Controller
{
    private SocialAssistanceRepositoryInterface $socialAssistanceRepository;

    public function __construct(SocialAssistanceRepositoryInterface $socialAssistanceRepository) {
        $this->socialAssistanceRepository = $socialAssistanceRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $socialAssistances = $this->socialAssistanceRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(
                true, 
                'Data bantuan sosial berhasil diambil', 
                SocialAssistanceResource::collection($socialAssistances), 
                200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(
                false, 
                $e->getMessage(), 
                null, 
                500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        $request = $request->validate([
            'search' => 'nullable|string',
            'rowPerPage' => 'required|integer',
        ]);

        try {
            $socialAssistances = $this->socialAssistanceRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page']
            );

            return ResponseHelper::jsonResponse(
            true, 
            'Data bantuan sosial berhasil diambil', 
            PaginateResource::make($socialAssistances, SocialAssistanceResource::class),
            200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(
                false, 
                $e->getMessage(), 
                null, 
                500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
