<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Tambah Produk Baru</h1>

    <!-- Menampilkan error validasi jika ada -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form untuk menambahkan produk baru -->
    <form method="POST" action="<?php echo e(route('products.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="description" name="description" required><?php echo e(old('description')); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga Produk</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo e(old('price')); ?>" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori Produk</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Binta\Downloads\Praktikum2ABP\jual-beli-mobil\resources\views/products/create.blade.php ENDPATH**/ ?>