<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Pjtln;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PjtlnController extends Controller
{
    public function __construct(){
        $this->middleware('auth:web');
    }
    
    public function index(){
        $data = Pjtln::all();
        return view('admin.pjtln.index', compact('data'));
    }

    public function downloadpop($id){
        $data = Pjtln::find($id);
        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Mendownload PoP ". $data->name . " | PJTLN",
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $path = public_path()."/pjtln_asset/proof_of_payment/".$data->proof_of_payment;
        return Response::download($path);
    }

    
    public function accept($id){
        $data = Pjtln::find($id);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menerima (Accept) ". $data->name . " | PJTLN",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $data->update([
            'status' => 'accepted'
        ]);

        toast('Peserta diterima :)','success');
        return redirect()->back()->with('success', 'Account created successfully');

    }

    public function decline($id, Request $request){
        $data = Pjtln::find($id);

       
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
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menolak (Decline) ". $data->name . " dengan alasan ".$request->alasan." | PJTLN",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        toast('Peserta ditolak :(','success');
        return redirect()->back()->with('success', 'Account created successfully');
    }

    public function delete($id){
        $data = Pjtln::find($id);

        $data->update([
            'status' => 'deleted'
        ]);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menghapus Data Image ". $data->name . " | PJTLN",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        Storage::disk('asset')->delete('pjtln_asset/proof_of_payment/'.$data->proof_of_payment);

        toast('Image berhasil dihapus','success');
        return redirect()->route('admin.pjtln.index');
    }
}
