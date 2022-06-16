<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use App\Models\NewsAnchor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\NewsAnchorPengumpulan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class NewsAnchorController extends Controller
{
    public function __construct(){
        $this->middleware('auth:web');
    }
    
    public function index(){
        $data = NewsAnchor::all();
        return view('admin.newsanchor.index', compact('data'));
    }

    public function downloadpop($id){
        $data = NewsAnchor::find($id);
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Mendownload PoP ". $data->name . " | NewsAnchor",
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $path = public_path()."/newsanchor_asset/proof_of_payment/".$data->proof_of_payment;
        return Response::download($path);
    }

    public function downloadktm($id){
        $data = NewsAnchor::find($id);
        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Mendownload KTM ". $data->name . " | NewsAnchor",
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/newsanchor_asset/ktm/".$data->ktm;
        return Response::download($path);
    }

    public function accept($id){
        $data = NewsAnchor::find($id);

        $token = hash('sha256', Str::random(120));

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menerima (Accept) ". $data->name . " | NewsAnchor",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $data->update([
            'status' => 'accepted'
        ]);

        NewsAnchorPengumpulan::create([
            'news_anchor_id' => $data->id,
            'code' => $token,
        ]);

        $message = 'Hai <b>'. $data->name.'!</b>';
        $message = 'Terimakasih telah ikut berpartisipasi dalam perlombaan news anchor Bali Journalist Week 2022. Anda telah terdaftar, dan berikut merupakan kode pengumpulan anda. Dimohon untuk tidak menyebarkan kode unik ini. Pengumpulan dilakukan pada tanggal yang telah ditentukan.';

        $mail_data = [
            'recipient' => $data->email,
            'fromEmail' => $data->email,
            'fromName' => $data->name,
            'subject' => 'Kode Pengumpulan BJW 2022',
            'body' => $message, 
            'actionLink' => $token,
        ];

        Mail::send('email-template', $mail_data, function($message) use($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'])
                    ->subject($mail_data['subject']);
        });

        toast('Peserta diterima :)','success');
        return redirect()->back()->with('success', 'Account created successfully');

    }

    public function decline($id, Request $request){
        $data = NewsAnchor::find($id);

       
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
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menolak (Decline) ". $data->name . " dengan alasan ".$request->alasan." | NewsAnchor",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $message = 'Hai <b>'. $data->name.'!</b>';
        $message = 'Bukti pembayaran anda telah diterima namun masih belum memenuhi syarat, mohon untuk mendaftar ulang sesuai dengan arahan. Mohon maaf atas ketidaknyamanannya. Syarat yang belum terpenuhi :';

        $mail_data = [
            'recipient' => $data->email,
            'fromEmail' => $data->email,
            'fromName' => $data->name,
            'subject' => 'Payment Declined |  BJW 2022',
            'body' => $message, 
            'actionLink' => $request->alasan,
        ];

        Mail::send('email-template', $mail_data, function($message) use($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'])
                    ->subject($mail_data['subject']);
        });

        toast('Peserta ditolak :(','success');
        return redirect()->back()->with('success', 'Account created successfully');
    }

    public function delete($id){
        $data = NewsAnchor::find($id);

        $data->update([
            'status' => 'deleted'
        ]);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menghapus Data Image". $data->name . " | NewsAnchor",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        Storage::disk('asset')->delete('newsanchor_asset/proof_of_payment/'.$data->proof_of_payment);
        Storage::disk('asset')->delete('newsanchor_asset/ktm/'.$data->ktm);

        toast('Image berhasil dihapus','success');
        return redirect()->route('admin.newsanchor.index');
    }
}
