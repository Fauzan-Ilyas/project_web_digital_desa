<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Interfaces\ProfileRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    private ProfileRepositoryInterface $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index()
    {
        try{
            $profile = $this->profileRepository->get();

            if(!$profile){
                return ResponseHelper::jsonResponse(false, 'Profile tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Profile berhasil Diambil', new ProfileResource($profile), 200);
        }catch(\Exception $e){
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500,);

        }
    }

    public function store(ProfileStoreRequest $request)
    {
        $request = $request->validated();

        try{
            $profile = $this->profileRepository->create($request);

            return ResponseHelper::jsonResponse(true, 'Data Profile Berhasil Dibuat', new ProfileResource($profile), 201);
        }catch(\Exception $e){
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request = $request->validated();

        try{
            $profile = $this->profileRepository->update($request);

            return ResponseHelper::jsonResponse(true, 'Data Profile Berhasil Diperbarui', new ProfileResource($profile), 200);
        }catch(\Exception $e){
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
