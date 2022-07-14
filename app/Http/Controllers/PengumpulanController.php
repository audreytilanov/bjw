<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Video;
use App\Models\Feature;
use App\Models\NewsAnchor;
use Illuminate\Http\Request;
use App\Models\VideoPengumpulan;
use App\Models\FeaturePengumpulan;
use App\Models\NewsAnchorPengumpulan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PengumpulanController extends Controller
{
    public function feature(){
        $data = Feature::has('features')->get();
        return view('admin.pengumpulan.feature', compact('data'));
    }

    public function featureAccept($id){
        $data = Feature::find($id);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menerima (Accept) ". $data->name . " | Pengumpulan Features",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $find = FeaturePengumpulan::where('feature_id',$data->id)->first();

        $find->update([
            'status' => "2"
        ]);

        toast('Peserta diterima :)','success');
        return redirect()->back()->with('success', 'Account created successfully');

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

    public function videoAccept($id){
        $data = Video::find($id);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menerima (Accept) ". $data->group_name . " | Pengumpulan Video",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $find = VideoPengumpulan::where('video_id',$data->id)->first();

        $find->update([
            'status' => "2"
        ]);

        toast('Peserta diterima :)','success');
        return redirect()->back()->with('success', 'Account created successfully');

    }

    public function newsanchor(){
        $data = NewsAnchor::has('newsanchors')->get();
        return view('admin.pengumpulan.newsanchor', compact('data'));
    }

    public function newsAnchorAccept($id){
        $data = NewsAnchor::find($id);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menerima (Accept) ". $data->name . " | Pengumpulan Newsanchor",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $find = NewsAnchorPengumpulan::where('news_anchor_id',$data->id)->first();

        $find->update([
            'status' => "2"
        ]);

        toast('Peserta diterima :)','success');
        return redirect()->back()->with('success', 'Account created successfully');

    }
}
