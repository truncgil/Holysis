
<canvas id="canvas" style="   
    border:solid 1px #f3b719;width:100%;margin-top:100px" ></canvas>
	<script>
		
        var animasyon;
           
            drawData("<?php echo e($data); ?>");
            
            function drawData(data) {
                cancelAnimationFrame(animasyon);
            //    console.log(data);
        
                var EcgData = data;
                var canvas = document.getElementById("canvas");

                var ctx = canvas.getContext("2d");
               
                ctx.canvas.width  = 300;
                ctx.canvas.height = 200;
                ctx.beginPath();
                var w = canvas.width,
                h = canvas.height,
                speed = 3,
                scanBarWidth = 20,
                i=0,
                data = EcgData.split(','),
                
                color='#f3b719';
                var px = 0;
                var opx = 0;
                var py = h/20;
                var opy = py;
                ctx.strokeStyle = color;
                ctx.lineWidth = 1;
                ctx.setTransform(1,0,0,-1,0,h/1.2);
                
                //console.log(data.length);
                drawWave();
                var rate;
                function drawWave() {
                    px += speed;
                    ctx.clearRect( px,0, scanBarWidth, h);
                    ctx.beginPath();
                    ctx.moveTo( opx,  opy);
                    ctx.lineJoin= 'round';
                    var veri = data[++i>=data.length? i=0 : i++];
                    
                //   if(veri<564 && veri>0) veri=550;
                //   console.log(veri);
                    py=(veri/20);
                    ctx.lineTo(px, py);
                    ctx.stroke();
                    opx = px;
                    opy = py;
                    
                    if (opx > w) {px = opx = -speed;}


                  animasyon =   requestAnimationFrame(drawWave);
                    //	 console.log(py);
                }
            }


	</script><?php /**PATH /home/sphyzer/app/resources/views/admin/inc/ekg-live.blade.php ENDPATH**/ ?>