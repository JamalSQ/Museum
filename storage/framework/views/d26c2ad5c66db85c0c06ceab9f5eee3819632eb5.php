<?php $__env->startSection('main-content'); ?>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="bread-inner">
          <ul class="bread-list">
            <li><a href="<?php echo e(route('home')); ?>">Home<i class="ti-arrow-right"></i></a></li>
            <li class="active"><a href="javascript:void(0);">Forgot Your Password?</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Breadcrumbs -->

<!-- Shop Login -->
<section class="shop login section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3 col-12">
        <div class="login-form">
          <h2>Forgot Your Password?</h2>
          <?php if(session('status')): ?>
          <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

          </div>
          <?php endif; ?>
          <form class="user" method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Your Email<span>*</span></label>
                  <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e($email ?? old('email')); ?>" required autocomplete="email" autofocus>
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <span class="text-danger"><?php echo e($message); ?></span>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group login-btn">
                  <button class="btn btn-facebook" type="submit">Reset Password</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Login -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<style>
  .shop.login .form .btn {
    margin-right: 0;
  }

  .btn-facebook {
    background: #39579A;
  }

  .btn-facebook:hover {
    background: #073088 !important;
  }

  .btn-github {
    background: #444444;
    color: white;
  }

  .btn-github:hover {
    background: black !important;
  }

  .btn-google {
    background: #ea4335;
    color: white;
  }

  .btn-google:hover {
    background: rgb(243, 26, 26) !important;
  }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Xampp\htdocs\Cosmose\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>