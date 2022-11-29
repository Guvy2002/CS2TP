

<?php $__env->startSection('title', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Group</th>
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
                <td><?php echo e($data->name); ?></td>
                <td><?php echo e($data->email); ?></td>
                <td><?php echo e($data->group); ?></td>
                <td>
                    <?php if($data->group > 0): ?>
                        <a href="<?php echo e(url('manage')); ?>">Manage Products</a><br>
                    <?php endif; ?>
                    <a href="<?php echo e(url('products')); ?>">Products</a><br>
                    <a href="<?php echo e(url('logout')); ?>">Logout</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Github\CS2TP\resources\views/home.blade.php ENDPATH**/ ?>