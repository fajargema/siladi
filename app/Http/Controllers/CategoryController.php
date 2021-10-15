<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Category::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a href="' . route('dashboard.category.edit', $item->id) . '"
                            class="bg-gray-800 hover:bg-black text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                            <i class="bx bxs-pencil"></i> Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.category.destroy', $item->id) . '" method="POST">
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 m-1 rounded shadow-lg">
                                    <i class="bx bx-trash"></i> Hapus
                            </button>
                        ' . method_field('delete') . csrf_field() . '
                        </form>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        Category::create($data);

        return redirect()->route('dashboard.category.index');
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
    public function edit(Category $category)
    {
        return view('pages.dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->all();

        $category->update($data);

        return redirect()->route('dashboard.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard.category.index');
    }
}
