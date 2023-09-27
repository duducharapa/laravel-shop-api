<?php
namespace App\Http\Repositories;

use App\Models\User;
use Exception;

class UserRepository {
    
    /**
     * Save an user instance on application.
     * 
     * @param mixed $input Fillable user data.
     */
    public function create($input): User|null {
        $user = new User($input);
        
        $user->save();
        return $user;        
    }

}