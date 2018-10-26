<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnidadeController extends Controller
{
    public function index(){
        return view('admin.unidade.index');
    }
}
