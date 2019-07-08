<?php

namespace App\Http\Controllers\Admin;

use App\Dictionary;
use App\Product;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        # table headers
        $heads = [
            [
                'name' => 'id',
            ],
            [
                'name' => 'title',
                'visible' => 1
            ],
            [
                'name' => 'category_title',
                'get' => 'category.title',
                'visible' => 1
            ],
            [
                'name' => 'updated_at',
                'visible' => 1
            ]
        ];

        # Url query requested
        $query = [
            'search' => $request->search,
            'sort' => $request->sort,
            'desc' => $request->desc
        ];

        # Custom fields
        $search = $request->search;
        $sort = $request->sort ?: 'updated_at';
        $desc = $request->desc ? 1 : 0;

        # Load items for send to view
        $items = Product::get()
            ->load(['category']);

        # flatten and Search in model if search requested
        $items = flattenItems($items, $heads, $search);
        # Sort and desc/asc items
        $items = $items->sortBy($sort, SORT_NATURAL, $desc);
        # Paginate items
        $pages = paginate($items, $request->page, $this->perPage);

        return view('admin.crud.table')
            ->with(compact('heads', 'sort', 'desc', 'search', 'items', 'pages', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'create';
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
        # table headers
        $heads = [
            [
                'name' => 'id',
            ],
            [
                'name' => 'title',
            ],
            [
                'name' => 'category_title',
                'get' => 'category.title',
            ],
            [
                'name' => 'created_at',
            ],
            [
                'name' => 'updated_at',
            ]
        ];

        $item = Product::find($id)
            ->load('category');

        return view('admin.crud.show')
            ->with(compact('item', 'heads'));
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
