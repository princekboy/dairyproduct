<?php include "header.php"; ?>
<title>Login | <?= SITE_NAME; ?></title>
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
                        <h3 class="display-6 font-weight-bold text-start">LOGIN</h3>
                        <hr class="hr-light">
                        <h5 class="subtext-header mt-4 mb-3">Login page</h5>
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
    	    <div class="container my-4">
    
        <!--Carousel Wrapper-->
        <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
    
          <!--Controls-->
          <div class="controls-top">
            <a class="btn-floating" href="#multi-item-example" data-mdb-slide="prev"><i class="fa fa-chevron-left"></i></a>
            <a class="btn-floating" href="#multi-item-example" data-mdb-slide="next"><i class="fa fa-chevron-right"></i></a>
          </div>
          <!--/.Controls-->
    
          <!--Indicators-->
          <ol class="carousel-indicators">
            <li data-mdb-target="#multi-item-example" data-mdb-slide-to="0" class="active"></li>
            <li data-mdb-target="#multi-item-example" data-mdb-slide-to="1"></li>
            <li data-mdb-target="#multi-item-example" data-mdb-slide-to="2"></li>
          </ol>
          <!--/.Indicators-->
    
          <!--Slides-->
          <div class="carousel-inner" role="listbox">
    
            <!--First slide-->
            <div class="carousel-item active">
    
              <div class="row">
                <div class="col-md-3">
                    <div class="view view-cascade overlay">
                    <div class="card card-cascade mb-2">
                        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                        alt="Card image cap">
                        <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight">
                        <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                  </div>
                </div>
    
                <div class="col-md-3 clearfix d-none d-md-block">
                  <div class="card card-cascade mb-2">
                    <div class="view view-cascade overlay">
                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                      alt="Card image cap">
                      <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight">
                        <div class="mask rgba-white-slight"></div>
                      </a>
                      </div>
                  </div>
                </div>

                <div class="col-md-3 clearfix d-none d-md-block">
                    <div class="card card-cascade mb-2">
                        <div class="view view-cascade overlay">
                      <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(17).jpg"
                        alt="Card image cap">
                        <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight">
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>
                    </div>
                  </div>
    
                <div class="col-md-3 clearfix d-none d-md-block">
                  <div class="card card-cascade mb-2">
                    <div class="view view-cascade overlay">
                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(35).jpg"
                      alt="Card image cap">
                      <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight2">
                        <div class="mask rgba-white-slight"></div>
                      </a>
                      </div>
                  </div>
                </div>
              </div>
    
            </div>
            <!--/.First slide-->
    
            <!--Second slide-->
            <div class="carousel-item">
    
              <div class="row">
                <div class="col-md-3">
                  <div class="card card-cascade mb-2">
                    <div class="view view-cascade overlay">
                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg"
                      alt="Card image cap">
                      <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight">
                        <div class="mask rgba-white-slight"></div>
                      </a>
                    </div>
                  </div>
                </div>
    
                <div class="col-md-3 clearfix d-none d-md-block">
                  <div class="card card-cascade mb-2">
                    <div class="view view-cascade overlay">
                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg"
                      alt="Card image cap">
                      <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight">
                        <div class="mask rgba-white-slight"></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 clearfix d-none d-md-block">
                    <div class="card card-cascade mb-2">
                        <div class="view view-cascade overlay">
                        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg"
                        alt="Card image cap">
                        <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight">
                            <div class="mask rgba-white-slight"></div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-3 clearfix d-none d-md-block">
                  <div class="card card-cascade mb-2">
                    <div class="view view-cascade overlay">
                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(48).jpg"
                      alt="Card image cap">
                      <a data-mdb-toggle="modal" data-mdb-target="#fullHeightModalRight">
                        <div class="mask rgba-white-slight"></div>
                    </div>
                    </div>
                    </div>
                </div>
              </div>
    
            </div>
            <!--/.Second slide-->
    

          <!--/.Slides-->
    
        </div>
        <!--/.Carousel Wrapper-->
    
    
      </div>
            
            <!--/.Modals after footer-->
            
              <!-- Full Height Modal Right -->
  <div class="modal fade bottom" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex flex-row justify-content-center">
            <img src="https://mdbootstrap.com/img/Photos/Others/men.jpg" class="rounded-circle" height="50px"
              width="50px">
            <h5 class="font-weight-bold ml-3">Billy Coleman</h5>
            <p class="ml-1"><span class="grey-text mr-2">@billyBill</span> active 5 minutes ago</p> <i
              class="fas fa-circle yellow-text ml-2"></i>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
 
          </div>

          <hr>

          <div class="d-flex flex-row justify-content-center">
            <button class="btn blue-gradient"><i class="fas fa-chevron-circle-right fa-lg mr-2"></i>Send him a message</button>
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
            <button class="btn blue-gradient"><i class="fas fa-user-circle fa-lg mr-2"></i>Visit his profile</button>
            
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
            <button class="btn blue-gradient"><i class="fas fa-plus-circle fa-lg mr-2"></i>Add to friends</button>
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
              <button class="btn blue-gradient"><i class="fas fa-eye fa-lg mr-2"></i>Observe him</button>
          </div>

          <hr>

          <div class="d-flex flex-row justify-content-center">
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin justo ligula,
              malesuada eget dignissim gravida, commodo sit amet sapien. Integer aliquet justo quis scelerisque feugiat.
              Maecenas pretium vestibulum facilisis. Fusce turpis urna, viverra eget dictum id, accumsan faucibus eros.
            </p>

          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Full Height Modal Right -->

    <!-- Full Height Modal Right -->
    <div class="modal fade bottom" id="fullHeightModalRight2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-bottom" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex flex-row justify-content-center">
            <img src="https://mdbootstrap.com/img/Photos/Others/men.jpg" class="rounded-circle" height="50px"
              width="50px">
            <h5 class="font-weight-bold ml-3">Billy Coleman</h5>
            <p class="ml-1"><span class="grey-text mr-2">@billyBill</span> active 5 minutes ago</p> <i
              class="fas fa-circle yellow-text ml-2"></i>
          </div>

          <hr>

          <div class="d-flex flex-row justify-content-center">
            <button class="btn blue-gradient"><i class="fas fa-chevron-circle-right fa-lg mr-2"></i>Send him a message</button>
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
            <button class="btn blue-gradient"><i class="fas fa-user-circle fa-lg mr-2"></i>Visit his profile</button>
            
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
            <button class="btn blue-gradient"><i class="fas fa-plus-circle fa-lg mr-2"></i>Add to friends</button>
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
              <button class="btn blue-gradient"><i class="fas fa-eye fa-lg mr-2"></i>Observe him</button>
          </div>

          <hr>

          <div class="d-flex flex-row justify-content-center">
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin justo ligula,
              malesuada eget dignissim gravida, commodo sit amet sapien. Integer aliquet justo quis scelerisque feugiat.
              Maecenas pretium vestibulum facilisis. Fusce turpis urna, viverra eget dictum id, accumsan faucibus eros.
            </p>

          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Full Height Modal Right -->

    <!-- Full Height Modal Right -->
    <div class="modal fade bottom" id="fullHeightModalRight3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-bottom" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex flex-row justify-content-center">
            <img src="https://mdbootstrap.com/img/Photos/Others/men.jpg" class="rounded-circle" height="50px"
              width="50px">
            <h5 class="font-weight-bold ml-3">Billy Coleman</h5>
            <p class="ml-1"><span class="grey-text mr-2">@billyBill</span> active 5 minutes ago</p> <i
              class="fas fa-circle yellow-text ml-2"></i>
          </div>

          <hr>

          <div class="d-flex flex-row justify-content-center">
            <button class="btn blue-gradient"><i class="fas fa-chevron-circle-right fa-lg mr-2"></i>Send him a message</button>
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
            <button class="btn blue-gradient"><i class="fas fa-user-circle fa-lg mr-2"></i>Visit his profile</button>
            
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
            <button class="btn blue-gradient"><i class="fas fa-plus-circle fa-lg mr-2"></i>Add to friends</button>
          </div>

          <div class="d-flex flex-row justify-content-center mt-2">
              <button class="btn blue-gradient"><i class="fas fa-eye fa-lg mr-2"></i>Observe him</button>
          </div>

          <hr>

          <div class="d-flex flex-row justify-content-center">
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin justo ligula,
              malesuada eget dignissim gravida, commodo sit amet sapien. Integer aliquet justo quis scelerisque feugiat.
              Maecenas pretium vestibulum facilisis. Fusce turpis urna, viverra eget dictum id, accumsan faucibus eros.
            </p>

          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Full Height Modal Right -->
    </div>
</main>
<?php include "footer.php"; ?>