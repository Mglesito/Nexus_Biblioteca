<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CatalogoController extends BaseController
{
    public function index()
    {
        return view('catalogo/catalogo');
    }
}
