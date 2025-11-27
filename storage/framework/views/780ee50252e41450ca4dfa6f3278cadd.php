<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">Selamat Datang, <?php echo e(auth()->user()->name); ?>!</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <div class="p-4 bg-blue-100 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Jumlah Resep</h2>
            <p class="text-2xl"><?php echo e($recipeCount); ?></p>
        </div>
        <div class="p-4 bg-green-100 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Resep Favorit Anda</h2>
            <p class="text-2xl">-</p>
        </div>
        <div class="p-4 bg-yellow-100 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Rating Rata-rata</h2>
            <p class="text-2xl">-</p>
        </div>
    </div>

    
    <a href="<?php echo e(route('customer.recipes.index')); ?>" 
        class="px-6 py-3 bg-green-600 text-black font-semibold rounded hover:bg-green-700">
        Lihat Semua Resep
    </a>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\test\giziNrecipeProject\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>