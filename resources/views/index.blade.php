

<!DOCTYPE html>
<html lang="tr" >

<head>

  <meta charset="UTF-8">



  <title>Holysis</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
<script>document.addEventListener("touchstart", function(){}, true);</script> 
  
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css'>
  
<style>
   header img {
    height:100%;
  }
  header {
    position:fixed;
    top:0px;
    left:0px;
    width:100%;
    height:60px;
    background:#fff;
    z-index:1000;
    padding:10px;
  }
body {
  background: #fff;
  color: #000;
}


@keyframes fadeIn {
  from {top: 20%; opacity: 0;}
  to {top: 100; opacity: 1;}
  
}

@-webkit-keyframes fadeIn {
  from {top: 20%; opacity: 0;}
  to {top: 100; opacity: 1;}
  
}

.wrapper {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  animation: fadeIn 1000ms ease;
  -webkit-animation: fadeIn 1000ms ease;
  
}

h1 {
  font-size: 50px;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 0;
  line-height: 1;
  font-weight: 700;
}

.dot {
  color: #4FEBFE;
}

p {
  text-align: center;
  margin: 18px;
  font-family: 'Muli', sans-serif;
  font-weight: normal;
  
}

.icons {
  text-align: center;
  
}

.icons i {
  color: #00091B;
  background: #fff;
  height: 15px;
  width: 15px;
  padding: 13px;
  margin: 0 10px;
  border-radius: 50px;
  border: 2px solid #fff;
  transition: all 200ms ease;
  text-decoration: none;
  position: relative;
}

.icons i:hover, .icons i:active {
  color: #fff;
  background: none;
  cursor: pointer !important;
  transform: scale(1.2);
  -webkit-transform: scale(1.2);
  text-decoration: none;
  
}
</style>



</head>

<body translate="no" >
  <header>
    <img src="assets/img/logo.svg" style="height:100%;" alt="">
  </header>
  


  @include("admin.index")

  
  
  

</body>
<style>
 
  #map {
    position:fixed !important;
    top:0px!important;
    left:0px!important;
    width:100%!important;
    height:100%!important;
  }
  @media screen and (max-width:768px) {
    .alert {
      font-size:14px;
    }
    #directions {
      position:fixed;
      bottom:0px !important;
      left:0px;
      width:100%;
      height:30%;
      overflow:auto;
      top:initial !important;


    }
    .yenile {
      top: 12px !important;
    z-index: 10000;
    }
  }

</style>
</html>
 
