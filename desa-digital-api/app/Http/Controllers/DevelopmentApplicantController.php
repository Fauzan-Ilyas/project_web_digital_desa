<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\DevelopmentApplicantStoreRequest;
use App\Http\Resources\DevelopmentApplicantRequest;
use App\Http\Resources\PaginatedResource;
use App\Interface\DevelopmentApplicantRepositoryInterface;
use Illuminate\Http\Request;

class DevelopmentApplicantController extends Controller
{
    private DevelopmentApplicantRepositoryInterface $developmentApplicantRepository;

    public function __construct(DevelopmentApplicanRepositoryInterfae $developmentApplicanRepository)
    {
        $this->developmentApplicanRepository = $developmentApplicanRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $developmentApplicants = $this->developmentApplicantRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Pendaftar Pembangunan Berhasil Diambil', DevelopmentApplicantResource::collection($developmentApplicants), 200);
        } catch (\Exception $te) {
           return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
           
        $request = $request->validate([
           'search' => 'nullable|string',
           'row_per_page' => 'required|integer'
        ]);

        try {
            $developmentApplicants = $this->developmentApplicantRepository->getAllPaginated(
                $request['search']?? null,
                $request['row_per_page']
            );

            return ResponseHelper::jsonResponse(true, 'Data Pendaftar Pembangunan Berhasil Diambil', PaginatedResource::make($developmentApplicants, DevelopmentApplicantResource::class), 200 );
        } catch (\Exception $te) {
           return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
 
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(DevelopmentApplicantRequest $request)
    {
        $request = $request->validated();

        try {
            $developmentApplicants = $this->developmentApplicanRepository->create($request);

            return ResponseHelper::jsonResponse::jsonResponse(true,'Data Pendaftar Pembangunan Berhasil Dibuat', new DevelopmentApplicantResource($developmentApplicant), 200);
        } catch (\Exception $te) {
           return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $developmentApplicants = $this->developmentApplicanRepository->getById($id);

            if (!$developmentApplicant) {
                return ResponseHelper::jsonResponse(false, 'Data Pendaftar Pembangunan Tidak Ditemukan', null,404);
            }

            return ResponseHelper::jsonResponse::jsonResponse(true,'Data Pendaftar Pembangunan Berhasil Diambil', new DevelopmentApplicantResource($developmentApplicant), 200);
        } catch (\Exception $te) {
           return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(DevelopmentApplicantUpdateRequest $requst, string $id)
    {
        $request = $request->validated();

        try {
            $developmentApplicants = $this->developmentApplicanRepository->getById($id);

            if (!$developmentApplicant) {
                return ResponseHelper::jsonResponse(false, 'Data Pendaftar Pembangunan Tidak Ditemukan', null,404);
            }

            $developmentApplicant = $this->developmentApplicantRepository->update($id, $request);

            return ResponseHelper::jsonResponse::jsonResponse(true,'Data Pendaftar Pembangunan Berhasil DiUpdate', new DevelopmentApplicantResource($developmentApplicant), 200);
        } catch (\Exception $te) {
           return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          try {
            $developmentApplicants = $this->developmentApplicanRepository->getById($id);

            if (!$developmentApplicant) {
                return ResponseHelper::jsonResponse(false, 'Data Pendaftar Pembangunan Tidak Ditemukan', null,404);
            }

            $this->developmentApplicanRepository->delete($id);

            return ResponseHelper::jsonResponse::jsonResponse(true,'Data Pendaftar Pembangunan Berhasil Dihapus', null, 200);
        } catch (\Exception $te) {
           return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
