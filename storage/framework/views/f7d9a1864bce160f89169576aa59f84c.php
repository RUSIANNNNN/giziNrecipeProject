

<?php $__env->startSection('content'); ?>

<div class="py-6">
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
<h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
Edit Resep Kamu
</h2>

    
    <form action="<?php echo e(route('customer.recipes.update', $recipe->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?> 
        
        <!-- Nama Makanan -->
        <div class="mb-4">
            <label class="block font-medium">Nama Makanan:</label>
            <input type="text" name="name" class="w-full border rounded px-2 py-1" value="<?php echo e(old('name', $recipe->name)); ?>" required>
        </div>

        <!-- Durasi -->
        <div class="mb-4">
            <label class="block font-medium">Durasi:</label>
            <input type="text" name="duration" class="w-full border rounded px-2 py-1" value="<?php echo e(old('duration', $recipe->duration)); ?>" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block font-medium">Deskripsi Singkat:</label>
            <textarea name="description" class="w-full border rounded px-2 py-1" rows="3" required><?php echo e(old('description', $recipe->description)); ?></textarea>
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label class="block font-medium">Foto (Ganti jika perlu):</label>
            <?php if($recipe->photo): ?>
                <img src="<?php echo e(asset('storage/' . $recipe->photo)); ?>" alt="<?php echo e($recipe->name); ?>" class="w-32 h-32 object-cover rounded mb-2">
            <?php endif; ?>
            <input type="file" name="photo" class="w-full">
        </div>

        <!-- Bahan / Alat -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Alat & Bahan:</label>
            <div id="ingredients-wrapper">
                <?php $__currentLoopData = $recipe->ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex mb-2">
                    <input type="text" name="ingredients[]" class="w-full border rounded px-2 py-1" value="<?php echo e($ingredient->item); ?>" required>
                    <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button type="button" onclick="addIngredient()" class="px-4 py-1 bg-green-600 text-white rounded">Tambah Bahan</button>
        </div>

        <!-- Langkah / Cara -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Langkah Cara Membuat:</label>
            <div id="steps-wrapper">
                <?php $__currentLoopData = $recipe->steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex mb-2">
                    <input type="text" name="steps[]" class="w-full border rounded px-2 py-1" value="<?php echo e($step->instruction); ?>" required>
                    <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button type="button" onclick="addStep()" class="px-4 py-1 bg-green-600 text-white rounded">Tambah Langkah</button>
        </div>

        <!-- Kandungan Gizi -->
        <div class="mb-4">
            <label class="block font-medium mb-2">Kandungan Gizi (Opsional):</label>
            <div id="nutrition-wrapper">
                <?php $__currentLoopData = $recipe->nutritions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $nutrition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex mb-2 space-x-2">
                    <input type="text" name="nutritions[<?php echo e($index); ?>][name]" class="border rounded px-2 py-1" value="<?php echo e($nutrition->name); ?>">
                    <input type="text" name="nutritions[<?php echo e($index); ?>][amount]" class="border rounded px-2 py-1" value="<?php echo e($nutrition->value); ?>">
                    <button type="button" onclick="removeInput(this)" class="px-2 bg-red-500 text-white rounded">Hapus</button>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <button type="button" onclick="addNutrition()" class="px-4 py-1 bg-green-600 text-white rounded">Tambah Gizi</button>
        </div>

        <!-- Submit -->
        <div class="mt-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Resep</button>
        </div>
    </form>
</div>


</div>



<script>
function removeInput(btn) {
    btn.parentElement.remove();
}

function addIngredient() {
    const wrapper = document.getElementById('ingredients-wrapper');
    const div = document.createElement('div');
    div.classList.add('flex', 'mb-2');
    // PASTIKAN DI SINI MENGGUNAKAN 'text-white'
    div.innerHTML = `<input type="text" name="ingredients[]" class="w-full border rounded px-2 py-1" placeholder="Nama bahan/alat" required>
                     <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>`;
    wrapper.appendChild(div);
}

function addStep() {
    const wrapper = document.getElementById('steps-wrapper');
    const div = document.createElement('div');
    div.classList.add('flex', 'mb-2');
    // PASTIKAN DI SINI MENGGUNAKAN 'text-white'
    div.innerHTML = `<input type="text" name="steps[]" class="w-full border rounded px-2 py-1" placeholder="Langkah pembuatan" required>
                     <button type="button" onclick="removeInput(this)" class="ml-2 px-2 bg-red-500 text-white rounded">Hapus</button>`;
    wrapper.appendChild(div);
}

let nutritionIndex = 0;
function addNutrition() {
    const wrapper = document.getElementById('nutrition-wrapper');
    const div = document.createElement('div');
    div.classList.add('flex', 'mb-2', 'space-x-2');
    // PASTIKAN DI SINI MENGGUNAKAN 'text-white'
    div.innerHTML = `<input type="text" name="nutritions[${nutritionIndex}][name]" class="border rounded px-2 py-1" placeholder="Nama gizi (e.g. Kalori)">
                     <input type="text" name="nutritions[${nutritionIndex}][amount]" class="border rounded px-2 py-1" placeholder="Jumlah (e.g. 150 kcal)">
                     <button type="button" onclick="removeInput(this)" class="px-2 bg-red-500 text-white rounded">Hapus</button>`;
    wrapper.appendChild(div);
    nutritionIndex++;
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\test\giziNrecipeProject\resources\views/customer/recipes/edit-user.blade.php ENDPATH**/ ?>