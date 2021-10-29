<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Complaint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FrontendController extends Controller
{
    public function index()
    {
        $total_report = Complaint::all()->count();
        $total_comment = Comment::all()->count();
        $total_cat = Category::all()->count();
        $total_user = User::all()->count();
        $category = Category::all();
        return view('pages.frontend.index', compact('category', 'total_report', 'total_comment', 'total_cat', 'total_user'));
    }

    public function report(Complaint $complaint)
    {
        $categories = Category::get();
        $reports = Complaint::with(['type', 'category', 'user'])->where('privacy', '!=', 3)->latest()->simplePaginate(10);
        $total = Comment::where('reports_id', $complaint->id)->count();

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.report', compact('reports', 'categories', 'fdate', 'total'));
    }

    public function details(Complaint $complaint, $slug)
    {
        $categories = Category::get();
        $reports = Complaint::get();
        $report = Complaint::with(['type', 'category', 'user'])->where('slug', $slug)->firstOrFail();
        $comment = Comment::with(['complaint', 'user'])->where('reports_id', $report->id)->get();
        $total = Comment::where('reports_id', $report->id)->count();

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.details', compact('reports', 'report', 'categories', 'fdate', 'comment', 'total'));
    }

    public function category(Complaint $complaint, $id)
    {
        $categories = Category::get();
        $reports = Complaint::with(['type', 'category', 'user'])->where('privacy', '!=', 3)->latest()->simplePaginate(10);
        $report = Complaint::with(['type', 'category', 'user'])->where('categories_id', $id)->where('privacy', '!=', 3)->latest()->simplePaginate(10);

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.category', compact('reports', 'categories', 'fdate', 'report'));
    }

    public function about()
    {
        return view('pages.frontend.about');
    }

    public function contact()
    {
        return view('pages.frontend.contact');
    }

    public function simpanPen(Request $request)
    {
        $awal = 'PEN';
        $dua = 'SILADI';
        $akhir = Complaint::max('id');

        if ($request->file('attachment') !== null) {
            $attachment = $request->file('attachment');
            $attachment->storeAs('public/complaint', $attachment->hashName());

            Complaint::create([
                'attachment'     => $attachment->hashName(),
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'date'   => $request->date,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'types_id'   => $request->types_id,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        } else {
            Complaint::create([
                'attachment'     => $request->attachment,
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'date'   => $request->date,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'types_id'   => $request->types_id,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        }
        return redirect()->route('index');
    }

    public function simpanAsp(Request $request)
    {
        $awal = 'ASP';
        $dua = 'SILADI';
        $akhir = Complaint::max('id');

        if ($request->file('attachment') !== null) {
            $attachment = $request->file('attachment');
            $attachment->storeAs('public/aspiration', $attachment->hashName());

            Complaint::create([
                'attachment'     => $attachment->hashName(),
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'types_id'   => $request->types_id,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        } else {
            Complaint::create([
                'attachment'     => $request->attachment,
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'types_id'   => $request->types_id,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        }

        return redirect()->route('index');
    }

    public function simpanInf(Request $request)
    {
        $awal = 'INF';
        $dua = 'SILADI';
        $akhir = Complaint::max('id');

        if ($request->file('attachment') !== null) {
            $attachment = $request->file('attachment');
            $attachment->storeAs('public/information', $attachment->hashName());

            Complaint::create([
                'attachment'     => $attachment->hashName(),
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'types_id'   => $request->types_id,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        } else {
            Complaint::create([
                'attachment'     => $request->attachment,
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'types_id'   => $request->types_id,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        }

        return redirect()->route('index');
    }

    public function comment(Request $request)
    {
        $data = $request->all();

        Comment::create($data);

        return redirect()->back();
    }

    public function myReport(Complaint $complaint, $users_id)
    {
        $categories = Category::get();
        $report = Complaint::with(['type', 'category', 'user'])->where('users_id', $users_id)->simplePaginate(10);
        $wait = Complaint::with(['type', 'category', 'user'])->where('users_id', $users_id)->where('status', 1)->simplePaginate(10);
        $process = Complaint::with(['type', 'category', 'user'])->where('users_id', $users_id)->where('status', 2)->simplePaginate(10);
        $done = Complaint::with(['type', 'category', 'user'])->where('users_id', $users_id)->where('status', 3)->simplePaginate(10);

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.me.index', compact('report', 'categories', 'wait', 'process', 'done', 'fdate'));
    }

    public function search(Request $request, Complaint $complaint)
    {
        $keyword = $request->search;
        $complaints = Complaint::with(['type', 'category', 'user'])->where('kode', 'like', "%" . $keyword . "%")->where('title', 'like', "%" . $keyword . "%")->where('privacy', '!=', 3)->paginate(10);
        $categories = Category::get();

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.search', compact('complaints', 'categories', 'fdate'));
    }

    public function kirim(Request $request)
    {
        $subject = $request->input('subject');
        $name = $request->input('name');
        $emailAddress = $request->input('email');
        $message = $request->input('message');

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            // Pengaturan Server
            // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'fgemar72@gmail.com';                 // SMTP username
            $mail->Password = 'hdwipxpoblpfhldu';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            // Siapa yang mengirim email
            $mail->setFrom("fgemar72@gmail.com", "Fajar Gema Ramadhan");

            // Siapa yang akan menerima email
            $mail->addAddress('gemaramaje@gmail.com', 'SILADI');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional

            // ke siapa akan kita balas emailnya
            $mail->addReplyTo($emailAddress, $name);

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();

            $request->session()->flash('status', 'Terima kasih, kami sudah menerima email anda.');
            return view('pages.frontend.contact');
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
