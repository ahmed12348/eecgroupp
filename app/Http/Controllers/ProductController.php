<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href=" ' . route('products.edit', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('product.index');


    }


    public function create()
    {
        return view('product.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        Product::create($validatedData);
        return redirect()->route('products.index')
            ->with('success','Product Created successfully');

    }


    public function show($id)
    {
        //
    }


    public function edit( $id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));

    }


    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        Product::whereId($id)->update($validatedData);
        return redirect()->route('products.index')
            ->with('success','Product Created successfully');
    }


    public function destroy($id)
    {
        Product::find($id)->delete();

        return response()->json(['success' => 'Product deleted successfully.']);


    }
}
