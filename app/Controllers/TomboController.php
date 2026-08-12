<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TomboController extends BaseController
{
    public function index()
    {
        return view('tombo/tombo');
    }
}
