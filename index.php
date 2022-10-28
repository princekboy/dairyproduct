<?php include 'header.php'; ?>
<title>Home | <?= SITE_NAME; ?></title>
<style>
    html,body, header, .jarallax {
        height: 100%;
    }

    @media (min-width: 560px) and (max-width: 740px) {
        html,body,header, .jarallax {
            height: 500px;
        }
    }

    @media (min-width: 800px) and (max-width: 850px) {
        html,body,header,.jarallax {
            height: 500px;
        }
    }
</style>
<!-- Intro Section -->
<div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url(./assets/images/bg-default.jpg); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <div class="mask rgba-purple-slight" style="background-color: rgba(0, 0, 0, 0.7)">
        <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="row smooth-scroll">
                <div class="col-md-12 text-white text-center">
                    <div class="wow fadeInDown" data-wow-delay="0.2s">
                        <h3 class="display-2 font-weight-bold mb-2">WELCOME TO FARM PROJECT SALE</h3>
                        <hr class="hr-light">
                        <h4 class="subtext-header mt-4 mb-3">You can buy all your farm items here.</h4>
                    </div>
                    <a class="btn btn-rounded btn-success text-white wow fadeInUp" href="./products" data-wow-delay="0.2s">Make first purchase</a>
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
        <!--Section: About-->
        <section id="about" class="about mt-4 mb-3">
            <!--Secion heading-->
            <h2 class="text-center mb-5 my-5 py-4 dark-grey-text font-weight-bold wow fadeIn" data-wow-delay="0.2s">WHAT WE OFFER </h2>
            <!--First row-->
            <div class="row">
                <!-- First Column -->
                <div class="col-lg-3 ml-lg-auto col-md-12 wow fadeIn" data-wow-delay="0.4s">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <img src="./assets/images/cow-sm.png" class="img-fluid mb-4 z-depth-1 rounded" alt="My photo">
                            <h4 class="mb-3">Beef & Cattle</h4>
                            <p class="text-start text-muted">Our premium freezer beef offers the most tender and flavorful eating experience. Our beef doesn’t contain any artificial ingredients.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="./assets/images/bottle-sm.png" class="img-fluid mb-4 z-depth-1 rounded" alt="My photo">
                            <h4 class="mb-3">Dairy Products</h4>
                            <p class="text-start text-muted">We are a renowned Processor, Supplier and Exporter of Dairy Products, which are highly acclaimed in the market for their freshness and purity.</p>
                        </div>
                    </div>
                </div>
                <!-- First column -->
                <!--Second column-->
                <div class="col-lg-6 col-md-12 mb-5 wow fadeIn" data-wow-delay="0.4s">
                    <!--Image-->
                    <img src="./assets/images/fruits.jpg" class="img-fluid z-depth-1 rounded" alt="My photo">
                </div>
                <!--/Second column-->
                <!--Third column-->
                <div class="col-lg-3 ml-lg-auto col-md-12 wow fadeIn" data-wow-delay="0.4s">
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <img src="./assets/images/fruit-sm.png" class="img-fluid mb-4 z-depth-1 rounded" alt="My photo">
                            <h4 class="mb-3">Orchard Fruits</h4>
                            <p class="text-start text-muted">We have your fruit favorites, and maybe some that you have never heard of! We offer apples, peaches, nectarines, sweet cherries, sour cherries, etc</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="./assets/images/crop-sm.png" class="img-fluid mb-4 z-depth-1 rounded" alt="My photo">
                            <h4 class="mb-3">Dinning & Catering</h4>
                            <p class="text-start text-muted">We offer farm fresh, wholesome and delicious food for events of all sizes, from business meetings and conferences to private parties and barn weddings.</p>
                        </div>
                    </div>
                </div>
                <!--/Third column-->
            </div>
            <!--/First row-->
        </section>
        <!--/Section: About-->
        <hr>
    </div>
    <!--/First container-->

    <!--Second container-->
    <div class="container">
        <!--Section: Features v.1-->
        <section id="attractions" class="mt-4 mb-4">
            <!--Section heading-->
            <h2 class="text-center my-5 dark-grey-text font-weight-bold wow fadeIn" data-wow-delay="0.2s">What Makes us Unique</h2>
            <!--Section sescription-->
            <p class="text-center grey-text w-responsive mx-auto mb-5 wow fadeIn" data-wow-delay="0.2s"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum .</p>
            <!--First row-->
            <div class="row features wow fadeIn" data-wow-delay="0.2s">
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="icon-area white">
                        <div class="circle-icon">
                            <i class="fas fa-leaf fa-3x text-success"></i>
                        </div>
                        <h5 class="dark-grey-text font-weight-bold mt-2">Product Range</h5>
                        <div class="mt-1">
                            <p class="mx-3 grey-text">Delivering our produce to your place is an easy task for our company!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="icon-area">
                        <div class="circle-icon">
                            <i class="fas fa-tint fa-3x text-success"></i>
                        </div>
                        <h5 class="dark-grey-text font-weight-bold mt-2">Quality Matters</h5>
                        <div class="mt-1">
                            <p class="mx-3 grey-text">We are growing a multitude of different vegetables, fruits and grains…</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center mb-4">
                    <div class="icon-area">
                        <div class="circle-icon">
                            <i class="fas fa-gift fa-3x text-success"></i>
                        </div>
                        <h5 class="dark-grey-text font-weight-bold mt-2">Free Shipping</h5>
                        <div class="mt-1">
                            <p class="mx-3 grey-text">We’re determined to keep up the quality of all of our farming products as high as possible.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center">
                    <div class="icon-area white">
                        <div class="circle-icon">
                            <i class="fas fa-bullseye fa-3x text-success"></i>
                        </div>
                        <h5 class="dark-grey-text font-weight-bold mt-2">Customer Satisfaction</h5>
                        <div class="mt-1">
                            <p class="mx-3 grey-text">Our experts spent last few years excelling their skills and expanding their knowledge.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/First row-->
        </section>
        <!--/Section: Features v.1-->
    </div>
</main>
<!--/Main content-->

<?php include 'footer.php'; ?>
<script>
    $(document).ready(function(){
        $("#errorshows2").hide();
    });
            
    $("form#contact").submit(function(e) {
        e.preventDefault()  ;
        var formData = new FormData(this);
        $.ajax({
            url: 'operation/contact',
            type: 'POST',
            data: formData,
            beforeSend:function(){
                $('#errorshows2').html("Sending message <span class='fas fa-spinner fa-spin'></span>").show();
            },
            success: function (data) {
                if (data == "success") {
                    $("#errorshows2").html("Message has been sent successfully. <br> We will reply as soon as possible. Thank you.").show();
                    //setTimeout(location.reload(), 5000);
                }else{
                    $("#errorshows2").html("<span class='far fa-exclamation-triangle'></span> " + data).show();
                    setTimeout(function(){
                        $("#errorshows2").hide();
                    }, 5000);
                }   
            },
            cache: false,
            error:function(){
                $('#errorshows2').html("<span class='far fa-exclamation-triangle'></span> An error has occured!!").show();
                setTimeout(function(){
                    $("#errorshows2").hide();
                }, 5000);
            },
            contentType: false,
            processData: false
        });
    });
</script>
