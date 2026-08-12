<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LeitoresController extends BaseController
{
    public function index()
    {
        return view('leitores/leitores');
    }
}
