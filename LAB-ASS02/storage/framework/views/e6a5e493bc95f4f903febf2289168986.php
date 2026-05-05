<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Users List</h2>
    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">Add New User</a>
</div>

<form action="<?php echo e(route('users.index')); ?>" method="GET" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or CNIC..." value="<?php echo e(request('search')); ?>">
        <button type="submit" class="btn btn-outline-secondary">Search</button>
        <?php if(request('search')): ?>
            <a href="<?php echo e(route('users.index')); ?>" class="btn btn-outline-danger">Clear</a>
        <?php endif; ?>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Profile Picture</th>
                <th>Name</th>
                <th>Email</th>
                <th>CNIC</th>
                <th>Telephone</th>
                <th>Comments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($user->profile_picture): ?>
                        <img src="<?php echo e(asset('storage/' . $user->profile_picture)); ?>" alt="Profile Picture" width="50" height="50" class="rounded-circle" style="object-fit: cover;">
                    <?php else: ?>
                        <span class="text-muted">No Image</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->cnic); ?></td>
                <td><?php echo e($user->telephone); ?></td>
                <td><?php echo e(Str::limit($user->comments, 30)); ?></td>
                <td>
                    <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" class="text-center">No users found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    <?php echo e($users->withQueryString()->links('pagination::bootstrap-5')); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\Desktop\assignment no 2\labA2\resources\views/user_registrations/index.blade.php ENDPATH**/ ?>