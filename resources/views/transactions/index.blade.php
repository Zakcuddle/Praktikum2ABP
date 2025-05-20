<x-app-layout>
    <div class="container">
        <h1 class="text-2xl font-semibold mb-4">Daftar Transaksi</h1>
        
        <a href="{{ route('transactions.create') }}" class="btn btn-success mb-3">
            Tambah Transaksi Baru
        </a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->customer->name }}</td>
                    <td>{{ $transaction->product->name }}</td>
                    <td>Rp{{ number_format($transaction->total_price, 2, ',', '.') }}</td>
                    <td>
                        @if($transaction->transaction_date instanceof \Carbon\Carbon)
                            {{ $transaction->transaction_date->format('Y-m-d') }}
                        @else
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
</x-app-layout>