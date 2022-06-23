<?php
session_start();
error_reporting(0);
include('processor/get_processor.php');
$newsfeed=$obj->newsfeed();
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TTN | Tours & Travels News</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<body>
 <?php include('includes/header.php');?>
<div class="banner">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TTN - Tours & Travels News</h1>
	</div>
	
</div>

<!-- newsfeed started -->
<?php foreach ($newsfeed as $key => $value) { ?>
<div class="bg-secondary py-2">
<div class="container bg-black rounded py-3">
	<div class="row text-white">
		<div class="col-12">
	  	<h4 class="pb-1"><i class="fa-solid fa-user"></i><span class="mx-2"><?php echo $value->FullName; ?></span></h4>
	  	<p><?php echo $value->title; ?></p>
	  <img src="images/<?php echo $value->photos; ?>" width="100%" class="figure-img img-fluid rounded" alt="...">
	  <form>
	  	<div class="input-group">
        <input type="text" class="form-control" placeholder="Your comment about picture" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Comment</button>
        </div>
	  </form>
		</div>
	</div>
	</div>
</div>
<?php } ?>

<!-- newsfeed end -->
<?php include('includes/footer.php');?>
<!-- write us -->
<?php include('includes/write-us.php');?>			
<!-- //write us -->
</body>
</html>