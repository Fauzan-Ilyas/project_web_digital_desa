<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface 
{
    public function getAll(
        ?string $search,
        ?int $limit, 
        bool $execute
    ){
        $query = User::where (function ($query) use ($search){

            // jika ada parameter search dia akan melakukan search, yang kita definisikan pada model user
            if($search){
                $query->search($search);
            }
        });

        if($limit){
            // take adalah mengambil beberapa berdasarkan limit
            $query->take($limit);
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(
        ?string $search, 
        ?int $rowPerPage
    ){
        $query = $this->getAll(
            $search,
            $rowPerPage,
            false
        );

        return $query->paginate($rowPerPage);
    }

    public function getById(
        string $id
    ){
        $query = User::where('id', $id);

        return $query->first();
        
    }

    public function create(
        array $data
    ){
        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            DB::commit();

            return $user;
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
            $user = User::find($id);
            $user->name = $data['name'];

            if (isset($data['password'])) {
                $user->password = $data['password'];
            }
            $user->save();

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            
            throw new \Exception($e->getMessage());
        }
    }

    public function delete(
        string $id
    ){
        DB::beginTransaction();

        try {
            $user = User::find($id);

            if (!$user) {     // kode 
                throw new \Exception('User not found'); // ini adalah untuk menangani jika user tidak ditemukan
            } // kode yang tidak ada di tutorial

            $user->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}