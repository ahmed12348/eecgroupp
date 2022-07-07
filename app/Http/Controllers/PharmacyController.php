<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pharmacy::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href=" ' . route('pharmacies.edit', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pharmacy.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pharmacy.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:190',
            'address' => 'required',

        ]);
        Pharmacy::create($validatedData);
        return redirect()->route('pharmacies.index')
            ->with('success','Pharmacy Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pharmacy = Pharmacy::find($id);
        return view('pharmacy.edit', compact('pharmacy'));

    }


    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:190',
            'address' => 'required',

        ]);
        Pharmacy::whereId($id)->update($validatedData);
        return redirect()->route('pharmacies.index')
            ->with('success','Pharmacy Created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pharmacy::find($id)->delete();

        return response()->json(['success' => 'Pharmacy deleted successfully.']);
    }
}
