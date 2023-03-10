<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class UserRepository implements UserRepositoryInterface
{
    /**
     * @param array $data
     * @return bool|array
     */
    public function createUser(array $data): bool|array
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : null,
                'is_verified' => 1,
                'phone_number' => $data['phone_number']
            ]);

            if (!$user) {
                DB::rollBack();
                return false;
            }

            $user_address = Address::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'address' => $data['address'],
                'landmark' => $data['landmark'],
                'city' => $data['city'],
                'state' => $data['state'],
                'postcode' => $data['postcode'],
                'country' => $data['country'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'is_default' => ($data['is_default']) ?? 0
            ]);

            if (!$user_address) {
                DB::rollBack();
                return false;
            }

            DB::commit();
            return $user->toArray();

        }catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return false;
        }
    }

    /**
     * @param array $credentials
     * @return bool|array
     */
    public function validateCredentials(array $credentials): bool|array
    {
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return false;
        }

        $check = Hash::check($credentials['password'], $user->password);
        if (!$check) {
            return false;
        }

        $user->update(['api_access_token' => hash('sha256', Str::random(40))]);

        $user->save();

        return $user->toArray();
    }

}
