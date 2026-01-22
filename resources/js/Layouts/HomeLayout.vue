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

                            <!-- TOMBOL PESAN JAJANAN DENGAN ANIMASI -->
                            <button class="btn-pesan-jajan-utama" @click="openOrderBar">
                                <span class="btn-icon">🛒</span>
                                <span class="btn-text">Pesan Jajanan</span>
                                <span class="btn-pulse"></span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- ORDER BAR MODAL TENGAH DENGAN ANIMASI -->
        <Transition name="order-modal">
            <div v-if="showOrderBar" class="order-modal-overlay" @click.self="closeOrderBar">
                <div class="order-modal-container">
                    <!-- Header dengan animasi slide -->
                    <div class="order-modal-header">
                        <div class="order-modal-title">
                            <div class="title-icon">🍰</div>
                            <h3>Pesan Jajanan Bintianis</h3>
                            <p class="subtitle">Pilih jajanan favorit Anda</p>
                        </div>
                        <button class="order-modal-close" @click="closeOrderBar">
                            <span class="close-icon">×</span>
                        </button>
                    </div>

                    <!-- Body dengan tab navigation -->
                    <div class="order-modal-body">
                        <!-- Tab Navigation -->
                        <div class="order-tabs">
                            <button 
                                class="order-tab" 
                                :class="{ active: activeTab === 'menu' }"
                                @click="activeTab = 'menu'"
                            >
                                <span class="tab-icon">📋</span>
                                Menu
                            </button>
                            <button 
                                class="order-tab" 
                                :class="{ active: activeTab === 'cart' }"
                                @click="activeTab = 'cart'"
                            >
                                <span class="tab-icon">🛒</span>
                                Keranjang
                                <span v-if="cartItems.length > 0" class="cart-badge">
                                    {{ cartItems.length }}
                                </span>
                            </button>
                        </div>

                        <!-- Content: Menu -->
                        <Transition name="tab-fade" mode="out-in">
                            <div v-if="activeTab === 'menu'" class="menu-section">
                                <div class="menu-grid">
                                    <div 
                                        v-for="item in orderItems" 
                                        :key="item.id" 
                                        class="menu-card"
                                        @click="addToCart(item)"
                                    >
                                        <div class="menu-card-image">
                                            <div class="image-placeholder">
                                                {{ item.emoji }}
                                            </div>
                                            <div class="menu-card-badge">🔥 Terlaris</div>
                                        </div>
                                        <div class="menu-card-content">
                                            <h4>{{ item.name }}</h4>
                                            <p class="menu-description">{{ item.description }}</p>
                                            <div class="menu-card-footer">
                                                <span class="menu-price">Rp {{ formatPrice(item.price) }}</span>
                                                <button class="btn-add" @click.stop="addToCart(item)">
                                                    <span class="add-icon">+</span>
                                                    Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content: Cart -->
                            <div v-else-if="activeTab === 'cart'" class="cart-section">
                                <Transition name="cart-animation" mode="out-in">
                                    <div v-if="cartItems.length === 0" class="empty-cart">
                                        <div class="empty-icon">🛒</div>
                                        <h4>Keranjang Kosong</h4>
                                        <p>Belum ada item di keranjang</p>
                                        <button class="btn-browse-menu" @click="activeTab = 'menu'">
                                            Lihat Menu
                                        </button>
                                    </div>

                                    <div v-else>
                                        <!-- Cart Items -->
                                        <div class="cart-items-container">
                                            <div 
                                                v-for="(item, index) in cartItems" 
                                                :key="index" 
                                                class="cart-item"
                                            >
                                                <div class="cart-item-info">
                                                    <div class="cart-item-header">
                                                        <h5>{{ item.name }}</h5>
                                                        <button class="btn-remove" @click="removeFromCart(index)">
                                                            ✕
                                                        </button>
                                                    </div>
                                                    <p class="cart-item-desc">{{ item.description }}</p>
                                                </div>
                                                <div class="cart-item-controls">
                                                    <div class="quantity-control">
                                                        <button class="qty-btn minus" @click="decreaseQuantity(index)">
                                                            −
                                                        </button>
                                                        <span class="qty-value">{{ item.quantity }}</span>
                                                        <button class="qty-btn plus" @click="increaseQuantity(index)">
                                                            +
                                                        </button>
                                                    </div>
                                                    <div class="cart-item-total">
                                                        Rp {{ formatPrice(item.price * item.quantity) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Order Summary -->
                                        <div class="order-summary">
                                            <div class="summary-row">
                                                <span>Subtotal</span>
                                                <span>Rp {{ formatPrice(calculateSubtotal()) }}</span>
                                            </div>
                                            <div class="summary-row">
                                                <span>Ongkos Kirim</span>
                                                <span>Rp 15.000</span>
                                            </div>
                                            <div class="summary-row total">
                                                <span>Total Pembayaran</span>
                                                <span class="total-amount">Rp {{ formatPrice(calculateTotal()) }}</span>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="cart-actions">
                                            <button class="btn-continue" @click="activeTab = 'menu'">
                                                ↶ Tambah Lagi
                                            </button>
                                            <button class="btn-checkout" @click="checkout">
                                                <span class="whatsapp-icon">💬</span>
                                                Pesan via WhatsApp
                                            </button>
                                        </div>
                                    </div>
                                </Transition>
                            </div>
                        </Transition>
                    </div>
                </div>
            </div>
        </Transition>

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
    const activeTab = ref('menu')

    // Data produk lengkap dengan emoji
    const orderItems = ref([
        { id: 1, name: 'Kue Lumpur', price: 15000, description: 'Kue lumpur dengan toping keju meleleh', emoji: '🍮' },
        { id: 2, name: 'Bolu Kukus', price: 12000, description: 'Bolu kukus mekar rasa pandan', emoji: '🍰' },
        { id: 3, name: 'Nastar Nanas', price: 35000, description: 'Kue nastar dengan selai nanas homemade', emoji: '🥮' },
        { id: 4, name: 'Kastengel Keju', price: 32000, description: 'Kue kastengel keju edam premium', emoji: '🧀' },
        { id: 5, name: 'Putri Salju', price: 30000, description: 'Putri salju dengan taburan gula halus', emoji: '❄️' },
        { id: 6, name: 'Sambusa Daging', price: 8000, description: 'Sambusa isi daging dengan rempah khas', emoji: '🌯' },
        { id: 7, name: 'Baklava Madu', price: 25000, description: 'Baklava khas Arab dengan madu asli', emoji: '🍯' },
        { id: 8, name: 'Maamoul Kurma', price: 28000, description: 'Kue kurma khas Timur Tengah', emoji: '🌴' }
    ])

    // Keranjang
    const cartItems = ref([])

    // Fungsi buka order bar dengan efek keren
    const openOrderBar = () => {
        showOrderBar.value = true
        document.body.style.overflow = 'hidden'
        activeTab.value = 'menu'
        
        // Tambah efek ripple pada tombol
        const button = event.target.closest('.btn-pesan-jajan-utama')
        if (button) {
            button.classList.add('clicked')
            setTimeout(() => button.classList.remove('clicked'), 300)
        }
    }

    // Fungsi tutup order bar dengan animasi
    const closeOrderBar = () => {
        showOrderBar.value = false
        document.body.style.overflow = 'auto'
    }

    // Tambah ke keranjang dengan animasi
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
        
        // Pindah ke tab cart dan show notification
        activeTab.value = 'cart'
        showNotification(`${product.name} ditambahkan!`)
    }

    // Fungsi quantity
    const increaseQuantity = (index) => {
        cartItems.value[index].quantity += 1
    }

    const decreaseQuantity = (index) => {
        if (cartItems.value[index].quantity > 1) {
            cartItems.value[index].quantity -= 1
        } else {
            removeFromCart(index)
        }
    }

    const removeFromCart = (index) => {
        const removedItem = cartItems.value[index]
        cartItems.value.splice(index, 1)
        showNotification(`${removedItem.name} dihapus`)
    }

    // Hitung total
    const calculateSubtotal = () => {
        return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0)
    }

    const calculateTotal = () => {
        return calculateSubtotal() + 15000 // + ongkir
    }

    // Format harga
    const formatPrice = (price) => {
        return price.toLocaleString('id-ID')
    }

    // Checkout
    const checkout = () => {
        if (cartItems.value.length === 0) {
            showNotification('Keranjang masih kosong!', 'error')
            return
        }
        
        const message = formatWhatsAppMessage()
        const phone = '6281234567890'
        const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`
        
        // Simulasi loading sebelum buka WhatsApp
        setTimeout(() => {
            window.open(url, '_blank')
            closeOrderBar()
            showNotification('Pesanan berhasil! Membuka WhatsApp...', 'success')
        }, 500)
    }

    // Format pesan WhatsApp
    const formatWhatsAppMessage = () => {
        const items = cartItems.value.map(item => 
            `• ${item.name} x${item.quantity}: Rp ${formatPrice(item.price * item.quantity)}`
        ).join('\n')
        
        return `Halo Bintianis! Saya ingin memesan:

${items}

*Subtotal:* Rp ${formatPrice(calculateSubtotal())}
*Ongkir:* Rp 15.000
*Total:* Rp ${formatPrice(calculateTotal())}

Terima kasih!`
    }

    // Notification system
    const showNotification = (message, type = 'success') => {
        // Implementasi sederhana
        console.log(`[${type.toUpperCase()}] ${message}`)
    }

    const setMode = (newMode) => {
        mode.value = newMode
    }

    const props = defineProps({
        app_tagline: String,
    });

    provide('layoutMode', mode)
    provide('setLayoutMode', setMode)

    // Keyboard shortcut
    onMounted(() => {
        // ESC untuk close modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && showOrderBar.value) {
                closeOrderBar()
            }
        })
        
        const header = document.querySelector('.header-animated')
        let lastScroll = 0

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
            document.removeEventListener('keydown', closeOrderBar)
        })
    })
</script>

<style>
/* HANYA IMPORT CSS DARI FILE TERPISAH */
@import '../../css/order.css';
</style>