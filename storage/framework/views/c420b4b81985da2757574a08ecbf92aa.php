<?php $__env->startSection('content'); ?>

<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="<?php echo e(route('customer.recipes.index')); ?>" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Daftar Resep
            </a>
        </div>

        
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <div class="flex justify-between items-start mb-2">
            <div>
                <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
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
            </div>
            
            <div class="flex items-center space-x-2 mt-2">
                
                
                <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('recipes.bookmark', $recipe->id)); ?>" method="POST" class="inline-block">
                        <?php echo csrf_field(); ?>
                        <button type="submit" title="<?php echo e($recipe->isBookmarkedBy(auth()->user()) ? 'Hapus dari Simpanan' : 'Simpan Resep'); ?>"
                            class="p-2 rounded-full transition-colors focus:outline-none 
                            <?php echo e($recipe->isBookmarkedBy(auth()->user()) 
                                ? 'bg-red-500 text-white shadow-lg hover:bg-red-600' 
                                : 'bg-gray-200 text-gray-600 hover:bg-gray-300'); ?>">
                            
                            <?php if($recipe->isBookmarkedBy(auth()->user())): ?>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" clip-rule="evenodd" />
                                </svg>
                            <?php else: ?>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            <?php endif; ?>
                        </button>
                    </form>
                <?php endif; ?>

                
                <?php if(Auth::id() == $recipe->user_id): ?>
                    <a href="<?php echo e(route('customer.recipes.edit', $recipe->id)); ?>" class="inline-block px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-sm hover:bg-yellow-600 transition-colors">
                        Edit
                    </a>
                    <form action="<?php echo e(route('customer.recipes.destroy', $recipe->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus resep ini?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-sm hover:bg-red-700 transition-colors">
                            Hapus
                        </button>
                    </form>
                <?php endif; ?>
            </div>

        </div> 
        
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <img src="<?php echo e($recipe->photo ? asset('storage/' . $recipe->photo) : 'https://placehold.co/800x400/e2e8f0/e2e8f0?text=GiziKu'); ?>" alt="<?php echo e($recipe->name); ?>" class="w-full h-80 object-cover">
            
            <div class="p-6 md:p-8">
                <h3 class="font-semibold text-xl text-gray-800 mb-2">Deskripsi</h3>
                <p class="text-gray-700 mb-6"><?php echo e($recipe->description); ?></p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-semibold text-xl text-gray-800 mb-3">Alat & Bahan</h3>
                        <ul class="list-disc list-inside space-y-1 text-gray-700">
                            <?php $__currentLoopData = $recipe->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($ingredient->item); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\giziNrecipeProject-main\resources\views/customer/recipes/show-user.blade.php ENDPATH**/ ?>