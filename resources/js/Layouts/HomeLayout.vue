<template>
    <div class="panel-layout" :key="$page.component">
        <!-- Pengumuman -->
        <div class="topbar py-2">
            <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-warning text-dark fw-semibold">Halal</span>
                    <span>
                        Toko jajanan & kue rumahan di Palu · Spesialis jajanan Arab
                    </span>
                </div>
                <div>
                    Pre-order hidangan nasi segera hadir: Kebuli · Khabsa · Biryani · Mandhi
                </div>
            </div>
        </div>

        <!-- Header / Nav -->
        <nav class="navbar navbar-expand-lg bg-white sticky-top header-animated" aria-label="Navigasi Utama">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="/" aria-label="Bintianis Palu">
                    <img 
                        src="/img/logo-bintianis.png"
                        alt="Bintianis - Toko Jajanan dan Kue di Palu"
                        width="80"
                        height="80"
                        loading="eager"
                    />
                </a>

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navMain"
                    aria-controls="navMain"
                    aria-expanded="false"
                    aria-label="Buka navigasi"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navMain" class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto align-items-lg-center">
    <li class="nav-item">
        <a class="nav-link" href="#products">Pesan Jajan</a>
    </li>

    <li class="nav-item">
        <Link class="nav-link" :href="route('event-order')">Pesan Untuk Acara</Link>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#why">Kenapa Bintianis</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#how">Cara Pesan</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#faq">FAQ</a>
    </li>

    <!-- Tombol Login -->
    <li class="nav-item ms-lg-3 d-flex align-items-center gap-3">
    <a href="/login" class="btn-login">
        Login
    </a>

    <a class="cta-primary text-white" href="#contact">
        Pesan Jajanan
    </a>
</li>
</ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="col-12">
                <slot />
            </div>
        </div>
        <Transition name="fuduts">
            <div v-if="mode === 'loading'" class="loading-wrapper text-center">
                <div class="spinner-wrapper">
                    <div class="spinner-border text-light" style="width: 5rem; height: 5rem;"></div>
                </div>
            </div>
        </Transition>
        <footer style="margin-top:100px;">
            <p class="text-center default-color">Copyright © 2024 All rights
                reserved | This website is developed by <a href="" class="fw-bold default-color">Techno
                Celebes</a>
            </p>
        </footer>
    </div>
</template>

<script setup>
    import { ref, provide } from 'vue'
    import { Link } from '@inertiajs/vue3'

    const mode = ref("normal")

    const setMode = (newMode) => {
        mode.value = newMode
    }

    const props = defineProps({
        app_tagline: String,
    });

    provide('layoutMode', mode)
    provide('setLayoutMode', setMode)
    import { onMounted, onUnmounted } from 'vue'

let lastScroll = 0

onMounted(() => {
    const header = document.querySelector('.header-animated')

    const onScroll = () => {
        const currentScroll = window.pageYOffset

        if (!header) return

        if (currentScroll > lastScroll && currentScroll > 100) {
            // scroll ke bawah → sembunyikan
            header.classList.add('header-hidden')
            header.classList.remove('header-show')
        } else {
            // scroll ke atas → tampilkan
            header.classList.remove('header-hidden')
            header.classList.add('header-show')
        }

        lastScroll = currentScroll
    }

    window.addEventListener('scroll', onScroll)

    onUnmounted(() => {
        window.removeEventListener('scroll', onScroll)
    })
})

</script>

<style scoped>
.admin-layout {
    min-height: 100vh;
    background: #f8fafc;
}

.main-content {
    padding: 30px 0;
    min-height: calc(100vh - 160px);
}

/* Responsive */
@media (max-width: 768px) {
    .main-content {
        padding: 20px 0;
    }
}
</style>