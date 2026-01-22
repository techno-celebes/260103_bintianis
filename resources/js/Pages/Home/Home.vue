<template>
    <div>
        <header class="hero section" role="banner">
            <div class="container">
                <div class="row align-items-center g-4 g-lg-5">

                    <!-- TEXT -->
<div class="col-lg-6">

    <p class="mb-2 text-uppercase small fw-semibold text-secondary">
        Toko Jajanan & Kue di Palu · Spesialis Jajanan Arab
    </p>

    <h1 class="display-5 fw-bold mb-3">
        Bintianis – Toko Jajanan & Kue<br>
        Spesialis Jajanan Arab di Palu
    </h1>

    <p class="lead text-secondary mb-4">
        <strong>Bintianis</strong> adalah toko jajanan dan kue rumahan di Palu
        yang menyediakan berbagai camilan berkualitas untuk keluarga dan acara.
        Kami dikenal dengan <strong>spesialisasi jajanan Arab</strong> seperti
        samosa, kubba, sambousek, dan baklava, tersedia segar maupun beku.
    </p>

    <!-- Rating -->
    <div class="d-flex align-items-center gap-2 mb-4">
        <div class="text-warning" aria-label="Rating pelanggan">
            ★★★★★
        </div>
        <small class="text-secondary">
            Dipercaya pelanggan rumahan & katering di Palu
        </small>
    </div>

    <!-- Tombol Aksi -->
    <div class="d-flex gap-3 flex-wrap mb-4">
        <a href="#products" class="btn btn-lg cta-primary text-white px-4">
            Pesan Jajanan
        </a>
        <a href="#rice" class="btn btn-lg cta-outline px-4">
            Pre-Order Nasi
        </a>
    </div>

    <!-- Badge Kepercayaan -->
    <div class="d-flex gap-2 flex-wrap">
        <span class="badge badge-trust">Halal</span>
        <span class="badge badge-trust">Produksi Rumahan</span>
        <span class="badge badge-trust">Tanpa Pengawet</span>
    </div>

</div>


                    <!-- IMAGE -->
                    <div class="col-lg-6">
                        <div class="ratio ratio-4x3 visual position-relative">
                            <img
                                src="/img/hero-png.jpg"
                                alt="Aneka jajanan dan kue dari Bintianis Palu, termasuk spesialis camilan Arab seperti samosa dan baklava"
                                class="position-absolute top-0 start-0 w-100 h-100"
                                loading="eager"
                                width="1200"
                                height="900"
                            />
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <main id="main" role="main">

            <!-- ================= PRODUK ================= -->
            <section id="products" class="section" aria-labelledby="heading-products">
                <div class="container">

                    <header class="d-flex align-items-end justify-content-between mb-4">
                        <div>
                            <h2 id="heading-products" class="h1 mb-2">
                                Jajanan & Kue Favorit dari Bintianis Palu
                            </h2>
                            <p class="text-secondary mb-0">
                                Beragam jajanan rumahan berkualitas dengan spesialisasi camilan Arab — tersedia segar dan beku.
                            </p>
                        </div>
                        <a class="btn btn-link" href="#contact">
                            Pesanan besar & katering di Palu
                        </a>
                    </header>

                    <div class="row g-4">

                        <!-- KATEGORI BEKU -->
                        <article class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <div class="ratio ratio-4x3 visual">
                                    <img
                                        src="/img/product-1.jpg"
                                        alt="Camilan Arab beku khas Bintianis Palu dikemas rapi, siap disimpan di freezer"
                                        class="w-100 h-100"
                                        loading="lazy"
                                        width="600"
                                        height="450"
                                    />
                                </div>
                                <div class="card-body">
                                    <h3 class="h5">Camilan Beku (Frozen)</h3>
                                    <p class="text-secondary mb-3">
                                        Solusi praktis untuk stok di rumah. Tinggal goreng, panggang, atau air-fryer.
                                    </p>
                                    <ul class="list-check text-secondary mb-3">
                                        <li>Samosa ayam & sapi</li>
                                        <li>Kubba / kibbeh</li>
                                        <li>Baklava bites</li>
                                    </ul>
                                    <a href="#best-sellers" class="btn btn-sm cta-outline">
                                        Produk Terlaris
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- KATEGORI SEGAR -->
                        <article class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <div class="ratio ratio-4x3 visual">
                                    <img
                                        src="/img/product-2.jpg"
                                        alt="Camilan Arab segar buatan Bintianis Palu disajikan di piring dengan saus"
                                        class="w-100 h-100"
                                        loading="lazy"
                                        width="600"
                                        height="450"
                                    />
                                </div>
                                <div class="card-body">
                                    <h3 class="h5">Camilan Segar (Fresh Order)</h3>
                                    <p class="text-secondary mb-3">
                                        Dimasak sesuai pesanan — cocok untuk acara keluarga, arisan, dan kumpul-kumpul.
                                    </p>
                                    <ul class="list-check text-secondary mb-3">
                                        <li>Dibuat di hari yang sama</li>
                                        <li>Bisa request level pedas</li>
                                        <li>Tersedia paket piring pesta</li>
                                    </ul>
                                    <a href="#contact" class="btn btn-sm cta-outline">
                                        Tanya Menu Hari Ini
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Nasi Arab -->
                        <article id="rice" class="col-md-12 col-lg-4">
                            <div class="card h-100 border-warning">
                                <div class="ratio ratio-4x3 visual">
                                    <img
                                        src="/img/product-3.jpg"
                                        alt="Nasi Arab khas Timur Tengah seperti kebuli dan biryani dari dapur Bintianis Palu"
                                        class="w-100 h-100"
                                        loading="lazy"
                                        width="600"
                                        height="450"
                                    />
                                </div>
                                <div class="card-body">
                                    <h3 class="h5">Nasi Arab (Segera Hadir)</h3>
                                    <p class="text-secondary mb-3">
                                        Nasi Kebuli, Khabsa, Biryani, dan Mandhi — kaya rempah dan aroma.
                                    </p>
                                    <span class="badge bg-warning text-dark mb-3">Segera Hadir</span>
                                    <div>
                                        <a href="#newsletter" class="btn btn-sm btn-warning">
                                            Dapatkan Info Launching
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>

                    <!-- ================= TERLARIS ================= -->
                    <section id="best-sellers" class="mt-5" aria-labelledby="heading-best">
                        <h3 id="heading-best" class="h2 mb-3">
                            Produk Terlaris di Palu
                        </h3>

                        <div class="row g-4">

                            <!-- PRODUK -->
                            <article class="col-12 col-sm-6 col-lg-3">
                                <div class="card h-100">
                                    <div class="ratio ratio-1x1 visual">
                                        <img
                                            src="/img/samosa-ayam.jpg"
                                            alt="Samosa ayam beku Bintianis Palu, renyah dan gurih"
                                            loading="lazy"
                                            width="400"
                                            height="400"
                                        />
                                    </div>
                                    <div class="card-body">
                                        <h4 class="h6 mb-1">Samosa Ayam (Beku)</h4>
                                        <p class="small text-secondary mb-2">12 pcs / pack</p>
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-semibold">Rp65.000</span>
                                            <a href="#contact" class="btn btn-sm cta-outline">Pesan</a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- produk lain tetap sama strukturnya -->

                        </div>
                    </section>

                </div>
            </section>

            <!-- ================= KEUNGGULAN ================= -->
            <section id="why" class="section section-muted" aria-labelledby="heading-why">
                <div class="container">
                    <div class="row align-items-center g-4">

                        <div class="col-lg-5">
                            <img
                                src="/img/dapur-bintianis.jpg"
                                alt="Proses pembuatan jajanan Arab halal di dapur Bintianis Palu"
                                class="img-fluid rounded"
                                loading="lazy"
                                width="600"
                                height="450"
                            />
                        </div>

                        <div class="col-lg-7">
                            <h2 id="heading-why" class="h1 mb-3">
                                Kenapa Pilih Bintianis?
                            </h2>
                            <p class="text-secondary">
                                Kami adalah toko jajanan rumahan di Palu yang mengutamakan rasa, kebersihan, dan kepraktisan.
                            </p>

                            <ul class="list-unstyled row g-3 mt-3">
                                <li class="col-md-6">
                                    <strong>Otentik & Halal</strong><br>
                                    Resep teruji dengan bahan halal pilihan.
                                </li>
                                <li class="col-md-6">
                                    <strong>Frozen Fresh</strong><br>
                                    Dibekukan cepat tanpa pengawet.
                                </li>
                                <li class="col-md-6">
                                    <strong>Mudah Disajikan</strong><br>
                                    Cocok untuk keluarga sibuk.
                                </li>
                                <li class="col-md-6">
                                    <strong>Terima Katering</strong><br>
                                    Acara kecil hingga besar di Palu.
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>

            <!-- ================= CARA PESAN ================= -->
            <section id="how" class="section" aria-labelledby="heading-how">
                <div class="container text-center">
                    <h2 id="heading-how" class="h1 mb-3">
                        Cara Pesan Jajanan Bintianis
                    </h2>
                    <p class="text-secondary mb-5">
                        Mudah, cepat, dan bisa kirim atau ambil di Palu.
                    </p>

                    <ol class="row g-4 list-unstyled">
                        <li class="col-md-4">
                            <strong>Pilih Produk</strong><br>
                            Tentukan jajanan segar atau beku.
                        </li>
                        <li class="col-md-4">
                            <strong>Hubungi Kami</strong><br>
                            Via WhatsApp atau form pemesanan.
                        </li>
                        <li class="col-md-4">
                            <strong>Siap Dinikmati</strong><br>
                            Kirim atau ambil sesuai jadwal.
                        </li>
                    </ol>
                </div>
            </section>

        </main>

    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';
    import Layout from '@/Layouts/HomeLayout.vue'
    import { showAlert } from '@/Libraries/SwalLibrary';
    defineOptions({ layout: Layout })
</script>