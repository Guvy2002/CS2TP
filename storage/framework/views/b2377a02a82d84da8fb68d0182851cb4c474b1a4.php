

<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>


<form action="<?php echo e(route('add-product')); ?>" method="post">
    <h1>Manage your products</h1>
    <?php if(Session::has('success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <?php if(Session::has('fail')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
    <?php endif; ?>
    <?php echo csrf_field(); ?>
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Size</th>
            <th>Gender</th>
            <th>Image</th>
            <th scope="col"></th>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo e(old('name')); ?>"></td>
                <td><input type="number" class="form-control" placeholder="Price" name="price" step="0.01" min="0.00" value="<?php echo e(old('price')); ?>"></td>
                <td><input type="number" class="form-control" placeholder="0" name="stock" min="0" value="<?php echo e(old('stock')); ?>"></td>
                <td><input type="number" class="form-control" placeholder="0" name="size" step="0.5" min="0.00" value="<?php echo e(old('size')); ?>"></td>
                <td>
                    <select class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select>
                </td>
                <td><input type="file" name="image" id="image"></td>
                <td><button type="submit">Add product</button></td>
            </tr>
        </tbody>
    </table>
</form>

<span class="text-danger"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
<span class="text-danger"><?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
<span class="text-danger"><?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
<span class="text-danger"><?php $__errorArgs = ['size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
<span class="text-danger"><?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Size</th>
        <th scope="col">Gender</th>
        <th scope="col">Image</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
            <td><?php echo e($product->id); ?></td>
            <td><?php echo e($product->name); ?></td>
            <td><?php echo e($product->price); ?></td>
            <td><?php echo e($product->stock); ?></td>
            <td><?php echo e($product->size); ?></td>
            <td><?php echo e($product->gender); ?></td>
            <td><?php echo e($product->imgPath); ?></td>
            <td><button type="submit">Edit</button></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <td>No products</td>  
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Github\CS2TP\resources\views/product/manage.blade.php ENDPATH**/ ?>