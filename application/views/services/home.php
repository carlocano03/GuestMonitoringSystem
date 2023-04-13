<style>
    body {
        background-image: url("<?= base_url('assets/img/bgbg.jpg') ?>");
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<body>
    <main>
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="container">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <!--<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>-->
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <div class="mb-1">
                                    <img src="<?= base_url('assets/img/jacks.png')?>" alt="" width="170" >
                                </div>
                            <img src="<?= base_url('assets/img/carousel/1.jpg')?>" class="d-block w-100" alt="..." style="border-radius:50px;">
                            <div class="carousel-caption d-none d-md-block">
                               
                               
                                <button style="width: 70%; background-color:#8f3f97; border-radius:100px; color:#ffcc00; font-size:30px;" class="btn-register">START YOUR ADVENTURE</button>
                               
                            </div>
                        </div>
                        <div class="carousel-item">
                        <div class="mb-1">
                                    <img src="<?= base_url('assets/img/jacks.png')?>" alt="" width="170" >
                                </div>
                            <img src="<?= base_url('assets/img/carousel/b.jpg')?>" class="d-block w-100" alt="..." style="border-radius:50px;">
                            <div class="carousel-caption d-none d-md-block">
                                
                               
                                <button style="width: 70%; background-color:#8f3f97; border-radius:100px; color:#ffcc00; font-size:30px;" class="btn-register">START YOUR ADVENTURE</button>
                                <div class="mb-2">
                               
                            </div>
                        </div>
                        
                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-register', function() {
                window.location.href = "<?= base_url('home/services')?>";
            });
        });
    </script>