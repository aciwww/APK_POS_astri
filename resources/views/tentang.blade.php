<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Tentang toko')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Card Utama -->
            <div class="card shadow-sm border-0">
                <div class="card-body m-4">

                    <!-- Header Toko -->
                        
                        <h1 class="h3 fw-bold text-dark mb-1">Women Fashion</h1>
                        <p class="lead text-success fw-semibold mb-0">Toko Fashion Wanita &bull; Tasikmalaya</p>
                    </section>
                    <hr class="my-4">

                    <div class="mb-4">
                        <h5 class="fw-bold text-dark mb-2">
                            <i class="bi bi-info-circle-fill me-2 text-success"></i>Tentang Kami
                        </h5>
                        <p class="text-secondary lh-lg mb-0">
                            <strong>Women Fashion</strong> adalah toko fashion wanita yang menyediakan koleksi busana
                            lengkap mulai dari atasan, bawahan, dress, outerwear, hingga tas dan aksesoris pilihan
                            dengan bahan berkualitas serta harga yang bersahabat. Kami berkomitmen menghadirkan produk
                            terbaik yang selalu mengikuti tren terkini, cocok untuk gaya kasual, kerja, maupun acara spesial.
                        </p>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <h6 class="fw-bold text-dark mb-3">
                                    <i class="bi bi-shop me-2 text-success"></i>Informasi Toko
                                </h6>
                                <ul class="list-unstyled mb-0 text-secondary small lh-lg">
                                    <li><strong>Nama Toko:</strong> Women Fashion</li>
                                    <li><strong>Kategori:</strong> Busana & Aksesoris Wanita</li>
                                    <li><strong>Lokasi:</strong> Tasikmalaya, Jawa Barat</li>
                                    <li><strong>Jam Operasional:</strong> 09.00 - 21.00 WIB</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Produk & Layanan -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <h6 class="fw-bold text-dark mb-3">
                                    <i class="bi bi-bag-heart-fill me-2 text-success"></i>Produk & Layanan
                                </h6>
                                <ul class="list-unstyled mb-0 text-secondary small lh-lg">
                                    <li><i class="bi bi-check-circle me-1 text-success"></i> Atasan, Bawahan & Dress</li>
                                    <li><i class="bi bi-check-circle me-1 text-success"></i> Outerwear & Tas</li>
                                    <li><i class="bi bi-check-circle me-1 text-success"></i> Aksesoris Fashion</li>
                                    <li><i class="bi bi-check-circle me-1 text-success"></i> Pemesanan Grosir & Eceran</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-success bg-opacity-10 rounded-3 mb-4 border border-success border-opacity-25">
                        <h6 class="fw-bold text-success mb-2">
                            <i class="bi bi-bullseye me-2"></i>Visi Kami
                        </h6>
                        <p class="text-secondary small mb-0">
                            Menjadi toko fashion terdepan yang menghadirkan gaya berpakaian modern, berkualitas, dan terjangkau, 
                            serta menjadi pilihan utama bagi setiap kalangan untuk tampil percaya diri dan mengikuti tren terkini.
                        </p>
                    </div>

                    <!-- Lokasi / Maps -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark mb-3">
                            <i class="bi bi-geo-alt-fill me-2 text-success"></i>Lokasi Toko
                        </h6>
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden border shadow-sm" style="max-width: 500px; margin: 0 auto;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.31859352596365!2d108.2168879468471!3d-7.342947783395948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f576c7c25dd8f%3A0x911e5e4095a1b4a2!2sPlaza%20Asia%20Tasikmalaya!5e0!3m2!1sid!2sid!4v1789526652384!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>

                    <!-- Kontak & Media Sosial -->
                    <!-- <div class="text-center pt-2">
                        <h6 class="fw-bold text-dark mb-3">Hubungi Kami</h6>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <a href="https://wa.me/6287878090942" target="_blank" class="text-success">
                                <i class="bi bi-whatsapp me-1" style="font-size: 30px;"></i>
                            </a>
                            <a href="mailto:zahrafashion@gmail.com" class="text-danger">
                                <i class="bi bi-envelope me-1" style="font-size: 30px;"></i>
                            </a>
                            <a href="https://instagram.com/zahrafashion" target="_blank" class="text-primary">
                                <i class="bi bi-instagram me-1" style="font-size: 30px;"></i>
                            </a>
                        </div>
                    </div> -->

                </div>

                <!-- Footer Card -->
                <div class="card-footer bg-white text-center py-3 border-0 rounded-bottom-4">
                    <small class="text-muted">&copy; 2026 Women Fashion</small>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection