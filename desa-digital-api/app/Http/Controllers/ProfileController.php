<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Http\Requests\ProfileStoreRequest;
use App\Helpers\ResponseHelper;
use App\Interfaces\ProfileRepositoryInterface;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileRepositoryInterface $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index()
    {
        try {
            $profile = $this->profileRepository->get();

            if (!$profile) {
                return ResponseHelper::jsonResponse(false, 'Data Profile Tidak Ada', null, 200);
            }
            return ResponseHelper::jsonResponse(true, 'Profil Berhasil diambil', new ProfileResource($profile), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function store(ProfileStoreRequest $request)
    {
        $request = $request->validated();

        try {
            $profile = $this->profileRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data Berhasil Ditambahkan', new ProfileResource($profile), 201);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request = $request->validated();

        try {
            $profile = $this->profileRepository->update($request);

            return ResponseHelper::jsonResponse(true, 'Data Berhasil Diubah', new ProfileResource($profile), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
