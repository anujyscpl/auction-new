<?php

namespace App\Interfaces;


/**
 * interface UserRepositoryInterface.
 */
interface UserRepositoryInterface {

    public function createUser(array $data);

    public function validateCredentials(array $credentials);
}
