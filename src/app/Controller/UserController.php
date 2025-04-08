<?php

namespace Controller;

use Model\User;

class UserController extends AuthenticatedApiController
{
    public function indexAction()
    {
        /** @var User[] $users */
        $users = User::find([
            'limit' => 20,
            'order' => 'id DESC'
        ]);

        return $users;
    }
}
