<?php

namespace App\Controllers\backoffice;

use App\Controllers\CoreController;
use App\Models\User;

class UserController extends CoreController
{
    public function browse()
    {
        $usersList = User::findAll();

        $this->show('backoffice/user/browse', [
            'users' => $usersList,
            
        ]);
    }
}