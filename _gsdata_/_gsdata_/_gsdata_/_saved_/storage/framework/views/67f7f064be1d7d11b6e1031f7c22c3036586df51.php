<div id="popover_content_wrapper" class="d-none"></div>
 <div class="dropdown-menu dropdown-menu-sm" id="context-menu" style="z-index:10000">
	<div id="title"></div>
	<div id="ajax"></div>
</div>
<style type="text/css">
#context-menu * {
	font-size:12px;
}
</style>
<script>
	function saveIfProcess(){
		//$(".save").trigger("click");
		window.setTimeout(function(){
			saveData();
		},500);
		window.setTimeout(function(){
			localStorage.setItem("refresh",true);
			localStorage.setItem("w","<?php echo e(get("w")); ?>");
		},500);
		
	}
	function saveIfProcess2(){
		$(".save").trigger("click");
		
		
	}
 function calculate() {
				var gercek = eval($("#BedarfsmengeSD").val())/eval($("#qty").val());
				var tam = Math.round(gercek);
				if(gercek!=tam) {
					//tam = tam -1;
					var kalan = eval($("#BedarfsmengeSD").val())%eval($("#qty").val());
				} else  {
					kalan = 0;
				}
				
				kalan = parseInt(eval($("#BedarfsmengeSD").val().replace(',','').replace('.',''))) % parseInt(eval($("#qty").val()));
				tam = (parseInt(eval($("#BedarfsmengeSD").val().replace(',','').replace('.',''))) - kalan) / parseInt(eval($("#qty").val()));
				
				
			  $(".one_shift").html(tam);
			  $(".one_shift_kalan").html(kalan);
			  $(".schedule").removeClass("d-none");
		  }
function rightMenu() {
		$(".planning-board .job").on('contextmenu', function(e){
			e.preventDefault();
			var top = e.pageY - 10;
			  var left = e.pageX;
			  $("#context-menu").css({
				display: "block",
				top: top,
				left: left
			  })
			  .addClass("show")
			  .on("click",function(){
				  $(this).hide();
			  });
			  
			  $("#context-menu #title").html($(this).attr("data-original-title"));
			  $("#context-menu #ajax")
			  .html('<i class="fa fa-spin fa-spinner"></i>')
			  .load('?ajax=planning-tooltip&id='+$(this).attr("jid"));
			
			return false;
		});
	}
function loader(id) {
	
	var url = '?ajax=planning-board-load&type=<?php echo e(get("w")); ?>';
	//console.log("load-id:",id);
	if(id!==undefined) {
		url = '?ajax=planning-board-load&type=<?php echo e(get("w")); ?>&id='+id;
	}
	
	//console.log("url+"+url);
	$.getJSON(url, function(jd) {
		//console.log("Load JSON Data");
		//console.log(jd);
		$(".planning-board .vardiya").not(".tatil").html("");
		$.each(jd,function(i,d){
			////console.log(d);
			$("#"+d.id).html(d.html);
			
			//console.log("jid:"+d.jid);
			$(".plan-ajax #j"+d.jid).addClass("onboard");
		//	alert("ok");
			if($("#"+d.id+" .job").attr("checked2")!=undefined) {
				
				$(".plan-ajax #j"+d.jid).attr("checked2","true");
				$(".plan-ajax #j"+d.jid+" .arrow-left").removeClass("d-none");
			}
			if($("#"+d.id+" .job").attr("checked")!=undefined) {
				$(".plan-ajax #j"+d.jid).addClass("checked");
			}
			$(".planning-board .j"+d.jid).unbind();
			////console.log("dblclick"+d.jid);
			$(".planning-board .j"+d.jid).on("dblclick",function(){
				//console.log("dblclick");
			//	//console.log(d.jid);
			//	//console.log($(".drag-data #j"+d.jid).length);
				jobModalDetail(d.jid,$(this).text());
				return false;
				/*
				if($(".drag-data #j"+d.jid).length==0) {
					alert("<?php echo e(e2("This card is not found will can be deleted")); ?>");
					$(".planning-board .j"+d.jid).remove();
				} else {
					jobEvent();
					$(".drag-data #j"+d.jid).trigger("dblclick").show();
				}
				*/
				
				
			});
			/*
			$(".planning-board #j"+d.jid).unbind();
			$(".planning-board #j"+d.jid).on("dblclick",function(){
				//console.log("ok");
				$(".drag-data #j"+d.jid).trigger("dblclick");
			});
			*/
		});
		/*
		$(".planning-board .job").on("mouseover",function(){
		//	$(".popover").hide();
			$("#popover_content_wrapper").load(("?ajax=planning-tooltip&w=<?php echo e(get("w")); ?>&id="+$(this).attr("jid")));
			
			
		});
		*/
		var ilk_boyut;
		$(".planning-board .job").on("mousedown",function(){
			//console.log("mousedown");
			ilk_boyut = $(this).width();
			//console.log(ilk_boyut);
		});
		$(".planning-board .job").on("mouseup",function(){
			//console.log("mouseup");
			$(".planning-board .job:eq("+eval($(this).index()+1)+")").next().css("left",ilk_boyut-$(this).width()+"px");
		});
		/*
		$(".planning-board .job").popover({
			content : function() {
				return $('#popover_content_wrapper').html();
			  },
			trigger:"click",
			html: true
		});
		*/
	//	$(".planning-board .job").removeAttr("title")
		
		dragEvent();
		$(".planning-board").css("opacity","1");
		rightMenu();
   });
}

function popoverDetail(){
	
	
	
	
	
}
//loader();
function saveData() {
	var data = [];
	$(".planning-board .vardiya").each(function(){
		var html = $(this).html();
		var workstation = $(this).attr("workstation");
		var date =  $(this).attr("date");
		var id =  $(this).attr("id");
		var jid = $(this).children().attr("jid");
		if(html!="") {
			data.push({
				html : html,
				jid : jid,
				workstation: workstation,
				date : date,
				id : id
				
			});	
		}
		
		
	});
	
	$.post("?ajax=planning-board-save",{
		data : JSON.stringify(data),
		type : "<?php echo e(get("w")); ?>",
		_token : "<?php echo e(csrf_token()); ?>"
	},function(){
		//console.log("Save All Data!");
	});
}
function saver() { //planning boarddaki tüm veriyi save etmek üzere backende gönderir
	saveData();
	
	//$(".process-external").trigger("click");
}
var eski = $(".save").html();
$(".save").unbind();
$(".save").on("click",function(){
	
	var bu = $(this);
	$(this).html("Saved!");
	saver();
	window.setTimeout(function(){
		bu.html(eski);
	},3000);
});
/*
window.setInterval(function(){
	saver();
},3000);
*/
function jobModalDetail(jid,title) {
	//console.log("jobModalDetail="+jid);
	$("#job-detail").modal();
	$("#job-detail .modal-title .title").html(title);
	var url = "?ajax=planning-detail&w=<?php echo e(get("w")); ?>&id="+jid;
	//console.log(url);
	$("#job-detail .modal-body").html('<i class="fa fa-spin fa-spinner"></i>').load(url);
}

function jobEvent(){
	/*
	$( ".drag-data .job" ).draggable();
    $( ".vardiya" ).droppable({
      drop: function( event, ui ) {
        $( this )
          .addClass( "ui-state-highlight" )
          .find( "p" )
            .html( "Dropped!" );
      }
    });
	*/
	$( ".drag-data .job" ).unbind();
	$( ".drag-data .job" )
				.addClass("badge badge-default badge-pill")
				
				.on("mouseup",function(){
					//console.log("mouseup");
					var boyut = Math.round($(this).width()/$(this).parent().width());
				//	$(this).css("width","calc((100% * "+boyut+") + "+boyut+"*1px )"); 
					//console.log("mouseup"+boyut); 
					var ust = $(this).parent();
					var vardiya = ust.attr("vardiya");
					var machine = ust.attr("machine");
					var workstation = ust.attr("workstation");
					var jid = $(this).attr("jid");
					var index = $("#"+$(this).parent().attr("id")).index();
					//console.log(vardiya);
					$(".block"+jid).remove();
					for(k=index+1;k<=index+boyut-1;k++) {
						
						$(this).next().html('<div class="block-zone block'+jid+'"></div>');
					}
					
				})
				.on("mousedown",function(){
					//console.log("mousedown");
				})
				.on("off",function(){
					//console.log("off");
				})
				.on("mousepress",function(){
					//console.log("mousepress");
				}).on("dblclick",function(){
					var bu = $(this);
					var id = bu.attr("id");
					var jid = bu.attr("jid");
					
					jobModalDetail(jid,bu.text());
					return false;
				//	$("#job-detail .modal-body .detail").html($(this).attr("json"));
				
					//console.log();
					var style = $(this).attr("style");
					
					var dizi = JSON.parse($(this).children(".json").html());
					var json = JSON.stringify(dizi);
					$("#job-detail .modal-body table").html("");
					$.each( dizi, function( key, value ) {
						if(key!="") {
							if(key=="Color") {
								$("#job-detail .modal-body table").append("<tr><td>"+key+"</td><td style='background:"+value+"'></td></tr>");
							} else {
								$("#job-detail .modal-body table").append("<tr><td>"+key+"</td><td>"+value+"</td></tr>");
							}
							
						}
					});
					
					var total = (dizi['Bedarfsmenge SD'].replace(".",""));
					total = (total.replace(",","."));
					$(".modal-body #BedarfsmengeSD").val(total);
					$(".modal-body #qty").attr("max",total).prop("max",total);
					//console.log(total);
				//	//console.log(dizi);
					$(".finish input").unbind(); 
					
					if(bu.attr("checked")!=undefined) {
						$(".finish input").attr("checked","checked");
						$(".finish input").prop("checked",true);
					} else {
						$(".finish input").removeAttr("checked");
						$(".finish input").prop("checked",false);
					}
					$(".finish input").on("click",function(){
						//console.log(id);
						if(bu.attr("checked")!=undefined) {
							bu.attr("style",style);
							$(".j"+id).attr("style",style).css("display","block");
							bu.removeAttr("checked");
							
						} else {
							bu.css("background","#9ccc65");
							$(".j"+id).css("background","#9ccc65").css("display","block");
							bu.attr("checked","checked");
							
						}
						
					});
					var id = dizi['ID'];
					//console.log("id "+id);
					if($('.planning-board .j'+id).length>0 || $('.planning-board #j'+id).length>0) { //eğer planlamaya alınan bir işlem varsa
						$(".modal-footer .delete").removeClass("d-none");
						$(".modal-footer .schedule").addClass("d-none");
					} else {
						$(".modal-footer .delete").addClass("d-none");
						
					}
					$(".modal-footer .delete").unbind(); 
					var secici = '.planning-board .j'+id;
					var plan_secici = '.planning-board #j'+id;
					var drag_secici = '.drag-data[jid="'+id+'"]';
					var secici2 = '.drag-data #j'+id;
					$(".modal-footer .delete").unbind();
					$(".modal-footer .delete").on("click",function(){
						
					/*
						
						//console.log(secici);
						$(secici).remove();
						$(drag_secici).html($(plan_secici).parent().html());
						$(plan_secici).remove();
						
						
						$(secici2).show();
						jobEvent();
						$(".save").trigger("click");
						$(this).html("All work deleted from plan");
						*/
					});
					$(".calculate").unbind();
					$(".calculate").on("click",function(){
						$(".modal-footer .schedule").removeClass("d-none");
					});
					$(".schedule").unbind(); 
					var workstation = dizi['Arbeitsplatz'];
						//eğer HAND veya END ise workstation listesini göster
						if(dizi['MRP Contr.']=="HF" || dizi['MRP Contr.']=="END") {
							$(".select-workstation").removeClass("d-none");
							workstation = $(".select-workstation select").val(); // ilk değeri varsayılan
							$(".select-workstation select").on("change",function(){
								workstation = $(this).val();
								//console.log("seçilen workstation: "+workstation);
							});
						} else {
							$(".select-workstation").addClass("d-none");
						}
					$(".schedule").on("click",function(){
						return false;
						
						//workstationın ismini alıyoruz
						//console.log("seçilen workstation: "+workstation);
						
						var vardiya = $(".vardiyalar [name='Schicht[]']:checked").map(function(){
						  return $(this).val();
						}).get(); 
						var miktar = $(".one_shift").html(); //boyut
						var kalan_miktar = $(".one_shift_kalan").html(); //boyut
						var qty = $("#qty").val(); //boyut
						var yarim_qty = qty/2; // yarım vardiyaya düşen 
						//miktar = miktar -1;
						var miktar2 = miktar;//miktar/vardiya.length;
						
						var vm = vardiya.length;
						//console.log("vardiya"+vm);
						//console.log("miktar"+miktar);
						//console.log(vardiya);
						//console.log(bu.html());
						var boyut=miktar*2;
						if(vm==3) { //3 vardiya da seçili demektir o zaman tek parça yap
							//console.log("3 vardiya seçildi");
							//console.log("boyut" + boyut);
							isaretle(id,json,style,workstation,miktar,boyut,bu.html(),yarim_qty,"");
						} else {
							isaretle(id,json,style,workstation,miktar,boyut,bu.html(),yarim_qty,vardiya);
							return false;
							boyut = boyut / 3;  
							$.each(vardiya,function(key,v){
								
									//console.log("checked",v);
									
									isaretle(id,json,style,workstation,miktar,boyut,bu.html(),yarim_qty,v);
								
							});	
						}
						if(vm==3) {
							
							if(kalan_miktar!=0) { //eğer kalan miktar varsa 
								//console.log("kalan miktar");
								//console.log(kalan_miktar); 
								var parca = 1;
								if(kalan_miktar>yarim_qty) {
									parca = 2;
									kalan_miktar = kalan_miktar/2;
								} 
								isaretle(id,json,style,workstation,kalan_miktar,parca,bu.html(),kalan_miktar,"");
								
							}
							
						} else {
							if(kalan_miktar!=0) { //eğer kalan miktar varsa 
								//console.log("kalan miktar");
								//console.log(kalan_miktar); 
								var parca = 1;
								if(kalan_miktar>yarim_qty) {
									parca = 2;
									kalan_miktar = kalan_miktar/2;
								} 
								isaretle(id,json,style,workstation,kalan_miktar,parca,bu.html(),kalan_miktar,vardiya);
								
							}
						}
					//	$(secici2).addClass("onboard");
						
						saveIfProcess();
						
						
					});
				})
				//.tooltip()
				;
						
							
						
}

function job(boyut=1,html) {
	var td_width = $("table .vardiya").width(); 
	//console.log(td_width);
	var r = Math.round(Math.random()*100000);
//	boyut = boyut +2;
	var style="width: calc("+eval(100*(boyut))+"% + 2px)";
	
	return '<div class="job" id="j'+r+'" style="'+style+'" title="'+html+'">'+html+'</div>';
}


function isaretle(id,json,style,workstation,miktar,boyut,html,qty,vardiya) { //plan üzerinde ilgili workstationa istenilen miktarda işaretleme yapar
	var k = 1;
	if(vardiya=="" || vardiya===undefined) {
		var secici = $("[workstation='"+workstation+"']:empty");
		//console.log("tüm vardiyalar");
	} else {
		var vardiyalar = []
		$.each(vardiya,function(i,v){
			vardiyalar.push("[workstation='"+workstation+"'][vardiya='"+v+"']:empty");
		});
		//console.log("vardiya join="+vardiyalar);
		var secici = $(vardiyalar.join(","));
	//	var secici = $("[workstation='"+workstation+"'][vardiya='"+vardiya+"']:empty");
		////console.log(vardiya + " vardiyası");
	}
	
	
//	miktar = miktar*2;
	if(secici.length<boyut) {
		alert("<?php echo e(e2("Settlement could not be made because the calendar is full. Number of remaining fields: ")); ?>"+secici.length);
	} else {
		
		secici.each(function(){
			//console.log("gelen boyut="+boyut);
			if(k<=boyut) {
				//console.log("parçalanan işlem:"+k);
				
				$(this).html('<div class="job fill j'+id+'" draggable="true" ondragstart="drag(event)"  jid="'+id+'" style="'+style+'" title="'+qty+'/'+' <?php echo e(e2("Part")); ?> '+k+'">'+html+'<div class="delete"></div></div>');
				/*
				if(vardiya=="") {
					//console.log("vardiye 3 seçilmiş");
					if(k==1) {
						//$(this).append(job(boyut,html));
					}
					
				} else {
					//console.log("bazı vardiyalar seçilmiş");
					//$(this).append(job(boyut,html));
				}
				*/
				
				/*.on("mouseover",function(){
					$("[jid='"+$(this).attr("jid")+"']").css("background","#e6e6e6"); 
				})
				.on("mouseout",function(){
					$("[jid='"+$(this).attr("jid")+"']").css("background","#fff");
				});*/
				//jobEvent();
				
			}
			
			k++;
			
		});	
	//	$(".job").tooltip();
	}
	$(".j"+id).on("dblclick",function(){
		//console.log($("#j"+id).lenght);
					$("#j"+id).trigger("dblclick");
				});

	
}


    


    function allowDrop(ev) {
	  ev.preventDefault();
	}
	
	$('#fixedDrag').change(function(){
		if($(this).is(':checked')){
			$('#dragAll').prop('checked', false);
            $('#resizableSelector').prop('checked', false);
        }
	});
	$('#dragAll').change(function(){
		if($(this).is(':checked')){
			$('#fixedDrag').prop('checked', false);
            $('#resizableSelector').prop('checked', false);
        }
	});
    $('#resizableSelector').change(function(){
        if($(this).is(':checked')){
            $('#fixedDrag').prop('checked', false);
            $('#dragAll').prop('checked', false);
        }
    });
	
	/*
	function drag(ev, el) {
		
		ev.dataTransfer.setData("text", ev.target.id);
		//console.log(el.attr('jid'));
		
		// EDITED
		let jid = el.attr('jid');

		if($('#fixedDrag').is(':checked')){
			let all = $('.j'+jid+'[jid="'+jid+'"]');
			let thisIndex = all.index(el);
			
			el.on('dragstop', ()=>{
				console.log('QQQQQQQQQQQQQQQQQQQQQQQQQ');
			});
			
			let toDragObjects = [];
			for(let i = thisIndex; i < all.length; i++){
				toDragObjects.push(all.eq(i));
			}
			console.log(toDragObjects);
			//console.log(thisIndex);
			let offset = el.offset();
			//console.log(offset.left);
			toDragObjects.each(function(){
				let currObj = $(this);
				currObj.on('dragstop', (event)=>{
					console.log($(this));
				});
			});
		}

		if($('#dragAll').is(':checked')){
			
		}
		
	  
	  
	}
	*/
    
	/*
	function drop(ev, el) {
        
        //let unique = el.attr('class');
        //let uniqueCount = $('[data-jid="'+unique+'"]').length;
        //console.log(unique);

	  ev.preventDefault();
	  //console.log(ev.dataTransfer);
		var data = ev.dataTransfer.getData("text");
		  //console.log("data"+data);
		  ev.target.appendChild(document.getElementById(data));
		  //jobEvent();  

	  
	}
	*/
function dragEvent() {
	
}
</script>

<script>
  $( function() {
		
	  var secilen;
	  function badge(html) { 
		  return '<div class="badge job badge-pill badge-success">'+html+'</div>';
	  }
	  var url="?ajax=sap-planning-drag-table<?php if(getisset("w")) echo "&w={$_GET['w']}"; ?>";
	  <?php if(getisset("process")) { ?>
	  url="?ajax=sap-planning-drag-table<?php if(getisset("w")) echo "&w={$_GET['w']}"; ?>";
	  <?php } ?>
	  $(".plan-ajax").html("<?php echo e(e2("Loading...")); ?>").load(url,function(){
		 
		  loader();
		  window.setTimeout(function(){
			 blockTrigger(); 
		  },500);
		  
		  
		  /*
			$("#sap-detail .job").draggable({
				stop:function(){
					//console.log($(this).html());
					secilen = badge($(this).html());
				}
				
			});
			*/
			/*
			$( ".job" ).resizable({
			 // grid: 64
			 stop : function(){
				 var boyut = Math.round($(this).width()/$(this).parent().width());
				 $(this).css("width","calc((100% * "+boyut+") + (1px * "+boyut+") )"); 
				//console.log(boyut); 
			 },
			 containment: ".planning-board"
			}).draggable()
			*/
			/*
			var x = window.setInterval(function(){
				jobEvent();
			},1000);
			*/
			
			
	  });
	  //<div class="badge job badge-pill badge-success">test</div>
	  /*
	  $(".vardiya").droppable({
      drop: function( event, ui ) {
		  $(this).html(secilen);
        //console.log($(this).attr("workstation"));
        //console.log($(this).attr("machine"));
        //console.log($(this).attr("date"));
        //console.log($(this).attr("vardiya"));
        //console.log(ui);
      }
    });
	
    $( ".job" ).resizable({
      grid: 25
    });
	*/
	
//	$(".week-number").tooltip();
	$(".vardiya").unbind();
	$(".vardiya").on("click",function(){
		
		if($(this).html()=="") {
			$(this).html('<div class="block-zone"></div>');
			blockTrigger();
			saveIfProcess2();
		}
		
		
	});
	
	function blockTrigger(){
		//$(".planning-board *").unbind();
		
		$(".planning-board *").contextmenu(function(e){
			return false;
		});
		
		
		$(".block-zone").unbind();
		$(".block-zone").on("click",function(e){
			if($(this).html()=="") {
				$(this).html('<textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>');
				
			}
			
		}).mousedown(function(e){
			if(e.button==2) {
				$(this).remove();
				saveIfProcess2();
				return false;
			}
		})
		$(".block-zone textarea").unbind();
		$(".block-zone textarea").on("keyup",function(){
			 $(this).html($(this).val()); 
		  }).on("dblclick",function(){
			  $(this).remove();
		  });
	}
	window.setInterval(function(){
		// blockTrigger(); 
		jobEvent();
		$('.job.fill').attr('ondragstart','drag(event,$(this))');
		$('.job.fill').attr('ondragend','scrollFinish()');
	  },1000);
  } );
  
  </script>
<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/planning/inc/script.blade.php ENDPATH**/ ?>