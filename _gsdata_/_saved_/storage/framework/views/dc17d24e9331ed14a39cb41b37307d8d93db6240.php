<?php $__env->startSection('content'); ?>
<div id="page-container" class="main-content-boxed side-trans-enabled">

            <!-- Main Container -->
            <main id="main-container" style="min-height: 557px;">

                <!-- Page Content -->
                <div class="bg-gd-dusk">
                    <div class="hero-static content content-full bg-white js-appear-enabled animated fadeIn" data-toggle="appear">
                        <!-- Header -->
                        <div class="py-30 px-5 text-center">
                            <a class="link-effect font-w700" href="./">
								<img src="<?php echo e(url('assets/img/logo.svg')); ?>" width="512" class="img-fluid" alt="" />
                            </a>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <div class="row justify-content-center px-5">
                            <div class="col-sm-8 col-md-6 col-xl-4">
                                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signin" action="<?php echo e(route('login')); ?>" method="post" novalidate="novalidate">
                                    <?php echo csrf_field(); ?>
									<div class="form-group row">
                                        <div class="col-12">
                                            <div class="floating">
                                                <input type="text" class="form-control" id="login-username" name="email">
                                                <label for="login-username"><?php echo e(__('Username')); ?></label>
                                            </div>
											<?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
												<div class="alert alert-danger" >
													<strong><?php echo e($message); ?></strong>
												</div>
											<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="floating">
                                                <input type="password" class="form-control" id="login-password" name="password">
                                                <label for="login-password"><?php echo e(__('Password')); ?></label>
                                            </div>
											<?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
												<div class="alert alert-danger">
													<strong><?php echo e($message); ?></strong>
												</div>
											<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                        </div>
                                    </div>
									<div class="form-group row">
										<div class="col-md-6 offset-md-4">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

												<label class="form-check-label" for="remember">
													<?php echo e(__('Remember Me')); ?>

												</label>
											</div>
										</div>
									</div>
                                    <div class="form-group row gutters-tiny">
                                        <div class="col-12 mb-10">
                                            <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                                <i class="si si-login mr-10"></i> <?php echo e(__('Login')); ?>

                                            </button>
                                        </div>
                                        <div class="col-sm-6 mb-5">
                                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="<?php echo e(route('register')); ?>">
                                                <i class="fa fa-plus text-muted mr-5"></i> <?php echo e(__('Yeni Kullanıcı')); ?>

                                            </a>
                                        </div>
                                        <div class="col-sm-6 mb-5">
										<?php if(Route::has('password.request')): ?>
                                            <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="<?php echo e(route('password.request')); ?>">
                                                <i class="fa fa-key text-muted mr-5"></i> <?php echo e(__('Giriş yapamıyorum')); ?>

                                            </a>
										<?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END Sign In Form -->
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/auth/login.blade.php ENDPATH**/ ?>