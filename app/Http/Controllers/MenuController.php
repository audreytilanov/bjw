<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Video;
use App\Models\Feature;
use App\Models\NewsPaper;
use App\Models\NewsAnchor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VideoTimDetail;
use App\Models\NewsPaperTimDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    public function email(){
        return view('email-template');
    }

    public function index(){
        return view('user.index');
    }

    public function about(){
        return view('user.aboutus');
    }

    public function features(){
        return view('user.competition.features');
    }

    public function miniNewsPaper(){
        return view('user.competition.newspaper');
    }

    public function video(){
        return view('user.competition.videos');
    }

    public function guidebook(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/guidebook/bukupedoman_bjw2022.pdf";
        return Response::download($path);
    }

    public function pamflet(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/pamflet.png";
        return Response::download($path);
    }

    public function featuresSubmit(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:features,email',
            'phone'=> 'required',
            'institution'=> 'required',
            'proof_of_payment'=> 'required|file|max:3000',
            'line'=> 'required',
            'ktm'=> 'required|file|max:3000'
        ]);

        $request->only(
            'name',
            'email',
            'phone',
            'institution',
            'proof_of_payment',
            'line',
            'ktm');



        $filename = $request->name."_".$request->proof_of_payment->getClientOriginalName();
        $file = $request->file('proof_of_payment');
        Storage::disk('asset')->put('features_asset/proof_of_payment/'.$filename, file_get_contents($file));

        $filename2 = $request->name."_".$request->ktm->getClientOriginalName();
        $file2 = $request->file('ktm');
        Storage::disk('asset')->put('features_asset/ktm/'.$filename2, file_get_contents($file2));

        $send = Feature::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'proof_of_payment' => $filename,
            'line' => $request->line,
            'ktm' => $filename2
        ]);

        if($send){
            toast('Data Submitted! Thank You For Participating.','success');
            return redirect()->route('user.feature');
        }else{
            toast('Something Went Wrong, Please Try Again.','error');
            return redirect()->route('user.feature');
        }
    }

    public function newsanchors(){
        return view('user.competition.newsanchor');
    }

    public function newsAnchorSubmit(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:news_anchors,email',
            'phone'=> 'required',
            'institution'=> 'required',
            'proof_of_payment'=> 'required|file|max:3000',
            'line'=> 'required',
            'ktm'=> 'required|file|max:3000'
        ]);

        $request->only(
            'name',
            'email',
            'phone',
            'institution',
            'proof_of_payment',
            'line',
            'ktm');



        $filename = $request->name."_".$request->proof_of_payment->getClientOriginalName();
        $file = $request->file('proof_of_payment');
        Storage::disk('asset')->put('newsanchor_asset/proof_of_payment/'.$filename, file_get_contents($file));

        $filename2 = $request->name."_".$request->ktm->getClientOriginalName();
        $file2 = $request->file('ktm');
        Storage::disk('asset')->put('newsanchor_asset/ktm/'.$filename2, file_get_contents($file2));

        $send = NewsAnchor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'proof_of_payment' => $filename,
            'line' => $request->line,
            'ktm' => $filename2
        ]);

        if($send){
            toast('Data Submitted! Thank You For Participating.','success');
            return redirect()->route('user.newsanchor');
        }else{
            toast('Something Went Wrong, Please Try Again.','error');
            return redirect()->route('user.newsanchor');
        }
    }

    public function videoSubmit(Request $request){
        $request->validate([
            'group' => 'required',
            'name1' => 'required',
            'email'=> 'required|email|unique:videos,email',
            'phone'=> 'required',
            'institution'=> 'required',
            'proof_of_payment'=> 'required|file|max:3000',
            'line'=> 'required',
            'ktm'=> 'required|file|max:3000'
        ]);

        $filename = $request->group."_".$request->proof_of_payment->getClientOriginalName();
        $file = $request->file('proof_of_payment');
        Storage::disk('asset')->put('videos_asset/proof_of_payment/'.$filename, file_get_contents($file));

        $filename2 = $request->group."_".$request->ktm->getClientOriginalName();
        $file2 = $request->file('ktm');
        Storage::disk('asset')->put('videos_asset/ktm/'.$filename2, file_get_contents($file2));

        $send = Video::create([
            'group_name' => $request->group,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'proof_of_payment' => $filename,
            'line' => $request->line,
            'ktm' => $filename2
        ]);

        if(!empty($request->name1)){
            VideoTimDetail::create([
                'video_id' => $send->id,
                'name' => $request->name1
            ]);
        }

        if(!empty($request->name2)){
            VideoTimDetail::create([
                'video_id' => $send->id,
                'name' => $request->name2
            ]);
        }

        if(!empty($request->name3)){
            VideoTimDetail::create([
                'video_id' => $send->id,
                'name' => $request->name3
            ]);
        }

        if($send){
            toast('Data Submitted! Thank You For Participating.','success');
            return redirect()->route('user.video');
        }else{
            toast('Something Went Wrong, Please Try Again.','error');
            return redirect()->route('user.video');
        }
    }

    public function miniNewsPaperSubmit(Request $request){
        $request->validate([
            'group' => 'required',
            'name1' => 'required',
            'name2' => 'required',
            'name3' => 'required',
            'name4' => 'required',
            'email'=> 'required|email|unique:news_papers,email',
            'phone'=> 'required',
            'institution'=> 'required',
            'proof_of_payment'=> 'required|file|max:3000',
            'line'=> 'required',
            'ktm'=> 'required|file|max:3000'
        ]);

        $filename = $request->group."_".$request->proof_of_payment->getClientOriginalName();
        $file = $request->file('proof_of_payment');
        Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents($file));

        $filename2 = $request->group."_".$request->ktm->getClientOriginalName();
        $file2 = $request->file('ktm');
        Storage::disk('asset')->put('mininews_asset/ktm/'.$filename2, file_get_contents($file2));

        $send = NewsPaper::create([
            'group_name' => $request->group,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'proof_of_payment' => $filename,
            'line' => $request->line,
            'ktm' => $filename2
        ]);

        if(!empty($request->name1)){
            NewsPaperTimDetail::create([
                'news_paper_id' => $send->id,
                'name' => $request->name1
            ]);
        }

        if(!empty($request->name2)){
            NewsPaperTimDetail::create([
                'news_paper_id' => $send->id,
                'name' => $request->name2
            ]);
        }

        if(!empty($request->name3)){
            NewsPaperTimDetail::create([
                'news_paper_id' => $send->id,
                'name' => $request->name3
            ]);
        }

        if(!empty($request->name4)){
            NewsPaperTimDetail::create([
                'news_paper_id' => $send->id,
                'name' => $request->name4
            ]);
        }

        if($send){
            toast('Data Submitted! Thank You For Participating.','success');
            return redirect()->route('user.mininews');
        }else{
            toast('Something Went Wrong, Please Try Again.','error');
            return redirect()->route('user.mininews');
        }
    }
}
