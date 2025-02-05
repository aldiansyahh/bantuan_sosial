<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BANSOS</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <!-- Navbar Start -->
        @include('import/navbar')
        <!-- Navbar End -->
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src="assets/img/hero-bg-2.jpg" alt="" class="hero-bg">

            <div class="container">
                <div class="row gy-4 justify-content-between">
                    <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                        <img src="assets/img/bansoss.png" class="img-fluid animated" alt="">
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-in">
                        <h1>Monitor Penerimaan Bansos dengan <span>Klasifikasi Kelayakan</span></h1>
                        <p>Kami adalah tim profesional yang berdedikasi untuk memastikan distribusi bansos yang efisien
                            dan tepat sasaran kepada mereka yang membutuhkan.</p>
                    </div>
                </div>
            </div>
            <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                    </path>
                </defs>
                <g class="wave1">
                    <use xlink:href="#wave-path" x="50" y="3"></use>
                </g>
                <g class="wave2">
                    <use xlink:href="#wave-path" x="50" y="0"></use>
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9"></use>
                </g>
            </svg>

        </section><!-- /Hero Section -->

        <!-- Import Data Section -->
        <section id="import-data" class="import-data section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center gy-5">


                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="col-lg-6">
                        <h2>Cara Import Data Penerimaan Bansos</h2>
                        <p>Download Template terlebih dahulu <a href="{{ asset('assets/templates/data_bansos.xlsx') }}"
                                class="text-primary text-decoration-underline" download>
                                Download Template
                            </a>, lalu isi data didalam file yang sudah di download sesuai dengan petunjuk yang ada
                            didalam file.
                            Jika sudah mengisi datanya, cukup unggah file yang sudah ada datanya.
                        </p>



                    </div>
                    <div class="col-lg-6">
                        <div class="upload-box">
                            <form action="{{ route('importbansos') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="form-group">
                                    <label for="judul" class="form-label">Judul Data</label>
                                    <input type="text" name="judul" id="judul" class="form-control"
                                        placeholder="Masukkan Judul Data" required>
                                </div> --}}
                                <div class="form-group">

                                    <label for="file-upload" class="form-label">Pilih File Data (Excel)</label>

                                    <input type="file" name="file" id="file-upload" class="form-control"
                                        accept=".csv, .xlsx, .xls" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">
                                    Unggah Data
                                </button>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Import Data Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-xl-center gy-5">
                    <div class="col-xl-5 content">
                        <h3>Tentang Kami</h3>
                        <h2>Kelola Penerimaan Bansos dengan Klasifikasi Kelayakan</h2>
                        <p>Selamat datang di platform kami, yang berfokus pada pengelolaan dan klasifikasi penerimaan
                            bansos untuk memastikan distribusi yang tepat sasaran dan efisien. Kami menggunakan
                            teknologi canggih untuk membantu pengelolaan yang lebih baik dan memberikan kemudahan dalam
                            monitoring penerimaan.</p>
                    </div>
                    <div class="col-xl-7">
                        <div class="row gy-4 icon-boxes">
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box">
                                    <i class="bi bi-calendar-check"></i>
                                    <h3>Klasifikasi Tepat Waktu</h3>
                                    <p>Platform kami mengklasifikasikan penerimaan bansos dengan efisien, memastikan
                                        penerima yang tepat mendapatkan bantuan sesuai dengan kebutuhan mereka.</p>
                                </div>
                            </div> <!-- End Icon Box -->
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-bar-chart-line"></i>
                                    <h3>Analisis Data</h3>
                                    <p>Dengan menggunakan teknologi analisis data yang canggih, platform kami membantu
                                        dalam mengidentifikasi penerima bansos yang sesuai dan memantau distribusinya.
                                    </p>
                                </div>
                            </div> <!-- End Icon Box -->
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /About Section -->

    </main>

    <footer id="footer" class="footer dark-background">
        <!-- Footer Start -->
        @include('import/footer')
        <!-- Footer End -->
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
