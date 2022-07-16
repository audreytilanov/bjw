<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Video;
use App\Models\Feature;
use App\Models\Seminar;
use App\Models\NewsPaper;
use App\Models\NewsAnchor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VideoTimDetail;
use App\Models\FeaturePengumpulan;
use App\Models\NewsAnchorPengumpulan;
use App\Models\NewsPaperPengumpulan;
use App\Models\NewsPaperTimDetail;
use App\Models\Pjtln;
use App\Models\VideoPengumpulan;
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

    public function seminar(){
        return view('user.event.seminar');
    }

    public function pjtln(){
        return view('user.event.pjtln');
    }

    public function guidebook(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/guidebook/bukupedoman_bjw2022.pdf";
        return Response::download($path);
    }

    public function guidebookPjtln(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/guidebook/guidebook_pjtln.pdf";
        return Response::download($path);
    }

    public function pamflet(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/pamflet.png";
        return Response::download($path);
    }

    public function pamfletFeatures(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/features.png";
        return Response::download($path);
    }

    public function pamfletVideos(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/videos.png";
        return Response::download($path);
    }

    public function pamfletNewspaper(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/newspaper.png";
        return Response::download($path);
    }

    public function pamfletNewsanchor(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/newsanchor.png";
        return Response::download($path);
    }

    public function pamfletSeminar(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/seminar.png";
        return Response::download($path);
    }

    public function pamfletPjtln(){
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/pamflet/pjtln.png";
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

    public function featuresPengumpulan(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'pengumpulan'=> 'required|file',
            'originalitas'=> 'required|file',
        ]);

        

        $data = Feature::where('email','=',$request->email)->first();

        if($data == null){
            toast('This Email is not Registered','error');
            return redirect()->route('user.feature');
        }else{
            $filename = $request->email."_".$request->pengumpulan->getClientOriginalName();
            $file = $request->file('pengumpulan');
            Storage::disk('asset')->put('features_asset/pengumpulan/'.$filename, file_get_contents($file));

            $filename2 = $request->email."_".$request->originalitas->getClientOriginalName();
            $file2 = $request->file('originalitas');
            Storage::disk('asset')->put('features_asset/originalitas/'.$filename2, file_get_contents($file2));
            
            $find = FeaturePengumpulan::where('feature_id','=', $data->id)->first();
            if($find == null){
                toast('This Email is Registered but not confirmed','error');
                return redirect()->route('user.feature');
            }
            $find->update([
                'file' => $filename,
                'originalitas' => $filename2,
                'status' => "1",
            ]);
            toast('Data Submitted! Thank You For Participating.','success');
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

    public function newsAnchorPengumpulan(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'link'=> 'required',
            // 'originalitas'=> 'required|file',
        ]);

        // $filename2 = $request->name."_".$request->originalitas->getClientOriginalName();
        // $file2 = $request->file('originalitas');
        // Storage::disk('asset')->put('features_asset/originalitas/'.$filename2, file_get_contents($file2));

        $data = NewsAnchor::where('email','=',$request->email)->first();

        if($data == null){
            toast('This Email is not Registered','error');
            return redirect()->route('user.newsanchor');
        }else{
            $find = NewsAnchorPengumpulan::where('news_anchor_id','=', $data->id)->first();
            if($find == null){
                toast('This Email is Registered but not confirmed','error');
                return redirect()->route('user.newsanchor');
            }
            $find->update([
                'file' => $request->link,
                'status' => "1",
            ]);
            toast('Data Submitted! Thank You For Participating.','success');
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

    public function videosPengumpulan(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'link'=> 'required',
            // 'originalitas'=> 'required|file',
        ]);

        // $filename2 = $request->name."_".$request->originalitas->getClientOriginalName();
        // $file2 = $request->file('originalitas');
        // Storage::disk('asset')->put('features_asset/originalitas/'.$filename2, file_get_contents($file2));

        $data = Video::where('email','=',$request->email)->first();

        if($data == null){
            toast('This Email is not Registered','error');
            return redirect()->route('user.video');
        }else{
            $find = VideoPengumpulan::where('video_id','=', $data->id)->first();
            if($find == null){
                toast('This Email is Registered but not confirmed','error');
                return redirect()->route('user.video');
            }
            $find->update([
                'file' => $request->link,
                'status' => "1",
            ]);
            toast('Data Submitted! Thank You For Participating.','success');
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

    public function seminarSubmit(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:seminars,email',
            'phone'=> 'required',
            'institution'=> 'required',
            'proof_of_payment'=> 'required|file|max:3000',
            'line'=> 'required',
        ]);

        $request->only(
            'name',
            'email',
            'phone',
            'institution',
            'proof_of_payment',
            'line'
        );

        $filename = $request->name."_".$request->proof_of_payment->getClientOriginalName();
        $file = $request->file('proof_of_payment');
        Storage::disk('asset')->put('seminar_asset/proof_of_payment/'.$filename, file_get_contents($file));

        $send = Seminar::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'proof_of_payment' => $filename,
            'line' => $request->line,
        ]);

        if($send){
            toast('Data Submitted! Thank You For Participating.','success');
            return redirect()->route('user.seminar');
        }else{
            toast('Something Went Wrong, Please Try Again.','error');
            return redirect()->route('user.seminar');
        }
    }

    public function pjtlnSubmit(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:pjtlns,email',
            'phone'=> 'required',
            'institution'=> 'required',
            'proof_of_payment'=> 'required|file|max:3000',
            'line'=> 'required',
        ]);

        $request->only(
            'name',
            'email',
            'phone',
            'institution',
            'proof_of_payment',
            'line'
        );

        $filename = $request->name."_".$request->proof_of_payment->getClientOriginalName();
        $file = $request->file('proof_of_payment');
        Storage::disk('asset')->put('pjtln_asset/proof_of_payment/'.$filename, file_get_contents($file));

        $send = Pjtln::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'institution' => $request->institution,
            'proof_of_payment' => $filename,
            'line' => $request->line,
        ]);

        if($send){
            toast('Data Submitted! Thank You For Participating.','success');
            return redirect()->route('user.pjtln');
        }else{
            toast('Something Went Wrong, Please Try Again.','error');
            return redirect()->route('user.pjtln');
        }
    }
}
