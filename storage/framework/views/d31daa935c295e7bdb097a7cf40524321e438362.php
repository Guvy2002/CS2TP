

<?php $__env->startSection('title', 'Basket'); ?>

<?php $__env->startSection('content'); ?>
<h3>Basket</h3>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($product['id']); ?></td>
            <td><?php echo e($product['name']); ?></td>
            <td><?php echo e($product['price']); ?></td>
            <!-- TODO: Add quantity -->
            <td><input type='text' name='quantity' value=<?php echo e($product['quantity']); ?> disabled></td>
            <td><?php echo e($product['total']); ?></td>
            <td><a href="<?php echo e(route('remove-from-basket',$product['id'])); ?>">Remove</a></td>
            <td><a href="<?php echo e(route('updateQuantity',['add',$product['id']])); ?>"><button>+</button></a></td>
            <td><a href="<?php echo e(route('updateQuantity',['deduct',$product['id']])); ?>"><button>-</button></a></td>
        </tr>
        <?php $total += $product['total']; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <td>No products</td>
        <?php endif; ?>
        <?php if($total > 0): ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <tr>
            <td colspan='3' align='right'>Total</td>
            <td align='right'> <?= number_format($total, 2) ?> </td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Github\CS2TP\resources\views/basket/display.blade.php ENDPATH**/ ?>