<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FEReportController extends Controller
{
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

    public function edit($id)
    {
        $category = Category::all();
        $report = Complaint::with(['type', 'category', 'user'])->where('id', $id)->firstOrFail();

        return view('pages.frontend.me.edit', compact('report', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        Complaint::find($id)->update($data);

        return redirect()->route('myReport', Auth::user()->id);
    }
}
