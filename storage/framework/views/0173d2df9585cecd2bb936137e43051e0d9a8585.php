<?php if(getisset("ajax")) {
	?>
	<?php echo $__env->make("admin-ajax.{$_GET['ajax']}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php
	exit();
} ?>
<?php if(getisset("ajax2")) { //blade ajax system
	?>
	<?php echo $__env->make("{$_GET['ajax2']}", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php
	exit();
} ?>
<?php
	$permissions = @explode(",",Auth::user()->permissions);
?>

<!DOCTYPE HTML>
<html lang="tr">

<head>	

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo strip_tags($__env->yieldContent('title','')); ?></title>
    <meta name="description" content="">
    <meta name="author" content="Truncgil Technology">
    <meta property="og:title" content="">
    <meta property="og:site_name" content="https://www.truncgil.com.tr/">
    <link rel="manifest" href="/icon/manifest.json">
    <meta property="og:description" content="">
    <meta property="og:type" content="app">
    <meta property="og:url" content>
    <meta property="og:image" content>
	<div class="header-zone">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url("assets/img/favicon.png")); ?>">
		<!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/select2/css/select2.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/jquery-auto-complete/jquery.auto-complete.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/ion-rangeslider/css/ion.rangeSlider.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/dropzonejs/dist/dropzone.css')); ?>">

    <link rel="stylesheet" id="css-main" href="<?php echo e(asset('assets/admin/css/pelinom6.min.css')); ?>">
	
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
	<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
	<script type="text/javascript" src="<?php echo e(asset("assets/html2canvas.min.js")); ?>"></script>


<link href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed:100,300,400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
    <script src="<?php echo e(asset('assets/admin/js/pelinom6.core.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/pelinom6.app.min.js')); ?>"></script>
	<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css?'.rand(1111,9999))); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/tree.css')); ?>" />
	<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/theme.css')); ?>" />
	<script type="text/javascript" src="<?php echo e(asset("assets/chart/dist/Chart.min.js")); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset("assets/chart/samples/utils.js")); ?>"></script>
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/date-de.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clusterize.js/0.18.0/clusterize.min.js"></script>
<script type="text/javascript" src="<?php echo e(url('assets/barcode.js')); ?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clusterize.js/0.18.0/clusterize.min.css" />
<script type="text/javascript" src="<?php echo e(url("assets/hammer.min.js")); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset("assets/js/debounce.js")); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/plugins/dropzonejs/dropzone.min.js')); ?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</div>
</head>

<body> 
<?php if(auth()->guard()->guest()): ?>
	<?php echo $__env->yieldContent("content"); ?>
<?php else: ?>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-glass side-trans-enabled">
       
		
		<aside id="side-overlay">
            <div class="content-header content-header-fullrow">
                <div class="content-header-section align-parent">
                    <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <div class="content-header-item">
                        <img class="img-avatar img-avatar32" src="<?php echo e(asset('assets/img/user.jpg')); ?>" alt="">
                        <a class="align-middle link-effect text-primary-dark font-w600"
                            href="#">
							
                           <?php echo e(Auth::user()->name); ?>  <?php echo e(Auth::user()->surname); ?>

						   
						   <small class="badge badge-success"><?php echo e(Auth::user()->level); ?></small>
                            <!-- M????teri/Admin ismi -->
                        </a>
                    </div>
                </div>
            </div>
            <div class="content-side">
				<div class="block pull-r-l">
                    <div class="block-header bg-body-light">
                        <h3 class="block-title">
                            <i class="fas fa-file"></i>
                            <?php echo e(__('Profil Ayarlar??')); ?>

                        </h3>
                        <div class="block-options">
                            
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                        </div>
                    </div>
                    <div class="block-content"> 
						<form action="<?php echo e(url('admin?ajax=profile-update')); ?>" method="post">
							<?php echo csrf_field(); ?> 
							<?php echo e(__('Ad??')); ?>

								<input type="text" name="name" required id="" class="form-control" value="<?php echo e(Auth::user()->name); ?>" />
							<?php echo e(__('Soyad??')); ?>

								<input type="text" name="surname" required id="" class="form-control" value="<?php echo e(Auth::user()->surname); ?>" />
							<?php echo e(__('E-Mail')); ?>

								<input type="text" name="email" required id="" class="form-control" value="<?php echo e(Auth::user()->email); ?>" />
							<?php echo e(__('Telefon')); ?>

								<input type="text" name="phone" required id="" class="form-control" value="<?php echo e(Auth::user()->phone); ?>" />
							<?php echo e(__('??ifre')); ?> <small><?php echo e(__('(De??i??tirmek istemiyorsan??z bo?? b??rak??n)')); ?></small>
								<input type="text" name="password" id="" class="form-control" value="" />
							<br />
							<button class="btn btn-primary"><?php echo e(__('Bilgilerimi G??ncelle')); ?></button>

						</form>
                    </div>
                    <div class="text-center">
                <?php $dizi = glob("resources/{,*/,*/*/,*/*/*/}*.php", GLOB_BRACE);  
                array_multisort(array_map('filemtime', $dizi), SORT_NUMERIC, SORT_DESC, $dizi);
                //echo $dizi[0];
                //$ver = filemtime($dizi[0]); 
                $ver = date("y.d.h.is",filemtime($dizi[0])); 
                $last = date("d.m.Y H:i:s",filemtime($dizi[0])); 

                $ver = str_replace("0","",$ver); 
                $ver = "2.30";
                ?>
                
                <div class="btn"> <i class="fa fa-clock"></i> <?php echo e(e2("Server Time:")); ?>  <?php echo e(date("d.m.Y H:i")); ?></div>
                <div class="btn" title="<?php echo e(e2("Last Update:")); ?> <?php echo e($last); ?>"> <i class="fa fa-code-branch"></i> <?php echo e(e2("Version:")); ?>  <?php echo e($ver); ?> RC</div>
                    </div>
                </div>
               
                
                
                
            </div>
        </aside>

        
        <nav id="sidebar">
            <div class="sidebar-content">
                <div class="content-header content-header-fullrow px-15">
                    <div class="content-header-section sidebar-mini-visible-b">
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                            <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                        </span>
                    </div>
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r"
                            data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <div class="content-header-item">
                            <a class="link-effect font-w700" href="#">
                                <img id="mainLogo" width="100%" style="        max-width: 100px;" data-theme="light" src="<?php echo e(asset('assets/img/logo.svg')); ?>" class="h-full-w-auto" alt="Trun??gil Teknoloji">
                            </a>
                        </div> 
                    </div>
                </div>
                <div class="content-side">
                   
                    <div class="sidebar-mini-hidden-b text-center" style="    margin-top: 60px;">
                        
                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase title"
                                    href="#">  </a>
									
									<h2 class="text-center"><?php echo e(Auth::user()->name); ?>  <?php echo e(Auth::user()->surname); ?></h2>
									<div class="text-center badge badge-success"><?php echo e(Auth::user()->level); ?></div>
                                    <!-- ??smin ilk harfi ve Soyisim -->
                            </li>
                           
                        </ul>
                    </div>
                </div>
               <?php echo $__env->make("admin.inc.menu", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
            </div>
        </nav>

        
        <header id="page-header">
            <div class="content-header">
                <div class="content-header-section">
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="header_search_on">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="content-header-section">
               
                    <div class="btn-group" role="group">
						
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="language-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block"><?php echo e(e2(App::getLocale())); ?></span>
                            <!-- Kullan??c?? ad?? -->
                            <i class="fa fa-angle-down ml-5"></i>
                        </button>
                   
                        <div class="dropdown-menu dropdown-menu-right min-width-200"
                            aria-labelledby="language-dropdown">
                            <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase"><?php echo e(e2("Change Language")); ?></h5>
                           
                            <div class="dropdown-divider"></div>
							<?php $dil = languages(); foreach($dil AS $d) { ?>
                            <a href="#" class="dropdown-item" onclick="$.get('<?php echo e(url("ajax/set-locale?l=".$d)); ?>',function(){location.reload();})">
                                <i class="fa fa-language mr-5"></i> <?php echo e(e2($d)); ?>

                            </a>
							<?php } ?>
                            <!-- ????k???? Yap -->
                        </div>
                  
                       
						<div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<?php echo e(Auth::user()->name); ?> <?php echo e(Auth::user()->surname); ?>

						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<h5 class="h6 text-center py-10 mb-5 border-b text-uppercase"><?php echo e(Auth::user()->name); ?> <?php echo e(Auth::user()->surname); ?></h5>
							<a class="dropdown-item" href="<?php echo e(url('logout')); ?>">
                                <i class="si si-logout mr-5"></i> <?php echo e(__('????k???? Yap')); ?>

                            </a>
						  </div>
</div>
                    </div>

					<a href="<?php echo e(url('./')); ?>" target="_blank" class="btn btn-circle d-none"><i class="fa fa-globe"></i> <?php echo e(__('Siteye D??n')); ?></a>
                   <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout"
                        data-action="side_overlay_toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form action="<?php echo e(url('admin/search')); ?>" method="get">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-secondary" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control" value="<?php echo e(@$q); ?>" placeholder="<?php echo e(e2("Ara...")); ?>"
                                id="q" required  name="q">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
        </header>
		
		<div class="main-container">
			<div class="">
				
				<?php if(View::hasSection('title')): ?>
				<div class="bg-image" >
					<div class="bg-white-op-90">
						<div class="content content-full content-top">
							<h1 class="text-center"><?php echo $__env->yieldContent("title"); ?><br /> </h1>
							<div class="text-center d-none"><?php echo $__env->yieldContent("desc"); ?></div>
							
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="content-ajax">
				<?php echo $__env->yieldContent("content"); ?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
        <footer id="page-footer" class="opacity-0 t-center">
            <div class="content py-20 font-size-xs clearfix m-0-auto">
                <div class="m-0-auto">
                    Created by <a class="truncgil" href="https://www.truncgil.com.tr/">Truncgil Technology</a>. All rights reserved.
                </div>
                
            </div>
        </footer>
    </div>
	<?php endif; ?>
    <div class="script-zone">
    
    <script src="<?php echo e(asset('assets/admin/js/plugins/chartjs/Chart.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/js/plugins/slick/slick.min.js')); ?>"></script>
	<!-- include summernote css/js -->
	<script src="<?php echo e(asset('assets/admin/js/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
	<link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/summernote/summernote-bs4.css')); ?>">

	<script src="<?php echo e(asset('assets/admin/js/plugins/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>

	<link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/magnific-popup/magnific-popup.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/slick/slick.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('assets/admin/js/plugins/slick/slick.css')); ?>">
	
	<!-- Page JS Plugins -->
        <!--<script src="<?php echo e(asset('assets/admin/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>-->
        <script src="<?php echo e(asset('assets/admin/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/plugins/select2/js/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/plugins/jquery-auto-complete/jquery.auto-complete.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/plugins/masked-inputs/jquery.maskedinput.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/admin/js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js')); ?>"></script>

        <script src="<?php echo e(asset('assets/admin/js/plugins/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
		<script type="text/javascript" src="<?php echo e(asset("assets/js/jquery.mask.js")); ?>"></script>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="<?php echo e(asset('assets/js/custom2.js')); ?>"></script>
		</div>
		<!--
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
-->

<script src="<?php echo e(asset('assets/admin/js/ckeditor/ckeditor.js')); ?>"></script>
<?php echo $__env->make("admin.inc.script", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style type="text/css">
		.hidden {
			display:none !important;
		}
		.visible {
			display:block !important;
		}
		.hidden-upload {
			display:none;
			
		}
		.table-responsive {
       /*     background: url(back.png) white center center / contain no-repeat !important; */
            /* background-attachment: fixed !important; */
            background-size: 20% !important;
            background-position: center !important;
        }
		.dz-filename {
							white-space:normal !important;
							    height: 74px;
							
						}
		</style>
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title"></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-alt-secondary" data-dismiss="modal"><?php echo e(__('Hay??r')); ?></button>
                <a href="#" class="btn btn-alt-success tamam" data-dismiss="modal">
                    <i class="fa fa-check"></i> <?php echo e(__('Evet')); ?>

                </a>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<style type="text/css">
.cke_button__easyimageupload {
	display:none !important;
}

</style>
<script>
 
</script> <?php /**PATH /home/dijimin2/hacksmarcity/resources/views/admin/master.blade.php ENDPATH**/ ?>