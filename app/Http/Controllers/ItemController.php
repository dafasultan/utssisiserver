<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'created_by' => 'required|numeric',
        ]);

        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        $item->update($request->all());

        return response()->json($item);
    }

    public function ringkasanStok()
    { {
            $totalStok = Item::sum('quantity');
            $totalNilaiStok = Item::all()->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $rataRataHarga = Item::avg('price');

            return response()->json([
                'total_stok' => $totalStok,
                'total_nilai_stok' => $totalNilaiStok,
                'rata_rata_harga' => $rataRataHarga
            ]);
        }
    }
    public function stokDiBawahAmbang()
    {
        $ambangBatas = 5;
        $barang = Item::where('quantity', '<', $ambangBatas)->get();

        return response()->json($barang);
    }


    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(['message' => 'Item berhasil dihapus!']);
    }

    public function barangPerKategori(Request $request)
    {
        $kategori_id = $request->input('category_id');
        $items = Item::where('category_id', $kategori_id)->get();

        if (!$items->isEmpty()) {
            return response()->json([
                'message' => 'Berhasil Mendapatkan Data',
                'data' => $items
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gagal Mendapatkan Data'
            ], 404);
        }
    }

    public function ringkasanKeseluruhan()
    {
        $totalBarang = Item::count(); // Menghitung total jumlah barang
        $totalNilaiStok = Item::all()->sum(function ($item) { // Menghitung total nilai stok
            return $item->price * $item->quantity;
        });
        $jumlahKategori = Categories::count(); // Menghitung jumlah kategori
        $jumlahPemasok = Supplier::count(); // Menghitung jumlah pemasok

        return response()->json([
            'message' => 'Berhasil Menampilkan Ringkasan Keseluruhan',
            'data' => [
                'total_barang' => $totalBarang,
                'total_nilai_stok' => $totalNilaiStok,
                'jumlah_kategori' => $jumlahKategori,
                'jumlah_pemasok' => $jumlahPemasok,
            ]
        ], 200);
    }








}
