<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InformationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = InformationRequest::with('category', 'user');
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a href="' . route('dashboard.information.show', $item->id) . '"
                            class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                            <i class="bx bx-detail"></i> Detail
                        </a>
                        <a href="' . route('dashboard.information.edit', $item->id) . '"
                            class="bg-gray-800 hover:bg-black text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                            <i class="bx bxs-pencil"></i> Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.information.destroy', $item->id) . '" method="POST">
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
        return view('pages.dashboard.information.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
