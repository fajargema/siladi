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

    public function kirim(Request $request)
    {
        $subject = $request->input('subject');
        $name = $request->input('name');
        $emailAddress = $request->input('email');
        $message = $request->input('message');

        $mail = new PHPMailer(true);
        try {
            // Pengaturan Server
            // $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'fgemar72@gmail.com';
            $mail->Password = '';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom("fgemar72@gmail.com", "Fajar Gema Ramadhan");

            $mail->addAddress('gemaramaje@gmail.com', 'SILADI');

            $mail->addReplyTo($emailAddress, $name);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();

            return view('pages.frontend.contact');
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
