<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardBibliotecarioController extends BaseController
{
    public function index()
    {
        return view('dashboard_biblioteca/dashboard-bibliotecario');
    }
}
