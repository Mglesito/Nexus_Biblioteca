<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ModalController extends BaseController
{
    public function index()
    {
        return view('modal/modal');
    }
}
