<?php

namespace App\Controllers;

use App\Core\View;

class LoginController
{
    public function show()
    {
        View::show('login.php', []);
    }

}