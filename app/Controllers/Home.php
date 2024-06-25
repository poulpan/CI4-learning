<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('header', ['title' => 'Home'])
        //      . view('Home/index');  // we can concatenate as many views as we like

        return view('Home/index'); // just return this after you make layouts
    }
}
