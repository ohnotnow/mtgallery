<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $galleries = Gallery::orderBy('name')->get();
        return view('admin/dashboard', compact('galleries'));
    }
}
