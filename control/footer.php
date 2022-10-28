<!--Main Layout-->
<footer class="py-1 footer bg-success">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6" align="center">
                <img src="../assets/images/" width="170" alt="<?= SITE_NAME; ?>" class='img-fluid text-white'>
            </div>
            <div class="col-md-6" align="center">
                <ul class="footer-nav list-unstyled">
                    <li class="socials me-3"><a href="#"><span class="fab fa-facebook text-white"></span></a></li>
                    <li class="socials me-3"><a href="#"><span class="fab fa-twitter text-white"></span></a></li>
                    <li class="socials me-3"><a href="#"><span class="fab fa-whatsapp text-white"></span></a></li>
                    <li class="socials"><a href="#"><span class="fab fa-instagram text-white"></span></a></li>
                </ul>
                <p class="text-white text-center">&copy; <?= date("Y"); ?> <?= SITE_NAME; ?></p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>

<script src="../assets/js/mdb.min.js"></script>
<script src="../assets/js/wow.min.js"></script>
<script>
    new WOW().init();

	//Initialize it with JS to make it instantly visible
    const slimInstance = new mdb.Sidenav(document.getElementById('mysidenav'));
    slimInstance.show();

    document.getElementById('slim-toggler').addEventListener('click', () => {
        slimInstance.toggleSlim();
    });

</script>