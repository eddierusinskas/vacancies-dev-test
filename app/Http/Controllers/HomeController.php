<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show index page for vacancies
     */
    public function index()
    {
        return view('index');
    }
}
