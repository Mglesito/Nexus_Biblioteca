<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AcervoController extends BaseController
{
    public function index()
    {
        return view('acervo/acervo');
    }
}
