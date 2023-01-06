<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('main.php');
    }
    public function Login()
    {
        return view('logowanie.php');
    }
}
