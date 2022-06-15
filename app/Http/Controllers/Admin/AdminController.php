<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:web');
    }
    

    public function home(){
        $data = Feature::all();
        return view('admin.feature.index', compact('data'));
    }
}
