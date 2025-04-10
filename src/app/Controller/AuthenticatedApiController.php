<?php

namespace Controller;

use Exception\Unauthorized;

class AuthenticatedApiController extends ApiController
{
    public function beforeExecuteRoute()
    {
        parent::beforeExecuteRoute();

        $userLoggedIn = true;

        if (!$userLoggedIn) {
            throw new Unauthorized();
        }

    }
}
