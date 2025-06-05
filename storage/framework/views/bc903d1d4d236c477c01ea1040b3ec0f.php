<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Daftar Produk</h1>

    <!-- Tombol untuk menambahkan produk baru -->
    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-success mb-3">Tambah Produk Baru</a>

    <!-- Menampilkan pesan sukses jika ada -->
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Menampilkan tabel daftar produk -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($product->name); ?></td>
                <td><?php echo e($product->description); ?></td>
                <td><?php echo e($product->price); ?></td>
                <td><?php echo e($product->category->name); ?></td>
                <td>
                    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Menampilkan pagination -->
    <?php echo e($products->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Binta\Downloads\Praktikum2ABP\jual-beli-mobil\resources\views/products/index.blade.php ENDPATH**/ ?>