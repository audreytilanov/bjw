<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Seminar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SeminarController extends Controller
{
    public function __construct(){
        $this->middleware('auth:web');
    }
    
    public function index(){
        $data = Seminar::all();
        return view('admin.seminar.index', compact('data'));
    }

    public function downloadpop($id){
        $data = Seminar::find($id);
        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Mendownload PoP ". $data->name . " | Features",
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $path = public_path()."/seminar_asset/proof_of_payment/".$data->proof_of_payment;
        return Response::download($path);
    }

    
    public function accept($id){
        $data = Seminar::find($id);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menerima (Accept) ". $data->name . " | Seminar",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $data->update([
            'status' => 'accepted'
        ]);

        toast('Peserta diterima :)','success');
        return redirect()->back()->with('success', 'Account created successfully');

    }

    public function decline($id, Request $request){
        $data = Seminar::find($id);

       
        $request->validate([
            'alasan' => 'required'
        ]);

        $data->update([
            'status' => 'declined'
        ]);

        $data->update([
            'name' => $data->name."-declined"
        ]);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menolak (Decline) ". $data->name . " dengan alasan ".$request->alasan." | Seminar",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        toast('Peserta ditolak :(','success');
        return redirect()->back()->with('success', 'Account created successfully');
    }

    public function delete($id){
        $data = Seminar::find($id);

        $data->update([
            'status' => 'deleted'
        ]);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menghapus Data Image". $data->name . " | Features",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        Storage::disk('asset')->delete('seminar_asset/proof_of_payment/'.$data->proof_of_payment);
        Storage::disk('asset')->delete('seminar_asset/ktm/'.$data->ktm);

        toast('Image berhasil dihapus','success');
        return redirect()->route('admin.seminar.index');
    }
}
