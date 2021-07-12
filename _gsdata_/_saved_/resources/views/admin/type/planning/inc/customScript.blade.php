<script type="text/javascript">

    function px(val){
        return val + 'px';
    }
    function unpx(val){
        return pint(val.replace('px',''));
    }

    function plTr(){
        return $('.planning-board > tbody > tr');
    }

    function firstPlTr(){
        return $('.planning-board > tbody > tr:fisrt');
    }

    

    $('.scroll-to-left').css({
        //height : px(Math.floor($(window).height() / 2)),
        //top: px(Math.floor($(window).height() / 4)),
        left: '50px'
    });
    


	function setFlasher(startShift, endShift){
		let start = startShift.offset();
		let finish = endShift.offset();
		let width = finish.left + endShift.width() - start.left + 20;
		let height = startShift.height() + 20;
		$('<div id="shiftFlasher" style="position:absolute; border: 2px dashed #f00; top: '+(start.top-10)+'px; left: '+(start.left-10)+'px; width: '+width+'px; height:'+height+'px;"></div>').appendTo($('body'));
		setTimeout(()=>{
			$('#shiftFlasher').fadeOut(400, function(){
				removeFlasher();
			});
		}, 1500);
    }
    
	function removeFlasher(){
		$('#shiftFlasher').remove();
	}
	
	function removePopover(){
		$('.popover').remove();
	}

    function con(...args){
        for(let i = 0; i < args.length; i++){
            console.log(args[i]);
        }
    }
    
	function checkIntersection(shifts){
		let ret = true;
		for(let i = 0; i < shifts.length; i++){
			
			if(shifts[i].html() != ""){
				//console.log(shifts[i].children());
				let alt = shifts[i].find('>div')
				if(alt.hasClass('block-zone'))
					ret = "block-zone";
				else if(alt.hasClass('down'))
					ret = "down";
				else if(alt.hasClass('setup'))
					ret = "setup";
				else if(alt.hasClass('job'))
					ret = "job";
				else 
					ret = false;
				break;
			}
		}
		return ret;
	}
	
	function getIntersections(shifts){
		let ret = [];
		for(let i = 0; i < shifts.length; i++){
			
			if(shifts[i].html() != ""){
				ret.push(i);
			}
		}
        if(ret.length > 0)
            return ret;
        else
            return false;
    }
    

    function putIntersecteds(allShifts, e, element){
        //console.log(allShifts[e]);
        if($(allShifts[e]).html() != ""){
            putIntersecteds(e+1);
        } else{
            appendToAndRemove(element, allShifts[e]);
            return e+1;
        }
    }

    function getAvailableShift(allShifts, e){
        if($(allShifts).length < e){
            return false;
            //console.log("BÜYÜK");
        }
        else if($(allShifts).eq(e).html() != ''){
            return getAvailableShift(allShifts, parseInt(e)+1);
            //console.log(e + ' baktım');
        } else{
            //console.log('TAMAM');
            return e;
        }

    }

    function getAvailableShift2(allShifts, e, whatIsIt=false, draggedElement=false){
        if($(allShifts).length < e){
            return false;
            //console.log("BÜYÜK");
        }
        else if($(allShifts).eq(e).html() != ''){
            if(whatIsIt == 'fixedDrag'){
                if($(allShifts).eq(e).find('>div').hasClass(draggedElement)){
                    //console.log('YES: ' + e);
                    return getAvailableShift2(allShifts, pint(e) + 1, whatIsIt, draggedElement);
                    
                } else if($(allShifts).eq(e).html() != ""){
                    
                    return getAvailableShift2(allShifts, pint(e) + 1, whatIsIt, draggedElement);
                } else{
                    con(draggedElement + ' ' + e);
                    return e;
                }
            } else if(whatIsIt == 'dragAll'){
                /*
                if($(allShifts).eq(e).find('>div').hasClass('job')){
                    return e;
                }
                else{
                    return getAvailableShift2(allShifts, parseInt(e)+1, whatIsIt, draggedElement);
                }
                */
               
                if($(allShifts).eq(e).find('>div').hasClass('job')){
                    return getAvailableShift2(allShifts, pint(e) + 1, whatIsIt, draggedElement);
                } else if($(allShifts).eq(e).html() != ''){
                    return getAvailableShift2(allShifts, pint(e) + 1, whatIsIt, draggedElement);
                } else {
                    return e;
                }
            }
            
           
            //console.log(e + ' baktım');
        } else{
            //console.log('TAMAM');
            return e;
        }
    }
	
	function nextShift(shift){
		let all = $('.vardiya');
		let index = all.index(shift);
		return all.eq(index+1);
	}
	function prevShift(shift){
		let all = $('.vardiya');
		let index = all.index(shift);
		return all.eq(index-1);
	}

    function pint(val){
		return parseInt(val);
	}
	
	function appendToAndRemove(el, toAppend){
		let obj = el.clone();
		el.remove();
		obj.appendTo(toAppend);
	}

    function scrollFinish(){
        $('.scroll-to').hide();
    }

    window.scrLeft = 0;

    $('.table-responsive').on('scroll',function(){ 
        let pl = $('.planning-board').position();
        window.scrLeft = (pl.left - 15) * -1;    
    });
    
    function scrollToLeft(){
        let plBoard = $('.planning-board').width();
        let toScroll;
        if(window.scrLeft - 350 < 0)
            toScroll = 0;
        else
            toScroll = window.scrLeft - 350;

        if(window.scrLeft < 0){
            window.scrLeft = 0;
        } else{
            $('.table-responsive').scrollLeft(toScroll);
        }
    }

    function scrollToRight(){
        let plBoard = $('.planning-board').width();
        let toScroll;
        if(window.scrLeft + 350 > $('.planning-board').width())
            toScroll = $('.planning-board').width();
        else
            toScroll = window.scrLeft + 350;

        if(window.scrLeft > $('.planning-board').width()){
            window.scrLeft = $('.planning-board').width();
        } else{
            $('.table-responsive').scrollLeft(toScroll);
        }
    }

    
    window.leftCheck = false;
    $('.scroll-to-left').on('dragover',function(){
        
        if(!window.leftCheck){
            window.leftCheck = true;
            window.timer = setTimeout(()=>{
                scrollToLeft();
                window.leftCheck = false;
            },650);
        }
    });

    $('.scroll-to-left').on('dragleave',function(){ 
        clearTimeout(window.timer);
        window.leftCheck = false;
    });

    
    window.rightCheck = false;
    $('.scroll-to-right').on('dragover',function(){
        
        if(!window.rightCheck){
            window.rightCheck = true;
            window.timer = setTimeout(()=>{
                scrollToRight();
                window.rightCheck = false;
            },650);
        }
    });

    $('.scroll-to-right').on('dragleave',function(){ 
        clearTimeout(window.timer);
        window.rightCheck = false;
    });
    
	
	function drag(ev, el) {
		
        if($('#scrollNavigation').is(':checked')){
            $('.scroll-to').show();
        }
        
		//console.log(ev.pageX);
        //$(document).bind("mouseup", endDragging);
		//console.log(el.attr('jid'));
		
		removePopover();

		if($('#fixedDrag').is(':checked')){
			
			
			let jid = el.attr('jid');
			let all = $('.j'+jid+'[jid="'+jid+'"]');
			let thisIndex = all.index(el);
			
			let oldPositions = [];
			all.each(function(index){
				let pos = $(this).offset();
				oldPositions.push(pos.left);
			});
			
			ev.dataTransfer.setData("text/html", ev.target.getAttribute('jid') + ';' + thisIndex);
			ev.dataTransfer.setData("oldPositions", oldPositions);
			
			let toDragObjects = [];
			for(let i = thisIndex; i < all.length; i++){
				toDragObjects.push(all.eq(i));
			}
			
			setFlasher(all.eq(0), all.eq(all.length - 1));
			
			let offset = el.offset();
			//console.log(offset.left);
			
		}

		if($('#dragAll').is(':checked')){
			
            let allJobs = el.parents('.planning-board > tbody > tr').find('.job.fill');
            let allJobsIndex = $('.planning-board > tbody > tr').index(el.parents('.planning-board > tbody > tr'));
            let par = el.parents('.planning-board > tbody > tr');
           
            let thisIndex = allJobs.index(el);

            let toRightJobs = par.find('.job.fill').slice(thisIndex, allJobs.length);

            


            let elParentIndex = allJobsIndex;
            let elIndex = thisIndex;
            let allJobsLength = allJobs.length;
            ev.dataTransfer.setData('text/html', elParentIndex + ';' + elIndex + ';' + allJobsLength);
            setFlasher(allJobs.eq(thisIndex), allJobs.eq(allJobs.length - 1));

		}
		
	  
	  
	}
	
	
	
	
	function drop(ev, target) {
        ev.preventDefault();
        //let unique = el.attr('class');
        //let uniqueCount = $('[data-jid="'+unique+'"]').length;
        //console.log(unique);

		
		//console.log(ev.dataTransfer);
		
        
		
		//console.log("data"+data);
		//ev.target.appendChild(document.getElementById(data));
		//console.log('data: ' + data);
		
		//console.log(data);
		//jobEvent();  
		
		if($('#fixedDrag').is(':checked')){
            
			
			let data = ev.dataTransfer.getData("text/html");
			let oldPositions = ev.dataTransfer.getData('oldPositions');
			data = data.split(';');
			var toDragObjects = $('.j' + data[0]);
			let draggedIndex = parseInt(data[1]);
			let draggedIndexes = [];
			for(let i = 0 - draggedIndex; i < draggedIndex; i++){
				draggedIndexes.push(i);
			}
			
			//console.log(draggedIndexes);
			
			
			let allShiftsA = target.attr('workstation');
			// -- allShifts = $('.vardiya[workstation="'+allShiftsA+'"]');
            allShifts = $('.vardiya[workstation="'+allShiftsA+'"]');
			let shiftIndex = parseInt(allShifts.index(target));
            let wholeShifts = [];
            for(let i = 0; i < allShifts.length; i++){
                wholeShifts.push(allShifts.eq(i));
            }
			
			
			let processedShifts = [];
			for(let i = 0; i < toDragObjects.length; i++){
				processedShifts.push(allShifts.eq(pint(shiftIndex) - pint(draggedIndex) + i));
			}
			
			removeFlasher();
			
			let intersection = checkIntersection(processedShifts);
			//console.log(intersection);
            //let con = getAvailableShift('.vardiya[workstation="'+allShiftsA+'"]', 3);
            
            
			
			if(allShifts.length >= toDragObjects.length && pint(shiftIndex) - pint(draggedIndex) >= 0){
				if(!$('#skipIntersections').is(':checked') && intersection){ 
                    
					//before
					for(let i = 0; i < toDragObjects.length; i++){
						//let currIndex = pint(draggedIndex) + pint(draggedIndexes[i]);
						let currIndex = i;
						appendToAndRemove(toDragObjects.eq(currIndex), allShifts.eq(pint(shiftIndex) - pint(draggedIndex) + i));
						//console.log('toDragIndex: ' + i);
						//console.log('shiftIndex: ' + (pint(shiftIndex) - pint(draggedIndex) + i));
					}
                    con('A');
				} else if($('#skipIntersections').is(':checked') && intersection != true){
                    let toObjs = toDragObjects.clone();
                    toDragObjects.remove();
                    //console.log(con);
					for(let i = 0; i < toDragObjects.length; i++){
                        //eq = putIntersecteds(wholeShifts, eq, toDragObjects.eq(i));
                        let available = getAvailableShift2('.vardiya[workstation="'+allShiftsA+'"]', pint(shiftIndex) - pint(draggedIndex) + i, 'fixedDrag','j' + data[0]);
                        //con(available);
                        appendToAndRemove(toObjs.eq(i), allShifts.eq(available));
                    }
                    con('B');
				} else{
                    for(let i = 0; i < toDragObjects.length; i++){
						//let currIndex = pint(draggedIndex) + pint(draggedIndexes[i]);
						let currIndex = i;
						appendToAndRemove(toDragObjects.eq(currIndex), allShifts.eq(pint(shiftIndex) - pint(draggedIndex) + i));
						//console.log('toDragIndex: ' + i);
						//console.log('shiftIndex: ' + (pint(shiftIndex) - pint(draggedIndex) + i));
					}
                    con('C');
                }
				
            } else{
                // con('BAYA BAYA');
            }
			
			
			
		} else if($('#dragAll').is(':checked')){
            
            let data = ev.dataTransfer.getData('text/html');
            data = data.split(';');
            //let allJobs = $('.planning-board > tbody > tr').eq(thisIndex);
            let toDragObjects = $('.planning-board > tbody > tr').eq(pint(data[0])).find('.job.fill').slice(pint(data[1]), data[2]);
            
            let elIndex = pint(data[1]);
            let elParentIndex = pint(data[0]);
            let allJobsLength = pint(data[2]);
            
            removeFlasher();

            let allShiftsA = target.attr('workstation');
            let allShifts = $('.vardiya[workstation="'+allShiftsA+'"]');
            let shiftIndex = pint(allShifts.index(target));

            let processedShifts = [];
            for(let i = 0; i < toDragObjects.length; i++){
                processedShifts.push(allShifts.eq(pint(shiftIndex) - pint(elIndex) + i));
            }

            let intersection = checkIntersection(processedShifts);
            
            if(allShifts.length >= toDragObjects.length && pint(shiftIndex) - pint(elIndex) >= 0){
                if(!$('#skipIntersections').is(':checked') && intersection){
                    for(let i = 0; i < toDragObjects.length; i++){
						appendToAndRemove(toDragObjects.eq(i), allShifts.eq(pint(shiftIndex) - pint(elIndex) + i));
					}
                    con('A');
                } else if($('#skipIntersections').is(':checked') && intersection != true){
                    let toObjs = toDragObjects.clone();
                    toDragObjects.remove();
                    for(let i = 0; i < toObjs.length; i++){
                        let available = getAvailableShift2('.vardiya[workstation="'+allShiftsA+'"]', pint(shiftIndex) - pint(elIndex) + i, 'dragAll');
                        appendToAndRemove(toObjs.eq(i), allShifts.eq(available));
                    }
                    con('B');
                } else{
                    let toObjs = toDragObjects.clone();
                    toDragObjects.remove();
                    for(let i = 0; i < toObjs.length; i++){
                        con('shift Index: ' + shiftIndex + ' - ' + 'Element Index: ' + elIndex + ' - i: ' + i);
						appendToAndRemove(toObjs.eq(i), allShifts.eq(pint(shiftIndex) /*- pint(elIndex)*/ + i));
					}
                    con('C');
                }
            } else {}

        } 
		

	  
	}
</script>