<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Produk</h1>

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

    <!-- Form untuk mengedit produk -->
    <form method="POST" action="<?php echo e(route('products.update', $product->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($product->name); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="description" name="description" required><?php echo e($product->description); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga Produk</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo e($product->price); ?>" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori Produk</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Binta\Downloads\Praktikum2ABP\jual-beli-mobil\resources\views/products/edit.blade.php ENDPATH**/ ?>