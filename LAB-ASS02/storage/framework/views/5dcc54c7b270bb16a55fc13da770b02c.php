<?php $__env->startSection('content'); ?>
<div class="card shadow-sm max-w-md mx-auto" style="max-width: 600px;">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Register New User</h4>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('users.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3">
                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="cnic" class="form-label">CNIC <span class="text-danger">*</span></label>
                <input type="text" name="cnic" id="cnic" class="form-control" value="<?php echo e(old('cnic')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Telephone <span class="text-danger">*</span></label>
                <input type="text" name="telephone" id="telephone" class="form-control" value="<?php echo e(old('telephone')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="comments" class="form-label">Comments</label>
                <textarea name="comments" id="comments" rows="3" class="form-control"><?php echo e(old('comments')); ?></textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\Desktop\assignment no 2\labA2\resources\views/user_registrations/create.blade.php ENDPATH**/ ?>