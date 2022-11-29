

<?php $__env->startSection('title', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>

<table class="table">
  <thead>
    <tr>
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
      <td><?php echo e($product->name); ?></td>
      <td><?php echo e($product->price); ?></td>
      <td><?php echo e($product->stock); ?></td>
      <td><?php echo e($product->size); ?></td>
      <td><?php echo e($product->gender); ?></td>
      <td><?php echo e($product->imgPath); ?></td>
      <form action="<?php echo e(route('add-to-basket')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <input type='hidden' name='hidden_id' value="<?php echo e($product->id); ?>" />
        <input type='hidden' name='hidden_name' value="<?php echo e($product->name); ?>" />
        <input type='hidden' name='hidden_price' value="<?php echo e($product->price); ?>" />
        <td><input type="submit" value="Add to cart"></td>
      </form>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <td>No products</td>
    <?php endif; ?>
  </tbody>
</table>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Github\CS2TP\resources\views/products.blade.php ENDPATH**/ ?>