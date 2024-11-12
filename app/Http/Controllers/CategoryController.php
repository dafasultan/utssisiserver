<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{

    public function index()
    {
        $category = Categories::all();
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'created_by' => 'require|numeric'
        ]);

        $categories = Categories::create($request->all());

        return response()->json($categories, 201);
    }

    public function ringkasanPerKategori()
    {
        $categories = Categories::with('items')->get();
        $ringkasan = $categories->map(function ($category) {
            $totalBarang = $category->items->count();
            $totalNilaiStok = $category->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $rataRataHarga = $category->items->avg('price');
            return [
                'kategori' => $category->name,
                'total_barang' => $totalBarang,
                'total_nilai_stok' => $totalNilaiStok,
                'rata_rata_harga' => $rataRataHarga,
            ];
        });


        if (!$ringkasan->isEmpty()) {
            return response()->json([
                'message' => 'Berhasil Menampilkan Data',
                'data' => $ringkasan
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gagal Mendapatkan Data'
            ], 404);
        }
    }
}
