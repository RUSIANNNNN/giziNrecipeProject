<?php $__env->startSection('content'); ?>

<div class="py-6">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="flex justify-between items-center mb-4">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Daftar Resep GiziKu
</h2>
<a href="<?php echo e(route('customer.recipes.create')); ?>" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
+ Tambah Resep Kamu
</a>
</div>

    <!-- Grid untuk resep -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            
            <a href="<?php echo e(route('customer.recipes.show', $recipe->id)); ?>" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                <div class="flex flex-col h-full">
                    <img src="<?php echo e($recipe->photo ? asset('storage/' . $recipe->photo) : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=GiziKu'); ?>" alt="<?php echo e($recipe->name); ?>" class="w-full h-48 object-cover">
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <?php if($recipe->is_official): ?>
                            <span class="inline-block bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full mb-2 w-max">
                                Resep Official
                            </span>
                        <?php endif; ?>
                        
                        
                        <h3 class="font-semibold text-lg text-gray-900 flex-grow">
                            <?php echo e($recipe->name); ?>

                        </h3>
                        
                        <p class="text-gray-600 text-sm mt-2">
                            Durasi: <?php echo e($recipe->duration); ?>

                        </p>
                        
                        <p class="text-gray-500 text-sm mt-1">
                            Oleh: 
                            <?php if($recipe->is_official): ?>
                                <strong>Pakar Gizi (<?php echo e($recipe->nutritionist); ?>)</strong>
                            <?php else: ?>
                                <strong><?php echo e($recipe->user->name ?? 'User'); ?></strong>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-700 col-span-3">Belum ada resep yang diposting.</p>
        <?php endif; ?>
    </div>

    <!-- Link Paginasi -->
    <div class="mt-6">
        <?php echo e($recipes->links()); ?>

    </div>
</div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\test\giziNrecipeProject\resources\views/customer/recipes/index.blade.php ENDPATH**/ ?>