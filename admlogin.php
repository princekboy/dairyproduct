<?php include "header.php"; ?>
<title>Admin Login | <?= SITE_NAME; ?></title>
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
<div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(./assets/images/bg-default.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="mask rgba-purple-slight" style="background-color: rgba(0, 0, 0, 0.7)">
        <div class="container h-100 d-flex align-items-left">
            <div class="row smooth-scroll py-5">
                <div class="col-md-12 text-white text-start">
                    <div class="wow fadeInDown py-5" data-wow-delay="0.2s">
                        <h3 class="display-6 font-weight-bold text-start">ADMIN LOGIN</h3>
                        <hr class="hr-light">
                        <h5 class="subtext-header mt-4 mb-3">Admin Login page</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<!--/Navigation & Intro-->

<!--Main content-->
<main>
    <!--First container-->
    <div class="container">
    	<div class="row">
    		<div class="col-lg-6 col-md-12 ms-auto me-auto">
    			<div class="card shadow-3 mb-5">
    				<div class="card-body py-4 px-4">
    					<h3 class="text-start mb-5">Login here</h3>
    					<form id="login" class="wow fadeInUp md-form mt-4" data-wow-delay="0.2s" method="POST" enctype="multipart/form-data">
    						<div class="form-outline mb-5 mt-3">
    							<i class="far fa-user trailing"></i>
    							<input type="text" name="username" id="username" class="form-control form-icon-trailing">
    							<label for="username" class="form-label">Username</label>
    						</div>
    						<div class="form-outline mb-5 mt-5">
    							<input type="password" name="password" id="password" class="form-control form-icon-trailing">
    							<label for="password" class="form-label">Password</label>
                                <a onclick="viewPassword()" id="showpass" class="position-absolute text-dark" style="top: 6px; left: 94%; cursor: pointer;" title="Toggle show/hide password">
                                    <i class="far fa-eye-slash eye-off"></i>
                                </a>
    						</div>
    						<div class="row mb-2 mt-3 px-3">
    							<div class="col-md-4 text-start">
    								<input type="checkbox" name="remember" id="remember" class="form-check-input">
    								<label for="remember" class="form-check-label">Remember Me</label>
    							</div>
    						</div>
                            <div class="form-group" align="center">
                                <p class="alert alert-success" id="errorshow"></p>
                            </div>
    						<div align="center" class="mt-4 col-md-6 ms-auto me-auto">
    							<button class="btn btn-success btn-block btn-rounded btn-md">login</button>
    						</div>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</main>
<?php include "footer.php"; ?>
<script>
    $(document).ready(function(){
        $("#errorshow").hide();
    });

    function viewPassword(){
        var password = document.getElementById('password');
        if (password.type == 'password') {
            password.type = 'text';
            $('#showpass').html("<span class= 'far fa-eye'></span>");
        }else{
            password.type = 'password';
            $('#showpass').html("<span class= 'far fa-eye-slash'></span>");
        }
    }

    $("form#login").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
        $.ajax({
            url: './operation/admloginauth',
            type: 'POST',
            data: formData,
            beforeSend:function(){
                $("#errorshow").html("Login in <span class='far fa-fw fa-spinner fa-pulse'></span>").show();
            },
            success: function (result) {
                var response = $.parseJSON(result);
                if (response.message == "success") {
                    $("#errorshow").html("Login successfully").show();
                    setTimeout(function(){
                        $("#errorshow").hide();
                    }, 2000);
                    setTimeout(' window.location.href = "./control"; ', 2000);
                    
                }else{
                    $("#errorshow").html("<span class='far fa-exclamation-triangle'></span> " + response.message).show();
                    setTimeout(function(){
                        $("#errorshow").hide();
                    }, 3000);
                }   
            },
            cache: false,
            error:function(err){
                $('#errorshow').html("<span class='far fa-exclamation-triangle'></span> An error has occured!").show();
                setTimeout(function(){
                    $("#errorshow").hide();
                }, 4000);
            },
            contentType: false,
            processData: false
        });
    });

</script>