<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('pages.frontend.index', compact('category'));
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

        $date = Carbon::parse($complaint->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.frontend.details', compact('reports', 'report', 'categories', 'fdate'));
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
}
