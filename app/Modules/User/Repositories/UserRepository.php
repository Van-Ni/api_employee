<?php 

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\User;
use App\Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    
    /**
     * create user.
     * @param  $validated
     * @return mixed
     */
    public function create($validated){
        return User::create($validated);
    }
    
}
?>