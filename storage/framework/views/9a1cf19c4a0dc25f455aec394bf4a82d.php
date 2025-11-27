<?php $__env->startSection('content'); ?>

<div class="py-6">
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

    <h2 class="font-semibold text-3xl text-gray-800 leading-tight mb-2">
        <?php echo e($recipe->name); ?>

    </h2>
    
    <p class="text-gray-600 text-sm mb-4">
        Oleh: 
        <?php if($recipe->is_official): ?>
            <strong>Pakar Gizi (<?php echo e($recipe->nutritionist); ?>)</strong>
        <?php else: ?>
            <strong><?php echo e($recipe->user->name ?? 'User'); ?></strong>
        <?php endif; ?>
        | Durasi: <strong><?php echo e($recipe->duration); ?></strong>
    </p>

    <!-- Tombol Aksi (Edit/Hapus) -->
    <?php if(Auth::id() == $recipe->user_id): ?>
        <div class="mb-6 space-x-2">
            
            <a href="<?php echo e(route('customer.recipes.edit', $recipe->id)); ?>" class="inline-block px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-sm hover:bg-yellow-600 transition-colors">
                Edit Resep
            </a>
            <form action="<?php echo e(route('customer.recipes.destroy', $recipe->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus resep ini?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-sm hover:bg-red-700 transition-colors">
                    Hapus Resep
                </button>
            </form>
        </div>
    <?php endif; ?>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        
        <img src="<?php echo e($recipe->photo ? asset('storage/' . $recipe->photo) : 'https://placehold.co/800x400/e2e8f0/e2e8f0?text=GiziKu'); ?>" alt="<?php echo e($recipe->name); ?>" class="w-full h-80 object-cover">
        
        <div class="p-6 md:p-8">
            <h3 class="font-semibold text-xl text-gray-800 mb-2">Deskripsi</h3>
            <p class="text-gray-700 mb-6"><?php echo e($recipe->description); ?></p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Bahan & Alat -->
                <div>
                    <h3 class="font-semibold text-xl text-gray-800 mb-3">Alat & Bahan</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                        <?php $__currentLoopData = $recipe->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($ingredient->item); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                
                <!-- Gizi -->
                <div>
                    <h3 class="font-semibold text-xl text-gray-800 mb-3">Informasi Gizi</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                        <?php $__empty_1 = true; $__currentLoopData = $recipe->nutritions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nutrition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li><strong><?php echo e($nutrition->name); ?>:</strong> <?php echo e($nutrition->value); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>Informasi gizi tidak tersedia.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Langkah -->
            <div class="mt-8">
                <h3 class="font-semibold text-xl text-gray-800 mb-3">Langkah Pembuatan</h3>
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                    <?php $__currentLoopData = $recipe->steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($step->instruction); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
        </div>
    </div>

</div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\test\giziNrecipeProject\resources\views/customer/recipes/show-user.blade.php ENDPATH**/ ?>