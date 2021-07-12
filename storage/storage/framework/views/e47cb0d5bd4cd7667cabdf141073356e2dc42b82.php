<?php use App\Contents; ?>
<?php if(isset($c)): ?> 
	

<?php $__env->startSection("title",__($c->title)); ?>
<?php $__env->startSection('content'); ?>
<?php $slug = str_slug($c->type); ?>
<?php 

if($c->cover == "") {
	$pic = url('assets/images/banner-bg.jpg');
} else {
	$pic = url('cache/large/'.$c->cover);
} 
$bc = str_replace("Menü / ","",$c->breadcrumb);
$bc = explode(" / ",$bc);
$ust = Contents::where("slug",$c->kid)->first();
$j = j($c->json);

?>
<?php if(View::exists("types.$slug")): ?>
	<?php echo $__env->make("types.$slug", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(View::exists("pages.".$c->slug)): ?>
	<?php echo $__env->make("pages.".$c->slug, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
	<?php 
$class="";
if($c->kid=="services") {
	$class = "";
	$pic = "assets/services.jpg";
}
?>
	<section class="default-section parallax-section  pos-relative banner <?php echo $class ?> " style="background-image: url(<?php echo e($pic); ?>);">
		<span class="pos-absolute" style="bottom: 10px; right: 10px; color:<?php echo e(@$j['Photo_Title_Color']); ?>; text-shadow: 1px 1px #444;"><?php echo e(@$j['Photo_Title']); ?></span>
	
	</section>
	<section class="default-section medium">
		<div class="container">
			<div class="row">
					
				<h1 class="col-12 section-title w-full t-left t-bold t-oswald" style="font-size: 3rem; font-weight: 800;">
					<?php echo e(__($c->title)); ?>

				</h1>
				
				<?php if($c->type=="Blog"): ?>
					<p class="col-12" style="font-size: .8rem; color: #555;"><i class="far fa-calendar-alt"></i> 
					Posted on <span class="t-italic"><?php echo e($j['Blog_Date']); ?></span>
				<?php endif; ?>
				
				</p>
				<div class="col-12 t-justify t-italic short-intro">
					<?php echo e(@$j['Short_Intro']); ?>

				</div>
				<div class="col-12 t-justify ul-fancy-chevron icerik">
					<?php echo __($c->html); ?>

					<?php echo $__env->make("inc.files", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				

			</div>
			<?php if(getisset("name")): ?>
				<?php 
			/*
			print_r($_GET);exit();
				Mail::send("mail",["mesaj"=>get("mesaj")], function ($message){
						$message->subject ('Contact Form');
						$message->from (urldecode(get("mail")), get("name"));
						$message->to(__('Admin Mail Address'), __('Başlık'));
					});
					
					*/
					 ekle([
						"title" => get("name") . " " . get("mail"),
						"slug" => rand(11111,99999),
						"type" => "Contact Form",
						"html" => get("message"),
						"json" => json_encode_tr($_POST)
					]); 
			?>
				<div class="alert alert-success"><?php echo e(__('Your message has been sent. You will be contacted as soon as possible.')); ?></div>
			<?php endif; ?>
			<?php if(strpos($c->breadcrumb,"Academy")!==false): ?>
				<div class="card">
					<div class="card-body">
						<form action="" method="get">
							<?php echo e(__('Name:')); ?>

							<input type="text" name="name" id="" class="form-control" />
							<?php echo e(__('Mail Address:')); ?>

							<input type="email" name="mail" id="" class="form-control" />
							<?php echo e(__('Message:')); ?>

							<textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
							<br /><button class="btn btn-info">Send</button>
						</form>
					</div>
				</div>
			<?php endif; ?>
			
		</div>
	</section>

<?php endif; ?> 
<?php $__env->stopSection(); ?>
<?php else: ?> 
	
<?php endif; ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dijimind/app/resources/views/default.blade.php ENDPATH**/ ?>