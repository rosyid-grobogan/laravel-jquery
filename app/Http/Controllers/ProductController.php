<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('category.parent')->get();
        $categories = Category::where('parent_id', '=',null)->get();

        if ($request->ajax()) {

            $data = Product::with('category.parent')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('cat', function($row){

                        return ($row->category->parent_id !== null) ? $row->category->parent->name : $row->category->name;

                    } )
                    ->editColumn('subcat', function($row){

                        return ($row->category->parent_id !== null) ? $row->category->name : 'N/A';

                    } )
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }
        return view('pages.product', compact('products', 'categories'));

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
        return Product::create([
            'title' => $request['title'],
            'brand' => $request['brand'],
            'category_id' => $request['category'],
            'description' => $request['description'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request;
        // $product = Product::findOrFail($id);

        // $product->update($request->all());
        // return ['message' => 'Updated is successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return ['message' => 'Product deleted'];
    }
}
