<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, User $user)
    {
        if (request()->ajax()) {
            $query = Complaint::with('category', 'user');
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a href="' . route('dashboard.complaint.show', $item->id) . '"
                            class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                            <i class="bx bx-detail"></i> Detail
                        </a>
                        <a href="' . route('dashboard.complaint.edit', $item->id) . '"
                            class="bg-gray-800 hover:bg-black text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                            <i class="bx bxs-pencil"></i> Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.complaint.destroy', $item->id) . '" method="POST">
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                                    <i class="bx bx-trash"></i> Hapus
                            </button>
                        ' . method_field('delete') . csrf_field() . '
                        </form>
                    ';
                })
                ->addIndexColumn()
                ->editColumn('date', function ($item) {
                    $date = Carbon::parse($item->date)->locale('id');
                    $date->settings(['formatFunction' => 'translatedFormat']);
                    return $date->format('l, j F Y');
                })
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->diffForHumans();
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 1)
                        return '<span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                            Belum
                        </span>';
                    elseif ($item->status == 2)
                        return '<span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">
                            Proses
                        </span>';
                    elseif ($item->status == 3)
                        return '<span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                            Selesai
                        </span>';
                })
                ->rawColumns(['action', 'date', 'created_at', 'status'])
                ->make();
        }
        return view('pages.dashboard.complaint.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.dashboard.complaint.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        }

        return redirect()->route('dashboard.complaint.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint, User $user)
    {
        if (request()->ajax()) {
            $query = Complaint::with(['category', 'user'])->where('categories_id', $complaint->id);
            return DataTables::of($query)
                ->make();
        }

        $date = Carbon::parse($complaint->date)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $fdate = $date->format('l, j F Y');

        return view('pages.dashboard.complaint.detail', compact('complaint', 'fdate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        $category = Category::all();

        return view('pages.dashboard.complaint.edit', compact('complaint', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        $data = $request->all();

        $complaint->update($data);

        return redirect()->route('dashboard.complaint.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        unlink("storage/complaint/" . $complaint->attachment);

        $complaint->delete();

        return redirect()->route('dashboard.complaint.index');
    }
}
