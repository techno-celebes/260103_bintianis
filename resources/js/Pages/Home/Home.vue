<template>
    <div class="home-page">
        <!-- HERO SECTION -->
        <header class="hero-arabic bg-arabic-light bg-arabic-pattern">
            <div class="container">
                <div class="row align-items-center g-4 g-lg-5">
                    
                    <!-- TEXT CONTENT -->
                    <div class="col-lg-6">
                        <!-- Trust Badges -->
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <span class="badge-arabic">
                                🏆 Toko Terbaik Palu
                            </span>
                            <span class="badge-arabic-outline">
                                📍 Sejak 2018
                            </span>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="display-4 fw-bold mb-3 text-arabic-brown">
                            <span class="text-arabic-gold">Bintianis</span><br>
                            Kelezatan Arab Autentik di Palu
                        </h1>

                        <!-- Description -->
                        <p class="lead mb-4">
                            <strong>Toko jajanan & kue rumahan premium di Palu</strong> yang menghadirkan 
                            cita rasa Timur Tengah asli. Dari samosa gurih hingga baklava manis, 
                            setiap hidangan dibuat dengan resep turun-temurun.
                        </p>

                        <!-- Rating -->
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-white p-2 rounded-3 shadow-sm d-inline-flex align-items-center">
                                <div class="text-warning">
                                    ★★★★★
                                </div>
                                <span class="ms-2 fw-bold text-arabic-brown">4.9/5</span>
                            </div>
                            <small class="text-secondary">
                                <i class="bi bi-people-fill text-arabic-gold"></i> 500+ pelanggan puas
                            </small>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <a href="#products" class="btn-arabic-primary">
                                <i class="bi bi-cart3 me-2"></i> Pesan Sekarang
                            </a>
                            <a href="#contact" class="btn-arabic-outline">
                                <i class="bi bi-whatsapp me-2"></i> Konsultasi Menu
                            </a>
                        </div>

                        <!-- Trust Points -->
                        <div class="row g-3 mt-4">
                            <div class="col-md-4">
                                <div class="trust-badge">
                                    <i class="bi bi-shield-check text-success fs-4 d-block mb-2"></i>
                                    <small class="fw-semibold text-arabic-brown">100% Halal</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="trust-badge">
                                    <i class="bi bi-house-heart text-arabic-gold fs-4 d-block mb-2"></i>
                                    <small class="fw-semibold text-arabic-brown">Home Made</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="trust-badge">
                                    <i class="bi bi-truck text-primary fs-4 d-block mb-2"></i>
                                    <small class="fw-semibold text-arabic-brown">Gratis Ongkir</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HERO IMAGE -->
                    <div class="col-lg-6">
                        <div class="position-relative float-animation">
                            <div class="hero-arabic-image-frame">
                                <div class="ratio ratio-4x3">
                                    <img
                                        src="/img/hero-png.jpg"
                                        alt="Aneka jajanan Arab Bintianis Palu - Samosa, Kubba, Baklava"
                                        class="img-fluid rounded-3"
                                        loading="eager"
                                        width="800"
                                        height="600"
                                    />
                                </div>
                            </div>
                            <!-- Image Badge -->
                            <div class="position-absolute bottom-0 start-0 m-3">
                                <div class="bg-white px-3 py-2 rounded-3 shadow">
                                    <small class="text-arabic-brown fw-semibold">
                                        <i class="bi bi-award-fill text-arabic-gold me-1"></i> Best Seller 2024
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- PRODUCTS SECTION -->
        <section id="products" class="section-arabic">
            <div class="container">
                <!-- Section Header -->
                <div class="text-center mb-5">
                    <h2 class="section-title-arabic h1 fw-bold text-arabic-brown">
                        🍽️ Menu Andalan
                    </h2>
                    <p class="text-secondary lead">
                        Pilih dari berbagai jajanan Arab berkualitas, tersedia segar maupun beku
                    </p>
                </div>

                <!-- Product Cards -->
                <div class="row g-4">
                    <!-- Frozen Products -->
                    <div class="col-md-6 col-lg-4" v-for="product in products" :key="product.id">
                        <div class="card-arabic h-100">
                            <!-- Ribbon for Coming Soon -->
                            
                            <!-- Product Image -->
                            <div class="position-relative overflow-hidden">
                                <img
                                    :src="product.image"
                                    :alt="product.alt"
                                    class="card-img-top"
                                    loading="lazy"
                                />
                                <!-- Category Badge -->
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge" :class="product.badgeClass">
                                        {{ product.badgeText }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Body -->
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="icon-arabic-wrapper me-3">
                                        <i :class="product.icon" class="icon-arabic"></i>
                                    </div>
                                    <div>
                                        <h3 class="h5 fw-bold text-arabic-brown mb-2">{{ product.title }}</h3>
                                        <p class="text-secondary small mb-0">{{ product.description }}</p>
                                    </div>
                                </div>

                                <!-- Features List -->
                                <ul class="list-unstyled mb-4">
                                    <li v-for="feature in product.features" :key="feature" class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <small class="text-secondary">{{ feature }}</small>
                                    </li>
                                </ul>

                                <!-- Price & CTA -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div v-if="product.price">
                                        <span class="h5 fw-bold text-arabic-gold">{{ product.price }}</span>
                                        <small class="text-secondary d-block">{{ product.priceNote }}</small>
                                    </div>
                                    <a :href="product.ctaLink" class="btn btn-sm" :class="product.ctaClass">
                                        {{ product.ctaText }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- WHY CHOOSE US -->
        <section class="section-arabic bg-arabic-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title-arabic h1 fw-bold text-arabic-brown">
                        ✨ Kenapa Bintianis?
                    </h2>
                    <p class="text-secondary lead">
                        Keunggulan yang membuat pelanggan setia kembali
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3" v-for="feature in features" :key="feature.id">
                        <div class="text-center p-4 h-100">
                            <div class="icon-arabic-wrapper mx-auto mb-3">
                                <i :class="feature.icon" class="icon-arabic fs-3"></i>
                            </div>
                            <h4 class="h5 fw-bold text-arabic-brown mb-3">{{ feature.title }}</h4>
                            <p class="text-secondary small">{{ feature.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- HOW TO ORDER -->
        <section class="section-arabic">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title-arabic h1 fw-bold text-arabic-brown">
                        📦 Cara Pesan Mudah
                    </h2>
                    <p class="text-secondary lead">
                        Hanya 3 langkah untuk menikmati kelezatan Bintianis
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4" v-for="(step, index) in orderSteps" :key="index">
                        <div class="text-center p-4">
                            <!-- Step Number -->
                            <div class="rounded-circle bg-arabic-light d-inline-flex align-items-center justify-content-center mb-4" 
                                 style="width: 70px; height: 70px; border: 3px solid var(--color-secondary);">
                                <span class="h3 fw-bold text-arabic-gold">{{ index + 1 }}</span>
                            </div>
                            
                            <h4 class="h5 fw-bold text-arabic-brown mb-3">{{ step.title }}</h4>
                            <p class="text-secondary mb-0">{{ step.description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Final CTA -->
                <div class="text-center mt-5">
                    <div class="bg-white p-5 rounded-4 shadow-sm border border-arabic-light">
                        <h3 class="h4 fw-bold text-arabic-brown mb-3">Siap Menikmati Kelezatan Arab?</h3>
                        <p class="text-secondary mb-4">Pesan sekarang via WhatsApp untuk respon cepat</p>
                        <a href="#contact" class="btn-arabic-primary px-5">
                            <i class="bi bi-whatsapp me-2"></i> Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Layout from '@/Layouts/HomeLayout.vue';
import { showAlert } from '@/Libraries/SwalLibrary';

// Setup layout
defineOptions({ layout: Layout });

// Import CSS file
import '../../../css/home.css';

// Data Products
const products = ref([
    {
        id: 1,
        title: "Camilan Beku Premium",
        description: "Solusi praktis untuk keluarga sibuk. Tinggal goreng atau panggang.",
        image: "/img/product-1.jpg",
        alt: "Camilan Arab beku Bintianis Palu",
        icon: "bi bi-snow2",
        badgeClass: "bg-primary",
        badgeText: "Frozen",
        features: ["Samosa ayam & sapi", "Kubba original", "Baklava bites"],
        price: "Mulai Rp 45.000",
        priceNote: "Per pack 12 pcs",
        ctaLink: "#best-sellers",
        ctaClass: "btn-arabic-outline",
        ctaText: "Lihat Produk",
        comingSoon: false
    },
    {
        id: 2,
        title: "Camilan Segar Hari Ini",
        description: "Dibuat fresh sesuai pesanan, cocok untuk acara spesial.",
        image: "/img/product-2.jpg",
        alt: "Camilan Arab segar Bintianis",
        icon: "bi bi-clock-fill",
        badgeClass: "bg-success",
        badgeText: "Fresh Daily",
        features: ["Dibuat hari yang sama", "Bisa request pedas", "Paket piring pesta"],
        price: "Mulai Rp 65.000",
        priceNote: "Minimal order 20 pcs",
        ctaLink: "#contact",
        ctaClass: "btn-arabic-primary",
        ctaText: "Pesan Sekarang",
        comingSoon: false
    },
    {
        id: 3,
        title: "Nasi Arab Autentik",
        description: "Nasi Kebuli, Mandhi, Biryani dengan rempah pilihan.",
        image: "/img/product-3.jpg",
        alt: "Nasi Arab khas Timur Tengah",
        icon: "bi bi-egg-fried",
        badgeClass: "bg-warning",
        badgeText: "Pre-Order",
        features: ["Nasi Kebuli kambing", "Mandhi ayam", "Biryani spesial"],
        price: "Mulai Rp 85.000",
        priceNote: "Porsi 2-3 orang",
        ctaLink: "#rice",
        ctaClass: "btn-arabic-outline",
        ctaText: "Info Launch",
        comingSoon: true
    }
]);

// Features Data
const features = ref([
    {
        id: 1,
        icon: "bi bi-shield-check",
        title: "100% Halal",
        description: "Bahan bersertifikat halal dan proses higienis"
    },
    {
        id: 2,
        icon: "bi bi-house-heart",
        title: "Home Made",
        description: "Dibuat dengan cinta di dapur rumahan"
    },
    {
        id: 3,
        icon: "bi bi-star",
        title: "Resep Autentik",
        description: "Resep turun-temurun asli Timur Tengah"
    },
    {
        id: 4,
        icon: "bi bi-truck",
        title: "Gratis Ongkir",
        description: "Area Palu untuk order tertentu"
    }
]);

// Order Steps
const orderSteps = ref([
    {
        title: "Pilih Produk",
        description: "Tentukan jajanan segar atau beku yang Anda inginkan"
    },
    {
        title: "Hubungi Kami",
        description: "Kirim pesan via WhatsApp atau telepon untuk konfirmasi"
    },
    {
        title: "Siap Dinikmati",
        description: "Ambil di tempat atau kami antar ke alamat Anda"
    }
]);

// 
onMounted(() => {
    console.log('Home page mounted');
   
});
</script>

<style scoped>
/* CSS minimal hanya untuk yang  perlu */
.home-page {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* gambar responsif */
.img-fluid {
    max-width: 100%;
    height: auto;
}

/* Tambahan style khusus yang perlu scoped */
:deep(.text-arabic-brown) {
    color: #8B4513;
}

:deep(.text-arabic-gold) {
    color: #D4A017;
}
</style>