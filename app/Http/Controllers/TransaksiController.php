<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Transaksi::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'   => 'required|date',
            'kategori'  => 'required|in:pemasukan,pengeluaran',
            'nominal'   => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        $transaksi = Transaksi::create($validated);

        return response()->json([
            'message' => 'Transaksi berhasil disimpan',
            'data'    => $transaksi
        ], 201);
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Transaksi::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::find($id);
    
        // Jika ID tidak ditemukan, kembalikan response 404
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
    
        // Validasi input sebelum update
        $validated = $request->validate([
            'tanggal'   => 'required|date',
            'kategori'  => 'required|in:pemasukan,pengeluaran',
            'nominal'   => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);
    
        // Update data transaksi
        $transaksi->update($validated);
    
        return response()->json([
            'message' => 'Transaksi berhasil diperbarui',
            'data' => $transaksi
        ], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Transaksi::destroy($id);
    }
}
