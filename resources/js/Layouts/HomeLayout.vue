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

                            <!-- UBAH INI: dari <a> ke <button> -->
                            <button class="cta-primary text-white btn-pesan-utama" @click="openOrderBar">
                                Pesan Jajanan
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- TAMBAHKAN: ORDER BAR -->
        <div class="order-bar-overlay" :class="{ active: showOrderBar }" @click="closeOrderBar"></div>
        
        <div class="order-bar-container" :class="{ active: showOrderBar }">
            <div class="order-bar-header">
                <h4>🛒 Pesan Jajanan</h4>
                <button class="order-bar-close" @click="closeOrderBar">×</button>
            </div>
            
            <div class="order-bar-body">
                <div class="order-content">
                    <h5>Menu Jajanan</h5>
                    
                    <div class="order-list">
                        <div class="order-item" v-for="item in orderItems" :key="item.id">
                            <div class="order-item-info">
                                <h6>{{ item.name }}</h6>
                                <p>{{ item.description }}</p>
                            </div>
                            <div class="order-item-action">
                                <span class="order-price">Rp {{ formatPrice(item.price) }}</span>
                                <button class="btn-add-to-cart" @click="addToCart(item)">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cart-section" v-if="cartItems.length > 0">
                        <h6>Keranjang ({{ cartItems.length }})</h6>
                        <div class="cart-items">
                            <div v-for="(item, index) in cartItems" :key="index" class="cart-item">
                                <span>{{ item.name }} x{{ item.quantity }}</span>
                                <span>Rp {{ formatPrice(item.price * item.quantity) }}</span>
                            </div>
                        </div>
                        <div class="cart-total">
                            <span>Total:</span>
                            <span>Rp {{ formatPrice(calculateTotal()) }}</span>
                        </div>
                        <button class="btn-checkout" @click="checkout">
                            💬 Pesan via WhatsApp
                        </button>
                    </div>
                    
                    <div v-else class="empty-cart">
                        <p>Keranjang masih kosong</p>
                    </div>
                </div>
            </div>
        </div>

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
    import { ref, provide, onMounted, onUnmounted } from 'vue'
    import { Link } from '@inertiajs/vue3'

    const mode = ref("normal")
    const showOrderBar = ref(false)

    // Data produk
    const orderItems = ref([
        { id: 1, name: 'Kue Lumpur', price: 15000, description: 'Kue lumpur dengan toping keju' },
        { id: 2, name: 'Bolu Kukus', price: 12000, description: 'Bolu kukus mekar pandan' },
        { id: 3, name: 'Nastar Nanas', price: 35000, description: 'Kue nastar isi selai nanas' },
        { id: 4, name: 'Kastengel Keju', price: 32000, description: 'Kue kastengel keju edam' },
        { id: 5, name: 'Putri Salju', price: 30000, description: 'Putri salju tabur gula halus' },
        { id: 6, name: 'Sambusa Daging', price: 8000, description: 'Sambusa isi daging rempah' }
    ])

    // Keranjang
    const cartItems = ref([])

    // Fungsi buka order bar
    const openOrderBar = () => {
        showOrderBar.value = true
        document.body.style.overflow = 'hidden'
    }

    // Fungsi tutup order bar
    const closeOrderBar = () => {
        showOrderBar.value = false
        document.body.style.overflow = 'auto'
    }

    // Tambah ke keranjang
    const addToCart = (product) => {
        const existingItem = cartItems.value.find(item => item.id === product.id)
        
        if (existingItem) {
            existingItem.quantity += 1
        } else {
            cartItems.value.push({
                ...product,
                quantity: 1
            })
        }
    }

    // Format harga
    const formatPrice = (price) => {
        return price.toLocaleString('id-ID')
    }

    // Hitung total
    const calculateTotal = () => {
        return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0)
    }

    // Checkout
    const checkout = () => {
        if (cartItems.value.length === 0) {
            alert('Keranjang masih kosong!')
            return
        }
        
        const message = formatWhatsAppMessage()
        const phone = '6281234567890'
        const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`
        
        window.open(url, '_blank')
        closeOrderBar()
    }

    // Format pesan WhatsApp
    const formatWhatsAppMessage = () => {
        const items = cartItems.value.map(item => 
            `• ${item.name} x${item.quantity}: Rp ${formatPrice(item.price * item.quantity)}`
        ).join('\n')
        
        return `Halo Bintianis! Saya ingin memesan:

${items}

*Total:* Rp ${formatPrice(calculateTotal())}

Terima kasih!`
    }

    const setMode = (newMode) => {
        mode.value = newMode
    }

    const props = defineProps({
        app_tagline: String,
    });

    provide('layoutMode', mode)
    provide('setLayoutMode', setMode)

    // Scroll animation
    let lastScroll = 0

    onMounted(() => {
        const header = document.querySelector('.header-animated')

        const onScroll = () => {
            const currentScroll = window.pageYOffset

            if (!header) return

            if (currentScroll > lastScroll && currentScroll > 100) {
                header.classList.add('header-hidden')
                header.classList.remove('header-show')
            } else {
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
/* CSS ASLI YANG SUDAH ADA */
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

/* ============================================
   CSS ORDER BAR - TAMBAHKAN DI BAWAH INI
   ============================================ */

/* 1. TOMBOL PESAN UTAMA */
.btn-pesan-utama {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border: none;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    color: white;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 16px;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.btn-pesan-utama:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
}

.btn-pesan-utama:active {
    transform: translateY(-1px);
}

/* 2. ORDER BAR OVERLAY */
.order-bar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1040;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.order-bar-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* 3. ORDER BAR CONTAINER */
.order-bar-container {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: 100vh;
    background: white;
    z-index: 1050;
    transition: right 0.3s ease;
    box-shadow: -2px 0 10px rgba(0,0,0,0.1);
}

.order-bar-container.active {
    right: 0;
}

/* 4. ORDER BAR HEADER */
.order-bar-header {
    padding: 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-bar-header h4 {
    margin: 0;
    color: #333;
    font-size: 1.25rem;
}

.order-bar-close {
    background: none;
    border: none;
    font-size: 24px;
    color: #666;
    cursor: pointer;
    padding: 5px;
    line-height: 1;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.2s ease;
}

.order-bar-close:hover {
    background: #e9ecef;
}

/* 5. ORDER BAR BODY */
.order-bar-body {
    padding: 20px;
    height: calc(100vh - 80px);
    overflow-y: auto;
}

.order-content h5 {
    margin-bottom: 20px;
    color: #333;
}

/* 6. ORDER LIST */
.order-list {
    margin-bottom: 25px;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.order-item:last-child {
    border-bottom: none;
}

.order-item-info h6 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #333;
    font-size: 15px;
}

.order-item-info p {
    margin: 0;
    color: #666;
    font-size: 13px;
}

.order-price {
    font-weight: 700;
    color: #f59e0b;
    font-size: 15px;
    margin-right: 15px;
}

.btn-add-to-cart {
    background: #f59e0b;
    color: white;
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}

.btn-add-to-cart:hover {
    background: #d97706;
}

/* 7. CART SECTION */
.cart-section {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    margin-top: 25px;
}

.cart-section h6 {
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 16px;
}

.cart-items {
    margin-bottom: 15px;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px dashed #ddd;
    font-size: 14px;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-total {
    display: flex;
    justify-content: space-between;
    padding-top: 15px;
    margin-top: 15px;
    border-top: 2px solid #fbbf24;
    font-weight: 700;
    color: #333;
    font-size: 17px;
}

/* 8. CHECKOUT BUTTON */
.btn-checkout {
    width: 100%;
    padding: 14px;
    background: #10b981;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background 0.3s ease;
    margin-top: 20px;
}

.btn-checkout:hover {
    background: #059669;
}

/* 9. EMPTY CART */
.empty-cart {
    text-align: center;
    padding: 40px 20px;
    color: #666;
    background: #f9f9f9;
    border-radius: 8px;
    margin-top: 20px;
}

.empty-cart p {
    margin: 0;
}

/* 10. RESPONSIVE */
@media (max-width: 768px) {
    .order-bar-container {
        width: 100%;
        right: -100%;
    }
    
    .btn-pesan-utama {
        padding: 10px 20px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .btn-pesan-utama {
        padding: 8px 16px;
        font-size: 13px;
    }
    
    .order-bar-header {
        padding: 15px;
    }
    
    .order-bar-body {
        padding: 15px;
    }
}

/* 11. CUSTOM SCROLLBAR */
.order-bar-body::-webkit-scrollbar {
    width: 6px;
}

.order-bar-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.order-bar-body::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

.order-bar-body::-webkit-scrollbar-thumb:hover {
    background: #aaa;
}
</style>