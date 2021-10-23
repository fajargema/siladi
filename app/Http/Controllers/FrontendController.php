<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
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
}
