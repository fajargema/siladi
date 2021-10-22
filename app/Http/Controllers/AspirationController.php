<?php

namespace App\Http\Controllers;

use App\Http\Requests\AspirationRequest;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, User $user)
    {
        if (request()->ajax()) {
            $query = Aspiration::with('category', 'user');
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a href="' . route('dashboard.aspiration.show', $item->id) . '"
                            class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                            <i class="bx bx-detail"></i> Detail
                        </a>
                        <a href="' . route('dashboard.aspiration.edit', $item->id) . '"
                            class="bg-gray-800 hover:bg-black text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                            <i class="bx bxs-pencil"></i> Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.aspiration.destroy', $item->id) . '" method="POST">
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                                    <i class="bx bx-trash"></i> Hapus
                            </button>
                        ' . method_field('delete') . csrf_field() . '
                        </form>
                    ';
                })
                ->addIndexColumn()
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
                ->rawColumns(['action', 'created_at', 'status'])
                ->make();
        }
        return view('pages.dashboard.aspiration.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('pages.dashboard.aspiration.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AspirationRequest $request)
    {
        $awal = 'ASP';
        $dua = 'SILADI';
        $akhir = Aspiration::max('id');

        if ($request->file('attachment') !== null) {
            $attachment = $request->file('attachment');
            $attachment->storeAs('public/aspiration', $attachment->hashName());

            Aspiration::create([
                'attachment'     => $attachment->hashName(),
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        } else {
            Aspiration::create([
                'attachment'     => $request->attachment,
                'kode' => sprintf("%03s", abs($akhir + 1)) . '/' . $awal . '/' . $dua . '/' . date('dmY'),
                'title'     => $request->title,
                'description'   => $request->description,
                'location'   => $request->location,
                'privacy'   => $request->privacy,
                'categories_id'   => $request->categories_id,
                'users_id'   => $request->users_id,
                'slug' => Str::slug($request->title)
            ]);
        }

        return redirect()->route('dashboard.aspiration.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aspiration $aspiration, User $user)
    {
        if (request()->ajax()) {
            $query = Aspiration::with(['category', 'user'])->where('categories_id', $aspiration->id);
            return DataTables::of($query)
                ->make();
        }
        return view('pages.dashboard.aspiration.detail', compact('aspiration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aspiration $aspiration)
    {
        $category = Category::all();

        return view('pages.dashboard.aspiration.edit', compact('aspiration', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aspiration $aspiration)
    {
        $data = $request->all();

        $aspiration->update($data);

        return redirect()->route('dashboard.aspiration.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aspiration $aspiration)
    {
        unlink("storage/aspiration/" . $aspiration->attachment);

        $aspiration->delete();

        return redirect()->route('dashboard.aspiration.index');
    }

    public function setProses($id)
    {
        Aspiration::where('id', $id)->update(array('status' => 2));

        return redirect()->route('dashboard.aspiration.index');
    }

    public function setSelesai($id)
    {
        Aspiration::where('id', $id)->update(array('status' => 3));

        return redirect()->route('dashboard.aspiration.index');
    }
}
