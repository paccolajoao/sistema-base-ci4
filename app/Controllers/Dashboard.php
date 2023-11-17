<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = ucfirst('Dashboard');
        return view('template/head.php', $data)
            . view('template/menu.php')
            . view("pages/dashboard/index.php")
            . view('template/footer.php');
    }
}
