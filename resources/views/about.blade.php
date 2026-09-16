<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'About')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Card Utama -->
                <div class="card shadow-sm border-0 ">
                    <div class="card-body m-4">
                        
                        <!-- Header Profil -->
                        <!-- <div class="text-center mb-4">
                            <div class="avatar-icon mb-3">
                                <i class="bi bi-person-circle display-1 text-primary"></i>
                            </div>
                            <h2 class="fw-bold mb-1">Zahra Afifah Hifdillah</h2>
                            <p class="text-muted fw-medium mb-0">
                                <i class="bi bi-mortarboard-fill me-1 text-primary"></i>
                                Kelas 12 PPLG 2 -  SMKN 4 Tasikmalaya
                            </p>
                        </div> -->
                        <section id="content1" class="jumbotron text-center bg-white p-4 rounded-3 shadow-sm mb-4">
                            <img src="{{ asset('images/logo.png') }}" alt="Astri Dwi Lestari" width="180" class="rounded-circle img-thumbnail mb-3" />
                            <h1 class="h3 fw-bold text-dark mb-1">Astri Dwi Lestari</h1>
                            <p class="lead text-success fw-semibold mb-0">Kelas XII PPLG 2 &bull; SMKN 4 Tasikmalaya</p>
                        </section>
                        <hr class="my-4">

                        <div class="mb-4">
                            <h5 class="fw-bold text-dark mb-2">
                                <i class="bi bi-info-circle-fill me-2 text-success"></i>Tentang Pengembang & Project
                            </h5>
                            <p class="text-secondary lh-lg mb-0">
                            Aplikasi Point of Sale (POS) ini dirancang dan dikembangkan oleh
                            <strong>Astri Dwi Lestari</strong>, siswi jurusan
                            <strong>Pengembangan Perangkat Lunak dan Gim (PPLG)</strong> SMKN 4 Tasikmalaya,
                            sebagai project penerapan kompetensi keahlian di bidang rekayasa perangkat lunak.
                            Dibangun dengan tujuan menghadirkan sistem kasir yang praktis, efisien, dan mampu
                            mendukung kelancaran operasional bisnis UMKM sehari-hari.
                        </p>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold text-dark mb-3">
                                        <i class="bi bi-card-heading me-2 text-success"></i>Detail Pengembang
                                    </h6>
                                    <ul class="list-unstyled mb-0 text-secondary small lh-lg">
                                        <li><strong>Nama:</strong> Astri Dwi Lestari</li>
                                        <li><strong>Kelas:</strong> XII PPLG 2</li>
                                        <li><strong>Jurusan:</strong> PPLG</li>
                                        <li><strong>Instansi:</strong> SMKN 4 Tasikmalaya</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Stack Teknologi -->
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold text-dark mb-3">
                                        <i class="bi bi-cpu-fill me-2 text-success"></i>Teknologi & Tools
                                    </h6>
                                    <ul class="list-unstyled mb-0 text-secondary small lh-lg">
                                        <li><i class=" text-success"></i> <strong>Framework:</strong> Laravel 12 & PHP 8.4</li>
                                        <li><i class=" text-success"></i> <strong>UI:</strong> Bootstrap & Icons</li>
                                        <li><i class=" text-success"></i> <strong>Server:</strong> Apache</li>
                                        <li><i class=" text-success"></i> <strong>Database:</strong> MySQL</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-primary bg-opacity-10 rounded-3 mb-4 border border-success border-opacity-25">
                            <h6 class="fw-bold text-success mb-2">
                                <i class="bi bi-bullseye me-2"></i>Tujuan Aplikasi
                            </h6>
                            <p class="text-secondary small mb-0">
                                Membantu pencatatan transaksi penjualan, pengelolaan stok barang, dan pembuatan laporan keuangan harian secara otomatis dan akurat.
                            </p>
                        </div>

                        <!-- Kontak & Media Sosial -->
                        <div class="text-center pt-2">
                            <h6 class="fw-bold text-dark mb-3">Hubungi Pengembang</h6>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="https://gmail.com/astridwilestari0@gmail.com" target="_blank" class="text-danger">
                                    <i class="bi bi-envelope me-1" style="font-size: 30px;"></i>
                                </a>
                                <a href="https://github.com/aciwww/APK_POS_astri.git" target="_blank" class="text-dark">
                                    <i class="bi bi-github" style="font-size: 30px;"></i>
                                </a>
                               <a href="https://instagram.com/astri.011" target="_blank" class="text-primary">
                                    <i class="bi bi-instagram me-1" style="font-size: 30px;"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                    
                    <!-- Footer Card -->
                    <div class="card-footer bg-white text-center py-3 border-0 rounded-bottom-4">
                        <small class="text-muted">&copy; 2026 Astri Dwi Lestari- PPLG SMKN 4 Tasikmalaya</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

   </body>
</html>