<?php

namespace App\Http\Controllers;

use App\Interfaces\SocialAssistanceRecipientRepositoryInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\SocialAssistanceRecipientStoreRequest;
use App\Http\Requests\SocialAssistanceRecipientUpdateRequest;
use App\Http\Resources\SocialAssistanceRecipientResource;
use App\Models\SocialAssistance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use PhpParser\Node\Stmt\TryCatch;

class SocialAssistanceRecipientsController extends Controller
{
    private SocialAssistanceRecipientRepositoryInterface $socialAssistanceRecipientRepository;

    public function __construct(SocialAssistanceRecipientRepositoryInterface $socialAssistanceRecipientRepository)
    {
        $this->socialAssistanceRecipientRepository = $socialAssistanceRecipientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $socialAssistanceRecipients = $this->socialAssistanceRecipientRepository->getAll(
                $request->search,
                $request->limit,
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Diambil', SocialAssistanceRecipientResource::collection($socialAssistanceRecipients), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function getAllPAginated(Request $request)
    {
        $request = $request->validated([
            'search' => 'nullable|string',
            'row_per_page' => 'nullable|integer'
        ]);

        try {
            $socialAssistanceRecipients = $this->socialAssistanceRecipientRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page'],
                true
            );

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Diambil', PaginatedResource::make($socialAssistanceRecipients, SocialAssistanceRecipientResource), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialAssistanceRecipientStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $socialAssistanceRecipients = $this->socialAssistanceRecipientRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Dibuat', SocialAssistanceRecipientResource::make($socialAssistanceRecipients), 200);
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
            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->getById(
                $id
            );

            if(!$socialAssistanceRecipient){
                return ResponseHelper::jsonResponse(false, 'Data Penerima Bantuan Sosial Tidak Ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Ditemukan', new SocialAssistanceRecipientResource($socialAssistanceRecipient), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialAssistanceRecipientUpdateRequest $request, string $id)
    {
        $request = $request->validated();

        try {
            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->getById(
                $id
            );

            if (!$socialAssistanceRecipient) {
                return ResponseHelper::jsonResponse(false, 'Data Penerima Bantuan Sosial Tidak Ditemukan', null, 404);
            }

            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->update(
                $id,
                $request
            );

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Diupdate', SocialAssistanceRecipientResource::make($socialAssistanceRecipient), 200);
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
            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->getById(
                $id
            );

            if (!$socialAssistanceRecipient) {
                return ResponseHelper::jsonResponse(false, 'Data Penerima Bantuan Sosial Tidak Ditemukan', null, 404);
            }

            $socialAssistanceRecipient = $this->socialAssistanceRecipientRepository->delete(
                $id
            );

            return ResponseHelper::jsonResponse(true, 'Data Penerima Bantuan Sosial Berhasil Dihapus', SocialAssistanceRecipientResource::make($socialAssistanceRecipient), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}

