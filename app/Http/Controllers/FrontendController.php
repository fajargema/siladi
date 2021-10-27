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
        $reports = Complaint::with(['type', 'category', 'user'])->latest()->simplePaginate(10);

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.report', compact('reports', 'categories', 'fdate'));
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

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.me.index', compact('report', 'categories', 'fdate'));
    }
}
