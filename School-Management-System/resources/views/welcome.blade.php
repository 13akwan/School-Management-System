<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SMKN 10 Salatiga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        /* NAVBAR */
        .navbar {
            backdrop-filter: blur(10px);
        }

        .logo {
            width: 40px;
            height: 40px;
        }

        .logo img{
            object-fit: cover;
        }

        /* HERO */
        .hero {
            position: relative;
            height: 90vh;
            background: url("{{ asset('images/home.png') }}") center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
        }

        .hero-content {
            position: relative;
            text-align: center;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        /* SECTION TITLE */
        .section-title {
            font-weight: 700;
            margin-bottom: 40px;
        }

        /* CARD */
        .card-custom {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .card-custom:hover {
            transform: translateY(-8px);
        }

        .card-custom img {
            height: 200px;
            object-fit: cover;
        }

        /* TESTIMONI */
        .testimonial {
            padding: 25px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .testimonial img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid #0d6efd;
            object-fit: cover;
            margin-bottom: 10px;
        }

        /* DOCUMENTATION */
        .gallery img {
            border-radius: 10px;
            transition: 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        /* FOOTER */
        footer {
            background: #0d1b2a;
        }

        footer a {
            color: #ccc;
            text-decoration: none;
        }

        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top px-4">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" class="logo me-2">
            <span class="fw-bold">SMKN 10 Salatiga</span>
        </div>

        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1>SMK Negeri 10 Salatiga</h1>
        <p class="lead">SMK Bisa, SMK Hebat 🚀</p>
        <a href="#" class="btn btn-light mt-3">Lihat Program</a>
    </div>
</section>

<!-- JURUSAN -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="section-title">Program Keahlian</h2>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <img src="{{ asset('images/rpl.png') }}">
                    <div class="p-3">
                        <h5>RPL</h5>
                        <p>Rekayasa Perangkat Lunak</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <img src="{{ asset('images/tkj.png') }}">
                    <div class="p-3">
                        <h5>TKJ</h5>
                        <p>Teknik Komputer & Jaringan</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-custom">
                    <img src="{{ asset('images/akl.png') }}">
                    <div class="p-3">
                        <h5>AKL</h5>
                        <p>Akuntansi & Keuangan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DOKUMENTASI -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="section-title">Dokumentasi Kegiatan</h2>

        <div class="row gallery">
            <div class="col-md-4 mb-3">
                <img src="{{ asset('images/home.png') }}" class="img-fluid">
            </div>
            <div class="col-md-4 mb-3">
                <img src="{{ asset('images/guru.png') }}" class="img-fluid">
            </div>
            <div class="col-md-4 mb-3">
                <img src="{{ asset('images/lingkungan.png') }}" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONI -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="section-title">Testimoni Alumni</h2>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="testimonial">
                    <img src="{{ asset('images/photo1.png') }}">
                    <p>"Sekolah ini sangat membantu saya berkembang."</p>
                    <strong>- Andi</strong>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="testimonial">
                    <img src="{{ asset('images/photo2.png') }}">
                    <p>"Guru-gurunya luar biasa."
                        <br></br>
                    </p>
                    <strong>- Budi</strong>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="testimonial">
                    <img src="{{ asset('images/photo3.png') }}">
                    <p>"Pengalaman terbaik saya."
                        <br></br>
                    </p>
                    <strong>- Siti</strong>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="text-white pt-5 pb-3">
    <div class="container">
        <div class="row">

            <div class="col-md-4 mb-3">
                <h5>SMKN 10 Salatiga</h5>
                <p>Mencetak generasi unggul, kreatif, dan siap kerja.</p>
            </div>

            <div class="col-md-4 mb-3">
                <h5>Menu</h5>
                <p><a href="#">Home</a></p>
                <p><a href="#">Jurusan</a></p>
                <p><a href="#">Kontak</a></p>
            </div>

            <div class="col-md-4 mb-3">
                <h5>Kontak</h5>
                <p>Email: info@smkn10.sch.id</p>
                <p>Telp: 0812-3456-7890</p>
                <p>Salatiga, Jawa Tengah</p>
            </div>

        </div>

        <hr style="border-color: rgba(255,255,255,0.2)">

        <div class="text-center">
            <small>© 2026 SMKN 10 Salatiga</small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>