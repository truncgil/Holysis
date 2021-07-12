<?php use App\Contents; ?>

<?php $__env->startSection("title",__('Title')); ?>
<?php $__env->startSection('content'); ?>

<div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    <img src="assets/img/logo.svg" alt="" width="512" />
                </div>
            </div>
        </div>
	
	<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
        </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/index.blade.php ENDPATH**/ ?>