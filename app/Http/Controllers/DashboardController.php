<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboards.admin');
    }

    public function secretario()
    {
        return view('dashboards.secretario');
    }

    public function tecnico()
    {
        return view('dashboards.tecnico');
    }

    public function cliente()
    {
        return view('dashboards.cliente');
    }
}
