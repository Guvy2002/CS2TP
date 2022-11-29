

<?php $__env->startSection('title', 'Welcome'); ?>

<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('register-user')); ?>" method="post">
    <?php if(Session::has('success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
    <?php endif; ?>
    <?php if(Session::has('fail')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
    <?php endif; ?>
    <?php if(Session::has('mismatch')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('mismatch')); ?></div>
    <?php endif; ?>
    <?php echo csrf_field(); ?>
    <div class="col-md-4 col-md-offset-4">
        <label for="name">Name</label>
        <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo e(old('name')); ?>">
        <span class="text-danger"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
        <br>

        <label for="email">Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>">
        <span class="text-danger"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
        <br>

        <label for="password">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" value="">
        <span class="text-danger"><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
        <br>

        <label for="password2">Password</label>
        <input type="password" class="form-control" placeholder="Re-enter Password" name="password2" value="">
        <span class="text-danger"><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
        <br>

        <button type="submit">Create account</button>
        <a href="<?php echo e(url('login')); ?>">Sign in</a>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Github\CS2TP\resources\views/auth/register.blade.php ENDPATH**/ ?>