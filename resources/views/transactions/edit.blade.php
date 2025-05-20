<x-app-layout>
    <div class="container">
        <h1 class="text-2xl font-semibold mb-4">Edit Transaksi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="customer_id" class="form-label">Pelanggan</label>
                <select name="customer_id" id="customer_id" 
                        class="form-control" required>
                    <option value="">Pilih Pelanggan</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} ({{ $customer->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="product_id" class="form-label">Produk</label>
                <select name="product_id" id="product_id" 
                        class="form-control" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">Kuantitas</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $transaction->quantity) }}" 
                        class="form-control" min="1" required>
            </div>

            <div class="mb-4">
                <label for="total_price" class="form-label">Total Harga (Rp)</label>
                <input type="number" name="total_price" id="total_price" value="{{ old('total_price', $transaction->total_price) }}" 
                        class="form-control" readonly required>
            </div>

            <div class="mb-4">
                <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" id="transaction_date" 
                        value="{{ old('transaction_date', now()->format('Y-m-d')) }}" 
                        class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </form>

        <script>
            document.getElementById('product_id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                const quantity = document.getElementById('quantity').value;
                if (price && quantity) {
                    document.getElementById('total_price').value = price * quantity;
                }
            });

            document.getElementById('quantity').addEventListener('change', function() {
                const product = document.getElementById('product_id');
                const price = product.options[product.selectedIndex].getAttribute('data-price');
                const quantity = this.value;
                if (price && quantity) {
                    document.getElementById('total_price').value = price * quantity;
                }
            });
        </script>
    </div>
</x-app-layout>