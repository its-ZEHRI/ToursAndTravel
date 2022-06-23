<?php
session_start();
error_reporting(0);
if(isset($_SESSION['login'])==true){
}else{
	header("location:includes/signin.php");
}
include('processor/get_processor.php');
if(isset($_POST['submit'])){
	$resp=$obj->add_user_profile();
	if($resp == "ok"){
    	header("location:myprofile.php");

}
}
if(isset($_POST['delete'])){
	$resp=$obj->delete_user_photo();
}
$user_profile=$obj->show_user_profile();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS  | Package List</title>
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
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- image magnifier start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- image magnifier end -->
<!--animate-->
<!-- hello i am commits -->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.gallerys').magnificPopup({
				type:'image',
				delegate:'a',
				mainClass: 'mfp-fade',

			      zoom: {
			    enabled: true, 
			    duration: 300,
			    easing: 'ease-in-out'
			},
			gallery:{
				enabled:true
			}
			});
		});
		 new WOW().init();
	</script>
<!--//end-animate-->
<style type="text/css">
	
</style>
</head>
<body>
<?php include('includes/header.php');?>



<!--- banner ---->
<div class="banner-3">

	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; text-transform: uppercase; color: #4DB321;">Welcome:<?php echo htmlentities($_SESSION['name']);  ?></h1>

	</div>

</div>

<!--- /banner ---->
<!--- rooms ---->
<div class="rooms">
	<div class="container">
		<div class="row">
			
	<div class="privacy">
	<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Upload Picture</h3>
		<form method="post">
			<p style="width: 350px;">

			<b>Title</b>  <input type="text" name="title" class="form-control" id="exampleInputTitle" placeholder="Title" required="">
			</p>

			<p style="width: 350px;">
			<b>Picture</b>
			<input type="file" class="form-control" name="picture" required="required">
			</p>

			<p style="width: 350px;">
			<input type="submit" name="submit" class="btn-primary btn">

			</p>
			</form>
</div>
</div>
</div>

       <!-- Gallery -->
  
  <div class="container">
  <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown; margin-bottom: 30px; color: #4DB321;">Gallery</h3>
   <div class="row gallerys">
   <?php foreach ($user_profile as $key => $value) { ?>
   	
   <div class="col-md-4">
   	<form method="post" action="myprofile.php">
  		<input type="hidden" name="userphoto" value="<?php echo $value->id; ?>">
          <button class="fa-solid fa-trash" type="submit" name="delete" style="position: relative; top: 40px; left: 10px;" onclick="return confirm('Are you sure you want to delete the record')"></button>
     </form>
    <div class="border bg-white mb-4">
    <a href="images/<?php echo $value->photos; ?>" style="text-decoration: none;">
    <img src="images/<?php echo $value->photos; ?>" class="img_fluid img-thumbnail" alt="image missing" width="100%">
    </a>
    <!-- <div class="caption mt-4 mb-4 text-center">
    <h4>Title</h4>
    <p style="color: #6C757D;"><?php echo $value->title; ?></p>
    </div> -->
    </div>
    </div>
   	<?php } ?>
    </div>

  </div>
</div>		
</div>
<!--- /rooms ---->

<!--- /footer-top ---->
<?php include('includes/footer.php');?>
<!-- write us -->
<?php include('includes/write-us.php');?>			
<!-- //write us -->
</body>
</html>