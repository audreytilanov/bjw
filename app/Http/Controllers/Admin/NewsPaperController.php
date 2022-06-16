<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use App\Models\NewsPaper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsPaperPengumpulan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class NewsPaperController extends Controller
{
    public function __construct(){
        $this->middleware('auth:web');
    }
    
    public function index(){
        $data = NewsPaper::all();
        return view('admin.newspaper.index', compact('data'));
    }

    public function downloadpop($id){
        $data = NewsPaper::find($id);
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Mendownload PoP ". $data->group_name . " | MiniNewsPaper",
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $path = public_path()."/mininews_asset/proof_of_payment/".$data->proof_of_payment;
        return Response::download($path);
    }

    public function downloadktm($id){
        $data = NewsPaper::find($id);
        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Mendownload KTM ". $data->group_name . " | MiniNewsPaper",
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        // $filepath = Storage::disk('asset')->put('mininews_asset/proof_of_payment/'.$filename, file_get_contents('features_asset/proof_of_payment/'.$data->proof_of_payment));
        $path = public_path()."/mininews_asset/ktm/".$data->ktm;
        return Response::download($path);
    }

    public function accept($id){
        $data = NewsPaper::find($id);

        $token = hash('sha256', Str::random(120));

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menerima (Accept) ". $data->group_name . " | NewsPaper",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $data->update([
            'status' => 'accepted'
        ]);

        NewsPaperPengumpulan::create([
            'news_paper_id' => $data->id,
            'code' => $token,
        ]);

        $message = 'Hai <b>'. $data->group_name.'!</b>';
        $message = 'Terimakasih telah ikut berpartisipasi dalam perlombaan news paper Bali Journalist Week 2022. Anda telah terdaftar, dan berikut merupakan kode pengumpulan anda. Dimohon untuk tidak menyebarkan kode unik ini. Pengumpulan dilakukan pada tanggal yang telah ditentukan.';

        $mail_data = [
            'recipient' => $data->email,
            'fromEmail' => $data->email,
            'fromName' => $data->group_name,
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
        $data = NewsPaper::find($id);

       
        $request->validate([
            'alasan' => 'required'
        ]);

        $data->update([
            'status' => 'declined'
        ]);

        $data->update([
            'group_name' => $data->group_name."-declined"
        ]);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menolak (Decline) ". $data->group_name . " dengan alasan ".$request->alasan." | NewsPaper",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        $message = 'Hai <b>'. $data->group_name.'!</b>';
        $message = 'Bukti pembayaran anda telah diterima namun masih belum memenuhi syarat, mohon untuk mendaftar ulang sesuai dengan arahan. Mohon maaf atas ketidaknyamanannya. Syarat yang belum terpenuhi :';

        $mail_data = [
            'recipient' => $data->email,
            'fromEmail' => $data->email,
            'fromName' => $data->group_name,
            'subject' => 'Payment Declined | BJW 2022',
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
        $data = NewsPaper::find($id);

        $data->update([
            'status' => 'deleted'
        ]);

        Log::create([
            'aktivitas' => Auth::guard('web')->user()->name." Telah Menghapus Data Image ". $data->group_name . " | NewsAnchor",
            'user_id' => Auth::guard('web')->user()->id,
        ]);

        Storage::disk('asset')->delete('mininews_asset/proof_of_payment/'.$data->proof_of_payment);
        Storage::disk('asset')->delete('mininews_asset/ktm/'.$data->ktm);

        toast('Image berhasil dihapus','success');
        return redirect()->route('admin.newspaper.index');
    }
}
