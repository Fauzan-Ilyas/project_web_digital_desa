<?php

namespace App\Http\Controllers;

use App\interfaces\HeadOfFamilyRepositoryInterface;
use Illuminate\Http\Request;

class HeadOfFamilyController extends Controller
{

    private HeadOfFamilyRepositoryInterface $headOfFamilyRepository;

    public function __construct(HeadOfFamilyRepositoryInterface $headOfFamilyRepository)
    {
        $this->headOfFamilyRepository = $headOfFamilyRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $headOfFamilies = $this->headOfFamilyRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Kepala Keluarga Berhasil Diambil', HeadOfFamilyResource::collection($headOfFamilies), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(true, 'Data Kepala Keluarga Gagal Diambil', null, 500);
        }
    }

    public function getAllPaginate(Request $request)
    {
        $request = $request->validasi([
            'search' => 'nullable|string',
            'row_per_page' => 'required|integer'
        ]);
        try {
            $headOfFamilies = $this->headOfFamilyRepository->getAllPaginate(
                $request['search'] ?? null,
                $request['row_per_page'],
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Kepala Keluarga Berhasil Diambil', PaginateResource::make($headOfFamilies, HeadOfFamilyResource::class), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(true, 'Data Kepala Keluarga Gagal Diambil', null, 500);
        }

    }


    
    /**
     * Store a newly created resource in storage.
     */
    public function store(HeadOfFamilyStoreRequest $request)
    {
        $request = $request->validasi();
            
            try {
                $headOfFamily = $this->headOfFamilyRepository->create($request);

                return ResponseHelper::jsonResponse(true, 'Kepala Keluarga Berhasil Ditambahkan',new HeadOfFamilyResource($headOfFamily), 201);
            } catch (\Exception $e) {
                return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show( string $id)
    {
        try{
            $headOfFamily = $this->headOfFamilyRepository->getById(
                $id
            );

            if (!$headOfFamily) {
                return ResponseHelper::jsonResponse(false, 'Kepala Keluarga Tidak Ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Detail Kepala Keluarga Berhasil Diambil',new HeadOfFamilyResource($headOfFamily), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */


    public function update(HeadOfFamilyUpdateRequest $request,string $id)
    {
        $request = $request->validasi();
            
            try {
                $headOfFamily = $this->headOfFamilyRepository->getById(
                    $id
            );

            if (!$headOfFamily) {
                return ResponseHelper::jsonResponse(false, 'Kepala Keluarga Tidak Ditemukan', null, 404);
            }

                $headOfFamily = $this->headOfFamilyRepository->update(
                    $id,
                    $request
                );

                return ResponseHelper::jsonResponse(true, 'Kepala Keluarga Berhasil DiUpdate',new HeadOfFamilyResource($headOfFamily), 200);
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
                $headOfFamily = $this->headOfFamilyRepository->getById(
                    $id
            );

            if (!$headOfFamily) {
                return ResponseHelper::jsonResponse(false, 'Kepala Keluarga Tidak Ditemukan', null, 404);
            }

                $headOfFamily = $this->headOfFamilyRepository->delete(
                    $id
                );

                return ResponseHelper::jsonResponse(true, 'Kepala Keluarga Berhasil DiHapus', null, 200);
            } catch (\Exception $e) {
                return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
            }
    }
}
