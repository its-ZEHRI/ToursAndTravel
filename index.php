<?php
session_name('travel');
session_start();
include('processor/get_processor.php');
$posts = $obj->getPosts();
$packages  = $package_obj->get_packages();

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
	<!--animate-->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">

	<style>
		.news-fixed {
			position: fixed;
			right: 0;
			top: 4.5rem
		}

		.prfile-fixed {
			position: fixed;
			left: 0;
			top: 4.5rem
		}

		.sidebar-menu {
			display: flex;
			flex-direction: column;
		}

		.parent {
			box-shadow: inset 0px 0px 8px 1px rgba(67, 133, 175, 0.5);
		}

		.sidebar-menu a {
			border-radius: 5px;
			padding: 10px;
			padding-left: 20px;
			text-decoration: none;
			margin-bottom: 10px;
			color: #000;
			background-color: rgba(255, 255, 255, 0.3);
			transition: .3s !important;
		}

		.sidebar-menu a:hover {
			color: #fff;
			background-color: rgba(0, 0, 0, 0.2);
			/* background: rgb(67, 133, 175); */
			/* background: linear-gradient(150deg, rgba(67, 133, 175, 0.5) 21%, rgba(59, 172, 29, 0.1) 91%); */


		}

		.sidebar {
			/* box-shadow:  0px 0px 3px 1px rgba(67, 133, 175, 0.5); */
			/* box-shadow:  0px 0px 3px 1px rgba(0,0,0,0.3); */
			height: 85vh;
			background: rgb(67, 133, 175);
			background: linear-gradient(150deg, rgba(67, 133, 175, 0.3) 21%, rgba(59, 172, 29, 0.1) 91%);
		}
	</style>

</head>

<body>
	<?php include('includes/header.php'); ?>

	<main class="container-fluid">

		<div id="posts" class="row" style="margin-top: 5rem;">
			<div id="column" class="col-md-3 d-none"></div>

			<!-- left side -->
			<div id="profile_side" class="col-md-3">
				<div class="border  sidebar">
					<?php
					if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) { ?>
						<!-- user logged in sidebar -->
						<a href="myprofile.php" style="text-decoration: none;">
						<div class="d-flex align-items-center p-3">
							<img src="images/<?php if ($_SESSION['image'] == null) echo "noimage.png";
												else echo $_SESSION['image'] ?>" width="70px" height="70px" style="object-fit:cover;" class="rounded-circle align-self-" alt="">
							<h3 class="ms-3 mt-2 "><?php echo $_SESSION['user_name']; ?></h3>
						</div>
						</a>
						<hr>
						<div class="p-2 sidebar-menu">
							<a href="myprofile.php">Profile</a>
							<a href="mybooking.php">Booking</a>
							<a href="#">Post</a>
							<a href="#">Gallery</a>
						</div>
					<?php

					} else { ?>

						<!-- Guest sidebar -->
						<h1>guest</h1>


					<?php } ?>
				</div>
			</div>

			<!-- post -->
			<div class="col-md-6">
				<!-- wrap in loop -->
				<?php foreach ($posts as $key => $value) {  ?>
					<div id='parent' class="p-3 mb-3 parent">
						
						<!-- user info -->
						<div class="d-flex align-items-center position-relative">
							<img src="images/<?php if ($value->image == null) echo "noimage.png";
												else echo $value->image ?>" width="50px" height="50px" style="object-fit:cover;" class="rounded-circle align-self-" alt="">
							<div class="ms-2">
								<h3 class="m-0"><?php echo $value->FullName ?></h3>
							</div>
							<?php if (isset($_SESSION['id']) && $_SESSION['id'] != $value->user_id) { ?>
								<span id="report_icon" style="position:absolute; right:0; top:0; cursor:pointer" class="report_icon fa-solid fa-ellipsis-vertical"></span>
								<div class="report_div">
									<form id="report_form" class="border d-none" style="position:absolute; right:20px; top:-5px;">
										<input type="hidden" name="post_id" class="post_id" value="<?php echo $value->id ?>">
										<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" class="user_id">
										<input type="submit" class="" style="border: none; outline:none" value="Report">
									</form>
								</div>
							<?php } ?>
						</div>
						<!-- Description -->
						<div class="px-3 mt-3">
							<p class="m-0 mb-2"><?php echo $value->description; ?></p>
						</div>
						<!-- Image -->
						<div class="m-0">
							<img src="images/<?php echo $value->p_image; ?>" width="100%" alt="">
						</div>
						<!-- comments -->
						<div class="d-flex align-items-center p-2">
							<?php if (isset($_SESSION['id'])) { ?>
								<img src="images/<?php if ($_SESSION['image'] == null) echo "noimage.png";
													else echo $_SESSION['image'] ?>" width="40px" height="40px" class="rounded-circle align-self-" alt="">
								<form id="comments_form" class="w-100 ms-3">
									<span class="d-none"></span>
									<div class="d-flex">
										<input type="hidden" name="post_id" value="<?php echo $value->id; ?>" id="post_id">
										<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" id="user_id">
										<input type="text" id="comment_field" name="comment" value="" autocomplete="off" class="form-control comment-field" placeholder="something...!">
										<input type="submit" class="btn btn-sm btn-primary" value="Comment">
									</div>
								</form>
								<div class="likes_div">
									<!-- likes -->
									<?php $AuthUserLike = $likeobj->getAuthUserLikes($_SESSION['id'], $value->id);
									if ($AuthUserLike == 0) { ?>
										<form id="like_form" class="ms-3 like-form">

											<input type="hidden" name="post_id" value="<?php echo $value->id; ?>" class="post_id">
											<input type="hidden" name="user_id" class="user_id" value="<?php echo $_SESSION['id']; ?>">
											<button type="submit" class="btn p-0 like-btn text-danger">
												<i class="fa-regular fa-heart "></i></button>
										</form>
									<?php } else { ?>
										<form id="unlike_form" class="ms-3 unlike-form">
											<span class="unlike"></span>
											<input type="hidden" name="post_id" value="<?php echo $value->id; ?>" class="post_id">
											<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>" class="user_id">
											<button type="submit" class="btn p-0 like-btn text-danger">
												<i class="fa-solid fa-heart unlike"></i></button>
										</form>
									<?php } ?>

								</div>
								<!-- SHOW LIKES -->
								<?php $postlikes = $likeobj->getSinglePostLikes($value->id) ?>
								<span class="d-flex show_likes">
									<span class="ms-2 me-1"><?php echo $postlikes; ?></span>
									<span><?php echo ($postlikes == 1) ? "like" :  "likes"; ?></span>
								</span>

							<?php } ?>
						</div>
						<hr>
						<!-- post comments -->
						<span class="text-muted mb-2 d-block">Comments</span>
						<div class="borde" style="max-height: 10rem; overflow:auto">
							<?php $comments = $obj->getComments($value->id) ?>
							<div id="show_comments">
								<?php foreach ($comments as $key => $value) { ?>
									<div class="px-5 d-flex align-items-center">
										<img src="images/<?php if ($value->image == null) echo "noimage.png";
															else echo $value->image ?>" width="35px" height="35px" class="rounded-circle align-self-start" alt="">
										<div class="ms-2">
											<h6 class="m-0 mt-1"><?php echo $value->FullName ?></h6>
											<!-- <span class="m-0 text-secondary" style="font-size: 13px;"> <?php echo $value->created_at; ?></span> -->
											<p style="line-height: 18px;" class="text-secondary "><?php echo $value->comment ?></p>
										</div>
									</div>
								<?php 	} ?>
							</div>
						</div>
					</div>
				<?php } ?>

				<!-- wrap in loop end -->

			</div>

			<!-- right side -->

			<div id="news_side" class="col-md-3">
				<div class="" style="height:90vh; overflow: auto;">
					<?php
					foreach ($packages as $key => $package) { ?>

						<div class="mb-3">
							<div class="card" style="width: 18rem;">
								<img class="card-img-top" src="images/<?php echo $package->PackageImage ?>" alt="Card image cap">
								<div class="card-body pb-0 mb-0">
									<h5 class="card-title"><?php echo $package->PackageName ?></h5>
									<div class="mb-3">
										<p class="m-0 text-muted">Package Type</p>
										<p class="m-0 card-text"><?php echo $package->PackageType ?></p>
									</div>
									<div class="mb-3">
										<p class="m-0 text-muted">Package Location</p>
										<p class="m-0 card-text"><?php echo $package->PackageLocation ?></p>
									</div>
									<div>
										<p class="m-0 text-muted">Package Features</p>
										<p class="m-0 card-text"><?php echo $package->PackageFetures ?></p>
									</div>
								</div>

								<div class="card-body text-end">
									<a href="package-details.php?id=<?php echo $package->PackageId; ?>" class="btn btn-sm btn-info">Details</a>
								</div>
							</div>
						</div>

					<?php } ?>
				</div>
			</div>





		</div>




	</main>


	<!-- Custom Theme files -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script>
		$(document).ready(function() {

			// for fixed column of row
			$(window).scroll(function() {
				var height = $(window).scrollTop();
				if (height > 10) {
					$('#news_side').addClass('news-fixed')
					$('#profile_side').addClass('prfile-fixed')
					$('#column').removeClass('d-none')
				} else {
					$('#news_side').removeClass('news-fixed')
					$('#profile_side').removeClass('prfile-fixed')
					$('#column').addClass('d-none')

				}
			});

			$(this).on('click', '#report_icon', function() {
				$('#report_form').toggleClass('d-none');
			});

			$(this).on('submit','#report_form',function(event){
				event.preventDefault();
				var formdata = new FormData(this);
				formdata.append('op','reportPost');
				var parent = $(this).parentsUntil('parent');
				$.ajax({
					type: 'post',
					url: "processor/ajax_processor.php",
					data: formdata,
					cache: false,
					contentType: false,
					processData: false,
					success: function (response) {
						if(response == 'ok')
							// alert('done');
							// parent.find('#report_icon').addClass('d-none');
							parent.find('#report_form').addClass('d-none');
					}
				});
			});

			// ----
			// SUBMIT COMMENTS FORM
			$(this).on('submit', '#comments_form', function(event) {
				event.preventDefault();
				$(this).closest('.parent').find('#show_comments').addClass('check')
				$(this).find('span').attr('id', 'check')
				var formdata = new FormData(this);
				formdata.append('op', 'add_comment');
				var post_id = $(this).find("#post_id").val();
				$.ajax({
					type: "POST",
					url: "processor/ajax_processor.php",
					data: formdata,
					cache: false,
					contentType: false,
					processData: false,

					success: function(response) {
						if (response == 'ok') {
							$(".comment-field").val('');
							getComments(post_id);
						} else
							alert(response);
					},
					error: function(error) {
						alert('error occure');
					}
				});
			});

			// SUBMIT LIKE FORM 
			$(this).on('submit', '.like-form', function(event) {
				event.preventDefault();
				$(this).closest('.parent').find('.show_likes').addClass('check')
				$(this).find('span').attr('id', 'check')
				var formdata = new FormData(this);
				formdata.append('op', 'likePost');
				var post_id = $(this).find(".post_id").val();
				var user_id = $(this).find(".user_id").val();
				// var post_id = $('#like_form .post_id').val();
				// var user_id = $("#like_form .user_id").val();

				$.ajax({
					type: "POST",
					url: "processor/ajax_processor.php",
					data: formdata,
					cache: false,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response == "ok") {
							getPostLikes(post_id, user_id);
							post_id = '';
							user_id = ''
						} else {
							console.log(response);
							alert(response);
						}
					},
					error: function(error) {
						alert(error);
					}
				});

			});

			// SUBMIT UNLIKE FORM
			$(this).on('submit', '.unlike-form', function(event) {
				event.preventDefault();
				$(this).closest('.parent').find('.show_likes').addClass('check')
				$(this).find('span').attr('id', 'check')
				var formdata = new FormData(this);
				formdata.append('op', 'unlikePost');
				var post_id = $(this).find(".post_id").val();
				var user_id = $(this).find(".user_id").val();

				$.ajax({
					type: "POST",
					url: "processor/ajax_processor.php",
					data: formdata,
					cache: false,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response == 'ok')
							getPostUnLikes(post_id, user_id);
						else {
							console.log(response)
							alert(response);
						}
					},
					error: function(error) {
						alert(error);
					}
				});
			});
		}); //end of ready

		//GET SINGLE POST LIKES WHEN THE POST IS LIKED
		function getPostLikes(post_id, user_id) {

			$.ajax({
				type: "POST",
				url: "processor/ajax_processor.php",
				data: {
					op: 'getSinglePostLikes',
					post_id: post_id
				},
				success: function(response) {

					$('.check').html('');
					$('.check').append('<span class="ms-2 me-1">' + response + '</span>\
                            <span>' + (response == 1 ? "like" : 'likes') + '</span>');

					var $post = $('.check').parentsUntil('.parent');
					var $div = $post.find('.likes_div');
					$div.html('');
					$div.append('<form id="unlike_form" class="ms-3  unlike-form">\
                                <span class="unlike"></span>\
                                <input type="hidden" name="post_id" class="post_id" value="' + post_id + '">\
                                <input type="hidden" name="user_id" class="user_id" value="' + user_id + '">\
                                <button type="submit" class="btn p-0 like-btn text-danger">\
                                    <i class="fa-solid fa-heart unlike"></i></button>\
                            </form>');
				}
			});
			setTimeout(function() {
				$(".check").removeClass('check');

			}, 2000);
		}

		// GET SINGLE POST LIKE WHEN THE POST IS UNLICKED
		function getPostUnLikes(post_id, user_id) {
			$.ajax({
				type: "POST",
				url: "processor/ajax_processor.php",
				data: {
					op: 'getSinglePostLikes',
					post_id: post_id
				},
				success: function(response) {
					$('.check').html('');
					$('.check').append('<span class="ms-2 me-1">' + response + '</span>\
                                    <span>' + (response == 1 ? "like" : 'likes') + '</span>');

					var $post = $('.check').parentsUntil('.parent');
					var $div = $post.find('.likes_div');
					$div.html('');
					$div.append('<form id="like_form" class="ms-3  like-form">\
                                    <span class="unlike"></span>\
                                    <input type="hidden" name="post_id" class="post_id" value="' + post_id + '">\
                                    <input type="hidden" name="user_id" class="user_id" value="' + user_id + '">\
                                    <button type="submit" class="btn p-0 like-btn text-danger">\
                                    <i class="fa-regular fa-heart unlike"></i></button>\
                        </form>');
				}
			});
			setTimeout(function() {
				$(".check").removeClass('check');

			}, 500);
		}


		// GET SINGLE POST COMMENTS WHEN THE POST IS COMMENTED
		function getComments(post_id) {
			var daat = "";
			$.ajax({
				type: "POST",
				url: "processor/ajax_processor.php",
				data: {
					op: "getComments",
					post_id: post_id
				},
				success: function(response) {
					$('.check').html('');
					response = JSON.parse(response);
					console.log(response);
					$.each(response, function(key, item) {
						$('.check').append('<div class= "px-5 d-flex align-items-center">\
                                                <img src="images/' + (item.image == null ? 'noimage.png' : item.image) + '" width="35px" height="35px" class="rounded-circle align-self-start" alt="">\
                                                <div class="ms-2">\
                                                    <h6 class="m-0 mt-1">' + item.FullName + '</h6>\
                                                    <p style="line-height: 18px;" class="text-secondary ">' + item.comment + '</p>\
                                                </div>\
                                            </div>');
					});
					setTimeout(function() {
						$(".check").removeClass('check');

					}, 2000);
				},
				error: function(error) {
					alert(error);
				}

			}) //end of ajax
		}

		// ----
	</script>
	<script>
		new WOW().init();
	</script>


</body>

</html>