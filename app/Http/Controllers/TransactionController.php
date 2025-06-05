<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi (Read)
    public function index()
    {
        // Mengambil semua data transaksi beserta relasi ke customer dan produk
        $transactions = Transaction::with(['customer', 'product'])->paginate(10);

        // Return view dengan data transaksi
        return view('transactions.index', compact('transactions'));
    }

    // Menampilkan form untuk membuat transaksi baru (Create)
    public function create()
    {
        // Mengambil semua customer dan product untuk form select
        $customers = Customer::all();
        $products = Product::all();

        // Return view untuk menampilkan form
        return view('transactions.create', compact('customers', 'products'));
    }

    // Menyimpan data transaksi baru ke database (Store)
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        // Simpan data transaksi di database
        Transaction::create([
        'customer_id' => $request->customer_id,
        'product_id' => $request->product_id,
        'total_price' => $totalPrice,
        'transaction_date' => $request->transaction_date,
        ]);
        
        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit transaksi yang ada (Edit)
    public function edit($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Ambil semua customer dan product untuk form select
        $customers = Customer::all();
        $products = Product::all();

        // Return view untuk mengedit transaksi
        return view('transactions.edit', compact('transaction', 'customers', 'products'));
    }

    // Memperbarui data transaksi di database (Update)
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Update data transaksi di database
        $transaction->update([
        'customer_id' => $request->customer_id,
        'product_id' => $request->product_id,
        'total_price' => $totalPrice,
        'transaction_date' => $request->transaction_date,
        ]);

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // Menghapus transaksi dari database (Delete)
    public function destroy($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Hapus transaksi dari database
        $transaction->delete();

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}