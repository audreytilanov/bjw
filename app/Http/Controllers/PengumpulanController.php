<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Feature;
use App\Models\NewsAnchor;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PengumpulanController extends Controller
{
    public function feature(){
        $data = Feature::with('features')->get();
        return view('admin.pengumpulan.feature', compact('data'));
    }

    public function file($id){
        $data = Feature::find($id);
        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Mendownload Feature Pengumpulan ". $data->name . " | Pengumpulan",
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $path = public_path()."/features_asset/pengumpulan/".$data->features->file;
        return Response::download($path);
    }

    public function video(){
        $data = Video::has('videos')->get();
        return view('admin.pengumpulan.video', compact('data'));
    }

    public function newsanchor(){
        $data = NewsAnchor::has('newsanchors')->get();
        return view('admin.pengumpulan.newsanchor', compact('data'));
    }
}
