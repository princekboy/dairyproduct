<?php include 'header.php'; 
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION['user_id'];
    $sql = $db_conn->prepare("SELECT user_id FROM users WHERE user_id = :user_id");
    $sql->bindParam(":user_id", $user_id, PDO::PARAM_STR);
    $sql->execute();
    if ($sql->rowCount() < 0) {
		$_SESSION['message'] = "Please login or register to access this page";
    	header("Location: ./");
    }
}else{
	$_SESSION['message'] = "Please login or register to access this page";
	header("Location: ./");
}
?>
<title>Settings | <?= SITE_NAME; ?></title>
<style>
    html,body, header, .jarallax {
        height: 80%;
    }

    @media (min-width: 560px) and (max-width: 740px) {
        html,body,header, .jarallax {
            height: 260px;
        }
    }

    @media (min-width: 800px) and (max-width: 850px) {
        html,body,header,.jarallax {
            height: 260px;
        }
    }
</style>
<?php if (isset($_SESSION["message"]) AND !empty($_SESSION['message']) AND $_SESSION['message'] == "Please login or register to access this page") { ?>
    <p class="alert alert-success col-md-4" id="info" data-mdb-position="top-right"><?= $_SESSION["message"]; ?></p>
<?php }else{ unset($_SESSION['message']); } ?>
<div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(./assets/images/bg-default.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="mask rgba-purple-slight" style="background-color: rgba(0, 0, 0, 0.7)">
        <div class="container h-100 d-flex align-items-left">
            <div class="row smooth-scroll py-5">
                <div class="col-md-12 text-white text-start">
                    <div class="wow fadeInDown py-5" data-wow-delay="0.2s">
                        <h3 class="display-6 font-weight-bold text-start">SETTINGS</h3>
                        <hr class="hr-light">
                        <h5 class="subtext-header mt-4 mb-3">Settings page</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<!--/Navigation & Intro-->
<main>
	<div class="card shadow-3 px-3 py-2 me-auto ms-auto">
		<ul class="nav nav-pills nav-fill mb-3" id="ex1" role="tablist">
			<li class="nav-item" role="presentation">
			 	<a class="nav-link active text-nowrap" id="ex3-tab-1" data-mdb-toggle="pill" href="#ex3-pills-1" role="tab" aria-controls="ex3-pills-1" aria-selected="true"><i class="fas fa-lock fa-fw me-2"></i> Change Password</a>
			</li>
			<li class="nav-item" role="presentation">
			    <a class="nav-link text-nowrap" id="ex3-tab-2" data-mdb-toggle="pill" href="#ex3-pills-2" role="tab" aria-controls="ex3-pills-2" aria-selected="false"><i class="fas fa-cogs fa-fw me-2"></i>Edit Profile</a>
			</li>
			<li class="nav-item" role="presentation">
			    <a class="nav-link text-nowrap" id="ex3-tab-3" data-mdb-toggle="pill" href="#ex3-pills-3" role="tab" aria-controls="ex3-pills-3" aria-selected="false"><i class="fas fa-user fa-fw me-2"></i>Profile</a>
			</li>
		</ul>
		<!-- Pills navs -->
		<!-- Pills content -->
		<div class="tab-content" id="ex2-content">
		  	<div class="tab-pane fade show active" id="ex3-pills-1" role="tabpanel" aria-labelledby="ex3-tab-1">
		  		<div class="mt-4">
		  			<div class="col-md-6 me-auto ms-auto">
		  				<h2 class="text-left font-weight-bold mb-1">Change Password</h2>
	    				<p class="grey-text text-left mt-1">Fill form to change your password </p>
		  				<form class="" method="POST" enctype="multipart/form-data" id="passForm">
				            <div class="form-outline mt-3 mb-5">
				                <i class="far fa-lock trailing"></i>
					            <input type="password" aria-label="Password" class="form-control form-icon-trailing" name="password" id="password">
				                <label class="form-label" for="password">Old Password</label>
				            </div>
				            <div class="form-outline mt-4 mb-5">
				                <i class="far fa-lock trailing"></i>
					            <input type="password" aria-label="Password" class="form-control form-icon-trailing" name="newpassword" id="newpassword">
				                <label class="form-label" for="newpassword">New Password</label>
				            </div>
				            <div class="form-outline mt-4 mb-2">
				                <i class="far fa-lock trailing"></i>
					            <input type="password" aria-label="Password" class="form-control form-icon-trailing" name="conpassword" id="conpassword">
				                <label class="form-label" for="conpassword">Confirm Password</label>
				            </div>
				            <span onclick="showPass()" style="cursor:pointer;" class="" id="passText"> Show password <span class="far fa-eye-slash"></span></span>
					            <p class="alert alert-success py-3 mt-3 text-center" id="errorpass">
					            	<span id="contntpass"></span>
								</p>
					            <div class="mb-4" align="center">
					                <button type="submit" id="chgPass" class="mt-4 py-2 btn btn-sm btn-success btn-rounded z-depth-2">Change Password</button>
				            	</div>
						</form>
				  	</div>
				</div>
			</div>
			<div class="tab-pane fade" id="ex3-pills-2" role="tabpanel" aria-labelledby="ex3-tab-2">
				<div class="mt-4">
					<div class="col-md-6 me-auto ms-auto">
						<h2 class="text-left font-weight-bold mb-1">Edit Profile</h2>
	    				<p class="grey-text text-left mt-1">Fill the form to edit your profile </p>
						<form class="" id="editprofile" enctype="multipart/form-data">
							<div class="form-outline mb-5">
								<i class="far fa-user trailing"></i>
								<input type="text" value="<?= $_SESSION['fullname']; ?>" id="fullname" required="" name="fullname" class="form-control form-icon-trailing">
								<label for="fullname" class="form-label">Full name</label>
							</div>
							<div class="form-outline mb-5">
								<i class="far fa-envelope trailing"></i>
								<input type="email" value="<?= $_SESSION['email']; ?>" id="email" required="" name="email" class="form-control form-icon-trailing">
								<label for="email" class="form-label">Email Address</label>
							</div>
							<div class="form-outline mb-5">
								<i class="far fa-phone-square trailing"></i>
								<input type="text" id="phone" required="" value="<?= $_SESSION['phone']; ?>" name="phone" class="form-control form-icon-trailing">
								<label for="phone" class="form-label">Phone Number</label>
							</div>
							<div class="form-outline mb-5">
								<i class="far fa-map-marker-alt trailing"></i>
								<input type="text" id="address" required="" value="<?= $_SESSION['address']; ?>" name="address" class="form-control form-icon-trailing">
								<label for="address" class="form-label">Address</label>
							</div>
							<p class="alert alert-success py-3 mt-3 text-center" id="erroredit">
								<span id="contntedit"></span>
							</p>
							<center>
								<div class="text-center align-items-center col-md-6 me-auto ms-auto justify-content-center mb-3">
									<button type="submit" id="btnEdit" class="btn btn-md btn-block btn-success btn-rounded z-depth-1a">Update Details</button>
								</div>
							</center>
						</form>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="ex3-pills-3" role="tabpanel" aria-labelledby="ex3-tab-3">
				<div class="mt-4">
					<div class="col-md-6 me-auto ms-auto">
						<h2 class="text-left font-weight-bold mb-1 primary">My Profile</h2><hr>
						<div class="d-flex mt-4 mb-5">
							<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Admin ID</span></div>
							<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;">#<?= $_SESSION['user_id']; ?></span></div>
						</div>
						<div class="d-flex mt-4 mb-5">
							<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Fullname</span></div>
							<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $_SESSION['fullname']; ?></span></div>
						</div>
						<div class="d-flex mt-4 mb-5">
							<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Username</span></div>
							<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $_SESSION['username']; ?></span></div>
						</div>
						<div class="d-flex mt-4 mb-5">
							<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Email</span></div>
							<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $_SESSION['email']; ?></span></div>
						</div>
						<div class="d-flex mt-4 mb-5">
							<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Phone number</span></div>
							<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $_SESSION['phone']; ?></span></div>
						</div>
						<div class="d-flex mt-4 mb-5">
							<div class="justify-content-start me-auto"><span class="font-weight-bold mb-2" style="line-height:1.8;">Address</span></div>
							<div class="justify-content-end ps-5"><span class="mb-2" style="line-height:1.8; font-size: .88rem;"><?= $_SESSION['address']; ?></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
<?php include 'footer.php'; ?>
<script>
	$(document).ready(function(){
		$("#errorpass").hide();
		$("#erroredit").hide();
		$("#info").show();
    });

    setTimeout(function(){
        $("#info").hide();
    }, 6000);

	function showPass(){
        var pass = document.getElementById('password');
        var npass = document.getElementById('newpassword');
        var cpass = document.getElementById('conpassword');
        if (pass.type == 'password') {
            pass.type = 'text';
            npass.type = 'text';
            cpass.type = 'text';
            $('#passText').html("Hide password <span class='far fa-eye'></span>");
        }else{
            pass.type = 'password';
            npass.type = 'password';
            cpass.type = 'password';
            $('#passText').html("Show password <span class='far fa-eye-slash'></span>");
        }
    }

	$("form#passForm").submit(function(e) {
	    e.preventDefault();    
	    var formData = new FormData(this);
	    var request = "changepassword";
	    formData.append('request', request);
	    $.ajax({
		    url: './operation/settings',
		    type: 'POST',
		    data: formData,
		    beforeSend:function(){
		       	$("#errorpass").show();
				$("#contntpass").html("Saving new password <span class='far fa-spinner fa-pulse fa-fw'></span>");
			},
		    success: function(data) {
		       	setTimeout(function(){
		       		if(data == 'success'){
		       			$("#errorpass").show();
						$("#contntpass").html("<span class='far fa-exclamation-triangle'></span> Password was changed successfully");
						setTimeout(function(){
							location.reload();
						}, 4000);
			       	}else{
			       		$("#errorpass").show();
						$("#contntpass").html("<span class='far fa-exclamation-triangle'></span>  " + data);
			       	}
		       	}, 1000);
		    },
		    cache: false,
			error:function(err){
				setTimeout(function(){
					$("#errorpass").show();
					$("#contntpass").html("<span class='far fa-exclamation-triangle'></span>  " + err);
				}, 1000);
			},
			contentType: false,
			processData: false
		});
	});


	$("form#editprofile").submit(function(e) {
	    e.preventDefault();    
	    var formData = new FormData(this);
	    var request = "editprofile";
	    formData.append('request', request);
	    $.ajax({
		    url: './operation/settings',
		    type: 'POST',
		    data: formData,
		    beforeSend:function(){
		       	$("#erroredit").show();
				$("#contntedit").html("Saving changes <span class='far fa-spinner fa-pulse fa-fw'></span>");
			},
		    success: function(data) {
		       	setTimeout(function(){
		       		if(data == 'success'){
		       			$("#erroredit").show();
						$("#contntedit").html("<span class='far fa-check-circle'></span> Profile Edited successfully");
						setTimeout(function(){
							location.reload();
						}, 4000);
			       	}else{
			       		$("#erroredit").show();
						$("#contntedit").html("<span class='far fa-exclamation-triangle'></span>  " + data);
			       	}
		       	}, 1000);
		    },
		    cache: false,
			error:function(err){
				setTimeout(function(){
					$("#erroredit").show();
					$("#contntedit").html("<span class='far fa-exclamation-triangle'></span>  " + err);
				}, 1000);
			},
			contentType: false,
			processData: false
		});
	});
</script>