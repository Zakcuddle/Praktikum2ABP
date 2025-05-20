<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Menampilkan daftar pelanggan (Read)
    public function index()
    {
        // Mengambil semua data pelanggan dan mem-paginate 10 data per halaman
        $customers = Customer::paginate(10);

        // Return view dengan data pelanggan
        return view('customers.index', compact('customers'));
    }

    // Menampilkan form untuk membuat pelanggan baru (Create)
    public function create()
    {
        // Return view untuk menampilkan form pendaftaran pelanggan baru
        return view('customers.create');
    }

    // Menyimpan data pelanggan baru ke database (Store)
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        // Menyimpan data pelanggan baru ke database
        Customer::create($request->all());

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit pelanggan (Edit)
    public function edit($id)
    {
        // Cari pelanggan berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Return view untuk mengedit data pelanggan
        return view('customers.edit', compact('customer'));
    }

    // Memperbarui data pelanggan di database (Update)
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        // Cari pelanggan berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Update data pelanggan di database
        $customer->update($request->all());

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diupdate.');
    }

    // Menghapus pelanggan dari database (Delete)
    public function destroy($id)
    {
        // Cari pelanggan berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Hapus pelanggan dari database
        $customer->delete();

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}

