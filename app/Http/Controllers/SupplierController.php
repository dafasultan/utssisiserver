<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'contact_info' => 'nullable|string|max:255',
            'created_by' => 'required|numeric'
        ]);

        $supplier = Supplier::create($request->all());

        return response()->json($supplier, 201);
    }

    public function ringkasanBarangPerPemasok()
    {
        $ringkasan = Supplier::with('items')
            ->get()
            ->map(function ($supplier) {
                return [
                    'supplier_name' => $supplier->name,
                    'total_barang' => $supplier->items->count(),
                    'total_nilai_barang' => $supplier->items->sum(function ($item) {
                        return $item->price * $item->quantity;
                    }),
                ];
            });

        return response()->json([
            'message' => 'Berhasil Menampilkan Ringkasan Barang per Pemasok',
            'data' => $ringkasan
        ], 200);
    }

}
