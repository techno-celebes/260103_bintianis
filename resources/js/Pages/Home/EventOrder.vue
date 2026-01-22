<template>
    <div class="container py-4 py-lg-5">
        <!-- Header -->
        <div class="text-center mb-4 mb-lg-5">
            <h1 class="display-5 fw-bold text-primary mb-3">🍽️ Pemesanan Makanan</h1>
            <p class="lead text-muted">Pesan makanan favorit Anda dengan mudah dan cepat</p>
        </div>

        <form @submit.prevent="submitOrder" novalidate>
            <!-- Progress Steps -->
            <div class="card shadow-sm mb-4 mb-lg-5">
                <div class="card-body">
                    <div class="steps">
                        <div class="step" :class="{ 'active': true }">
                            <div class="step-circle">1</div>
                            <div class="step-label">Jenis Pesanan</div>
                        </div>
                        <div class="step" :class="{ 'active': orderType }">
                            <div class="step-circle">2</div>
                            <div class="step-label">Menu Pilihan</div>
                        </div>
                        <div class="step">
                            <div class="step-circle">3</div>
                            <div class="step-label">Pengantaran</div>
                        </div>
                        <div class="step">
                            <div class="step-circle">4</div>
                            <div class="step-label">Kontak</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 1: Jenis Pesanan -->
            <div class="card shadow-sm mb-4">
                <div class="card-header text-black" style="background-color: #c7fcff;">
                    <h2 class="h5 mb-0">1 Pilih Jenis Pesanan</h2>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-3" v-for="option in orderTypeOptions" :key="option.value">
                            <input
                                type="radio"
                                :id="`type-${option.value}`"
                                :value="option.value"
                                v-model="orderType"
                                class="btn-check"
                                autocomplete="off"
                            />
                            <label
                                :for="`type-${option.value}`"
                                class="card card-hover w-100 text-center border-2"
                                :class="{ 'border-primary': orderType === option.value }"
                            >
                                <div class="card-body py-4">
                                    <div class="display-6 mb-3">{{ option.icon }}</div>
                                    <h5 class="card-title mb-2">{{ option.label }}</h5>
                                    <p class="card-text small text-muted mb-0">{{ option.description }}</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Menu Pilihan -->
            <div v-if="orderType" class="card shadow-sm mb-4">
                <div class="card-header text-black" style="background-color: #c7fcff;">
                    <h2 class="h5 mb-0">2. Pilih Menu</h2>
                </div>
                
                <!-- Frozen Snack -->
                <div v-if="orderType === 'frozen'" class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-4" v-for="item in frozenMenu" :key="item.id">
                            <div class="card h-100 border">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ item.name }}</h5>
                                    <div class="text-primary fw-bold fs-5 mb-3">{{ formatRupiah(item.price) }}</div>
                                    <div class="mt-auto">
                                        <label class="form-label small text-muted">Jumlah:</label>
                                        <div class="input-group">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                @click="frozenQty[item.id] = Math.max(0, (frozenQty[item.id] || 0) - 1)"
                                            >
                                                -
                                            </button>
                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control text-center"
                                                v-model.number="frozenQty[item.id]"
                                                @change="frozenQty[item.id] = Math.max(0, frozenQty[item.id])"
                                            />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                @click="frozenQty[item.id] = (frozenQty[item.id] || 0) + 1"
                                            >
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Snack -->
                <div v-if="orderType === 'event'" class="card-body p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-6">
                            <div class="card border">
                                <div class="card-body">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-box-seam me-2"></i>Total Box (minimal 100)
                                    </label>
                                    <input
                                        type="number"
                                        min="100"
                                        class="form-control form-control-lg"
                                        v-model.number="eventForm.totalBoxes"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card border">
                                <div class="card-body">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-puzzle me-2"></i>Snack per Box
                                    </label>
                                    <input
                                        type="number"
                                        min="1"
                                        class="form-control form-control-lg"
                                        v-model.number="eventForm.snacksPerBox"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="include-water"
                                    v-model="eventForm.includeWater"
                                    role="switch"
                                />
                                <label for="include-water" class="form-check-label">
                                    <i class="bi bi-cup-straw me-2"></i>
                                    Sertakan Air Mineral Gelas (+{{ formatRupiah(waterGlassPrice) }} per box)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h6 mb-0">
                            <i class="bi bi-layers me-2"></i>Komposisi Paket per Box
                        </h3>
                        <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            @click="addEventPackage"
                        >
                            <i class="bi bi-plus-circle me-1"></i>Tambah Paket
                        </button>
                    </div>

                    <div v-if="eventForm.packages.length === 0" class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>Tambahkan minimal 1 paket komposisi.
                    </div>

                    <div v-for="(pkg, idx) in eventForm.packages" :key="pkg.uid" class="card border mb-3">
                        <div class="card-body">
                            <div class="row g-3 align-items-end">
                                <div class="col-12 col-md-4 col-lg-3">
                                    <label class="form-label fw-semibold small">Jumlah Box</label>
                                    <input
                                        type="number"
                                        min="1"
                                        class="form-control"
                                        v-model.number="pkg.boxes"
                                    />
                                </div>
                                <div class="col-12 col-md-8 col-lg-9">
                                    <label class="form-label fw-semibold small">
                                        Pilih Snack ({{ eventForm.snacksPerBox }} item per box)
                                    </label>
                                    <div class="row g-2">
                                        <div
                                            class="col-6 col-lg-4 col-xl-3"
                                            v-for="i in eventForm.snacksPerBox"
                                            :key="`sel-${pkg.uid}-${i}`"
                                        >
                                            <select class="form-select" v-model="pkg.selections[i - 1]">
                                                <option disabled value="">-- pilih --</option>
                                                <option v-for="sn in eventSnacksMenu" :key="sn.id" :value="sn.id">
                                                    {{ sn.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="small text-muted">
                                    Subtotal paket ini: 
                                    <span class="fw-bold text-primary">{{ formatRupiah(eventPackageSubtotal(pkg)) }}</span>
                                </div>
                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm"
                                    @click="removeEventPackage(idx)"
                                >
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="alert" :class="{
                        'alert-success': totalAllocatedBoxes === eventForm.totalBoxes,
                        'alert-warning': totalAllocatedBoxes !== eventForm.totalBoxes
                    }">
                        <i class="bi" :class="{
                            'bi-check-circle': totalAllocatedBoxes === eventForm.totalBoxes,
                            'bi-exclamation-triangle': totalAllocatedBoxes !== eventForm.totalBoxes
                        }" me-2></i>
                        Total box teralokasi: <strong>{{ totalAllocatedBoxes }}</strong> dari {{ eventForm.totalBoxes }} box
                        <span v-if="totalAllocatedBoxes !== eventForm.totalBoxes" class="fw-bold">
                            ({{ eventForm.totalBoxes - totalAllocatedBoxes }} box belum dialokasikan)
                        </span>
                    </div>
                </div>

                <!-- Drinks -->
                <div v-if="orderType === 'drinks'" class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-4" v-for="item in drinksMenu" :key="item.id">
                            <div class="card h-100 border">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ item.name }}</h5>
                                    <div class="text-primary fw-bold fs-5 mb-3">{{ formatRupiah(item.price) }}</div>
                                    <div class="mt-auto">
                                        <label class="form-label small text-muted">Jumlah:</label>
                                        <div class="input-group">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                @click="drinksQty[item.id] = Math.max(0, (drinksQty[item.id] || 0) - 1)"
                                            >
                                                -
                                            </button>
                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control text-center"
                                                v-model.number="drinksQty[item.id]"
                                                @change="drinksQty[item.id] = Math.max(0, drinksQty[item.id])"
                                            />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                @click="drinksQty[item.id] = (drinksQty[item.id] || 0) + 1"
                                            >
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rice -->
                <div v-if="orderType === 'rice'" class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-4" v-for="item in riceMenu" :key="item.id">
                            <div class="card h-100 border">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ item.name }}</h5>
                                    <div class="text-primary fw-bold fs-5 mb-3">{{ formatRupiah(item.price) }}</div>
                                    <div class="mt-auto">
                                        <label class="form-label small text-muted">Jumlah:</label>
                                        <div class="input-group">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                @click="riceQty[item.id] = Math.max(0, (riceQty[item.id] || 0) - 1)"
                                            >
                                                -
                                            </button>
                                            <input
                                                type="number"
                                                min="0"
                                                class="form-control text-center"
                                                v-model.number="riceQty[item.id]"
                                                @change="riceQty[item.id] = Math.max(0, riceQty[item.id])"
                                            />
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary"
                                                @click="riceQty[item.id] = (riceQty[item.id] || 0) + 1"
                                            >
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Jadwal & Pengantaran -->
            <div v-if="orderType" class="card shadow-sm mb-4">
                <div class="card-header text-black" style="background-color: #c7fcff;">
                    <h2 class="h5 mb-0">3 Jadwal & Pengantaran</h2>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12 col-lg-6">
                            <div class="card border">
                                <div class="card-body">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-calendar-event me-2"></i>Waktu Diantar/Diambil
                                    </label>
                                    <input type="datetime-local" class="form-control" v-model="delivery.datetime" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card border">
                                <div class="card-body">
                                    <label class="form-label fw-semibold mb-3">Metode Pengiriman</label>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <input
                                                type="radio"
                                                id="met-pickup"
                                                value="pickup"
                                                v-model="delivery.method"
                                                class="btn-check"
                                            />
                                            <label for="met-pickup" class="btn btn-outline-primary w-100">
                                                <i class="bi bi-shop me-2"></i>Ambil di Toko
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input
                                                type="radio"
                                                id="met-delivery"
                                                value="delivery"
                                                v-model="delivery.method"
                                                class="btn-check"
                                            />
                                            <label for="met-delivery" class="btn btn-outline-primary w-100">
                                                <i class="bi bi-truck me-2"></i>Diantar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Pengantaran -->
                        <div v-if="delivery.method === 'delivery'" class="col-12">
                            <div class="card border">
                                <div class="card-body">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-geo-alt me-2"></i>Alamat Tujuan
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control mb-3"
                                        placeholder="Contoh: Jalan Soekarno Hatta No. 123, depan SMP 5"
                                        v-model="delivery.addressText"
                                    />

                                    <div class="row g-4">
                                        <div class="col-12 col-lg-8">
                                            <div class="border rounded overflow-hidden" style="height: 400px">
                                                <div id="map" style="height: 100%; width: 100%"></div>
                                            </div>
                                            <div class="small text-muted mt-2">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Klik pada peta area Kota Palu untuk menentukan lokasi pengantaran.
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="card border">
                                                <div class="card-body">
                                                    <h6 class="fw-semibold mb-3">Informasi Pengiriman</h6>
                                                    
                                                    <div class="mb-3">
                                                        <div class="small text-muted">Titik Toko</div>
                                                        <div class="fw-semibold">
                                                            {{ shopCoords.lat.toFixed(6) }}, {{ shopCoords.lng.toFixed(6) }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3" v-if="delivery.dest">
                                                        <div class="small text-muted">Titik Tujuan</div>
                                                        <div class="fw-semibold">
                                                            {{ delivery.dest.lat.toFixed(6) }}, {{ delivery.dest.lng.toFixed(6) }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <div class="small text-muted">Jarak Tempuh</div>
                                                        <div class="fw-bold fs-4 text-primary">{{ distanceKmDisplay }} km</div>
                                                    </div>
                                                    
                                                    <div class="border-top pt-3">
                                                        <div class="d-flex justify-content-between mb-1">
                                                            <span class="text-muted">Ongkir (Rp 5.000/km)</span>
                                                            <span class="fw-semibold">{{ formatRupiah(deliveryFee) }}</span>
                                                        </div>
                                                        <div class="small text-muted">
                                                            Dibulatkan ke atas per km.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Kontak -->
            <div v-if="orderType" class="card shadow-sm mb-4">
                <div class="card-header text-black" style="background-color: #c7fcff;">
                    <h2 class="h5 mb-0">4 Kontak Pemesan</h2>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <div class="card border">
                                <div class="card-body">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-whatsapp me-2"></i>No. WhatsApp
                                    </label>
                                    <input
                                        type="tel"
                                        class="form-control"
                                        placeholder="08xxxxxxxxxx"
                                        v-model="contact.phone"
                                    />
                                    <div class="form-text">Kami akan menghubungi via WhatsApp</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card border">
                                <div class="card-body">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="nama@email.com"
                                        v-model="contact.email"
                                    />
                                    <div class="form-text">Untuk konfirmasi dan bukti pembayaran</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary & Submit -->
            <div v-if="orderType" class="card shadow-lg mb-4">
                <div class="card-header text-black" style="background-color: #c7fcff;">
                    <h2 class="h5 mb-0">
                        <i class="bi bi-receipt me-2"></i>Ringkasan Pembayaran
                    </h2>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12 col-lg-8">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Subtotal Pesanan</span>
                                    <span class="fw-semibold fs-5">{{ formatRupiah(subtotal) }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Ongkos Kirim</span>
                                    <span class="fw-semibold fs-5">{{ formatRupiah(deliveryFee) }}</span>
                                </div>
                                
                                <hr class="my-2" />
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold fs-5">Total Pembayaran</span>
                                    <span class="fw-bold text-primary fs-4">{{ formatRupiah(grandTotal) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-4">
                            <div class="d-grid">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg py-3"
                                    :disabled="!canSubmit"
                                    :class="{ 'btn-success': canSubmit }"
                                >
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ canSubmit ? 'Buat Pesanan Sekarang' : 'Lengkapi Data' }}
                                </button>
                            </div>
                            
                            <div v-if="!canSubmit" class="alert alert-warning mt-3 mb-0">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Silakan lengkapi semua data pesanan untuk melanjutkan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped>
/* Progress Steps */
.steps {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.steps::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 10%;
    right: 10%;
    height: 2px;
    background-color: #dee2e6;
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    flex: 1;
}

.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #dee2e6;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
    border: 3px solid white;
}

.step.active .step-circle {
    background-color: #0d6efd;
    color: white;
    transform: scale(1.1);
}

.step-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6c757d;
    text-align: center;
}

.step.active .step-label {
    color: #0d6efd;
    font-weight: 600;
}

/* Card Hover Effects */
.card-hover {
    transition: all 0.3s ease;
    cursor: pointer;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Form Controls */
.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Map Container */
#map {
    min-height: 400px;
    border-radius: 0.375rem;
}

/* Summary Card */
.border-primary {
    border-width: 2px !important;
}

/* Button States */
.btn:disabled {
    opacity: 0.65;
}

/* Alert Icons */
.alert i {
    font-size: 1.1em;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .steps::before {
        left: 15%;
        right: 15%;
    }
    
    .step-label {
        font-size: 0.75rem;
    }
    
    .display-5 {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .steps {
        flex-direction: column;
        gap: 1rem;
    }
    
    .steps::before {
        display: none;
    }
    
    .step {
        flex-direction: row;
        gap: 1rem;
        justify-content: flex-start;
    }
    
    .step-circle {
        margin-bottom: 0;
    }
}
</style>


<script setup>
    import { Link } from "@inertiajs/vue3";
    import { ref, onMounted, reactive, watch, computed, nextTick } from "vue";
    import Layout from "@/Layouts/HomeLayout.vue";
    import { showAlert } from "@/Libraries/SwalLibrary";
    import L from "leaflet";
    import "leaflet/dist/leaflet.css";

    defineOptions({ layout: Layout });

    // Harga contoh (bisa ambil dari API/DB di Laravel nantinya)
    const waterGlassPrice = 1000;

    const orderTypeOptions = [
        { value: 'frozen', label: 'Frozen Snack', icon: '❄️', description: 'Snack beku siap saji' },
        { value: 'event', label: 'Snack Event', icon: '🎉', description: 'Paket event ≥ 100 box' },
        { value: 'drinks', label: 'Minuman', icon: '🥤', description: 'Berbagai minuman segar' },
        { value: 'rice', label: 'Nasi Arab', icon: '🍚', description: 'Nasi arab spesial' }
    ];

    const eventSnacksMenu = [
        { id: "sambosa", name: "Sambosa", price: 3000 },
        { id: "hummus", name: "Hummus", price: 3500 },
        { id: "kripik-beras", name: "Kripik Beras", price: 2000 },
        { id: "pie", name: "Pie", price: 4000 },
        { id: "mangga-snack", name: "Snack Mangga", price: 3500 },
    ];

    const frozenMenu = [
        { id: "froz-samosa-10", name: "Samosa Frozen (10 pcs)", price: 25000 },
        { id: "froz-risoles-10", name: "Risoles Frozen (10 pcs)", price: 22000 },
        { id: "froz-pie-10", name: "Pie Frozen (10 pcs)", price: 28000 },
    ];

    const drinksMenu = [
        { id: "es-teh", name: "Es Teh", price: 5000 },
        { id: "jus-mangga", name: "Jus Mangga", price: 12000 },
        { id: "air-gelas", name: "Air Mineral Gelas", price: 1000 },
    ];

    const riceMenu = [
        { id: "nasi-arab-ayam", name: "Nasi Arab Ayam", price: 25000 },
        { id: "nasi-arab-kambing", name: "Nasi Arab Kambing", price: 45000 },
    ];

    // State umum
    const orderType = ref("");
    const contact = reactive({
        phone: "",
        email: "",
    });

    // Frozen
    const frozenQty = reactive({});
    frozenMenu.forEach((i) => (frozenQty[i.id] = 0));

    // Drinks
    const drinksQty = reactive({});
    drinksMenu.forEach((i) => (drinksQty[i.id] = 0));

    // Rice
    const riceQty = reactive({});
    riceMenu.forEach((i) => (riceQty[i.id] = 0));

    // Event form
    const uid = () => Math.random().toString(36).slice(2, 9);
    const eventForm = reactive({
        totalBoxes: 100,
        snacksPerBox: 3,
        includeWater: false,
        packages: [
            {
                uid: uid(),
                boxes:100,
                selections: Array.from({ length: 3}, () => "")
            }
        ], // { uid, boxes, selections[] }
    });
    const addEventPackage = () => {
        eventForm.packages.push({
            uid: uid(),
            boxes: 0,
            selections: Array.from({ length: eventForm.snacksPerBox }, () => ""),
        });
    };
    const removeEventPackage = (idx) => {
        eventForm.packages.splice(idx, 1);
    };
    

    watch(
        () => eventForm.snacksPerBox,
        (n) => {
            // Sesuaikan jumlah pilihan di tiap paket
            eventForm.packages.forEach((pkg) => {
                if (n > pkg.selections.length) {
                    for (let i = pkg.selections.length; i < n; i++) pkg.selections.push("");
                } else if (n < pkg.selections.length) {
                    pkg.selections.splice(n);
                }
            });
        }
    );

    // Delivery & Map
    const delivery = reactive({
        method: "pickup", // 'pickup' | 'delivery'
        datetime: "",
        addressText: "",
        dest: null, // { lat, lng }
    });

    const shopCoords = reactive({
        // Koordinat pusat Kota Palu (contoh). Ganti sesuai lokasi toko Anda.
        lat: -0.900992,
        lng: 119.873947,
    });

    let map, shopMarker, destMarker, routeLine;

    const initMap = () => {
        if (map) return;
        map = L.map("map").setView([shopCoords.lat, shopCoords.lng], 13);
        // OSM Tile Layer (OpenStreetMap API)
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: "&copy; OpenStreetMap",
        }).addTo(map);

        shopMarker = L.marker([shopCoords.lat, shopCoords.lng], { draggable: false }).addTo(map).bindPopup("Toko");

        map.on("click", (e) => {
            const { lat, lng } = e.latlng;
            setDestination(lat, lng);
        });

        if (delivery.dest) setDestination(delivery.dest.lat, delivery.dest.lng);
    };

    const setDestination = (lat, lng) => {
        delivery.dest = { lat, lng };
        if (destMarker) {
            destMarker.setLatLng([lat, lng]);
        } else {
            destMarker = L.marker([lat, lng]).addTo(map).bindPopup("Tujuan");
        }
        if (routeLine) routeLine.remove();
        routeLine = L.polyline(
            [
                [shopCoords.lat, shopCoords.lng],
                [lat, lng],
            ],
            { color: "blue", dashArray: "4,6" }
        ).addTo(map);
        fitRouteBounds();
    };

    const fitRouteBounds = () => {
        if (!map || !delivery.dest) return;
        const group = L.featureGroup([shopMarker, destMarker]);
        map.fitBounds(group.getBounds().pad(0.3));
    };

    watch(
        () => delivery.method,
        async (val) => {
            if (val === "delivery") {
                await nextTick();
                initMap();
                setTimeout(() => {
                    if (map) map.invalidateSize();
                }, 100);
            }
        }
    );

    // Perhitungan jarak (Haversine)
    const distanceKm = computed(() => {
        if (!delivery.dest) return 0;
        const R = 6371; // km
        const toRad = (d) => (d * Math.PI) / 180;
        const dLat = toRad(delivery.dest.lat - shopCoords.lat);
        const dLng = toRad(delivery.dest.lng - shopCoords.lng);
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(toRad(shopCoords.lat)) *
                Math.cos(toRad(delivery.dest.lat)) *
                Math.sin(dLng / 2) *
                Math.sin(dLng / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    });
    const distanceKmDisplay = computed(() => (distanceKm.value ? distanceKm.value.toFixed(2) : "0.00"));
    const deliveryFee = computed(() => {
        if (delivery.method !== "delivery" || !delivery.dest) return 0;
        const km = Math.ceil(distanceKm.value); // dibulatkan ke atas per km
        return km * 5000;
    });

    // Subtotal per jenis
    const frozenSubtotal = computed(() => {
        return frozenMenu.reduce((sum, item) => sum + (frozenQty[item.id] || 0) * item.price, 0);
    });
    const drinksSubtotal = computed(() => {
        return drinksMenu.reduce((sum, item) => sum + (drinksQty[item.id] || 0) * item.price, 0);
    });
    const riceSubtotal = computed(() => {
        return riceMenu.reduce((sum, item) => sum + (riceQty[item.id] || 0) * item.price, 0);
    });

    const eventPackageSubtotal = (pkg) => {
        // price per box based on selections
        const perBox = pkg.selections.reduce((acc, sel) => {
            const s = eventSnacksMenu.find((x) => x.id === sel);
            return acc + (s ? s.price : 0);
        }, 0);
        const water = eventForm.includeWater ? waterGlassPrice : 0;
        return (perBox + water) * (pkg.boxes || 0);
    };

    const eventSubtotal = computed(() => {
        return eventForm.packages.reduce((sum, pkg) => sum + eventPackageSubtotal(pkg), 0);
    });

    const subtotal = computed(() => {
        switch (orderType.value) {
            case "frozen":
                return frozenSubtotal.value;
            case "event":
                return eventSubtotal.value;
            case "drinks":
                return drinksSubtotal.value;
            case "rice":
                return riceSubtotal.value;
            default:
                return 0;
        }
    });

    const grandTotal = computed(() => subtotal.value + deliveryFee.value);

    // Validasi
    const hasAnyQty = (obj) => Object.values(obj).some((v) => Number(v) > 0);

    const totalAllocatedBoxes = computed(() => eventForm.packages.reduce((s, p) => s + (Number(p.boxes) || 0), 0));
    const isEventValid = computed(() => {
        if (orderType.value !== "event") return true;
        if (!eventForm.totalBoxes || eventForm.totalBoxes < 100) return false;
        if (totalAllocatedBoxes.value !== Number(eventForm.totalBoxes)) return false;
        // tiap paket harus punya selections lengkap dan valid
        for (const pkg of eventForm.packages) {
            if (!pkg.boxes || pkg.boxes < 1) return false;
            if (pkg.selections.length !== eventForm.snacksPerBox) return false;
            if (pkg.selections.some((sel) => !sel)) return false;
        }
        return true;
    });

    const isItemsValid = computed(() => {
        switch (orderType.value) {
            case "frozen":
                return hasAnyQty(frozenQty);
            case "drinks":
                return hasAnyQty(drinksQty);
            case "rice":
                return hasAnyQty(riceQty);
            case "event":
                return isEventValid.value;
            default:
                return false;
        }
    });

    const isDeliveryValid = computed(() => {
        if (!delivery.datetime) return false;
        if (delivery.method === "delivery") {
            if (!delivery.dest) return false;
        }
        return true;
    });

    const isContactValid = computed(() => {
        const phoneOk = contact.phone && /^0\d{8,15}$/.test(contact.phone);
        const emailOk = contact.email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(contact.email);
        return phoneOk && emailOk;
    });

    const canSubmit = computed(() => {
        if (!orderType.value) return false;
        if (!isItemsValid.value) return false;
        if (!isDeliveryValid.value) return false;
        if (!isContactValid.value) return false;
        return true;
    });

    // Helpers
    const formatRupiah = (val) => {
        return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", maximumFractionDigits: 0 }).format(
            val || 0
        );
    };

    // Submit
    const submitOrder = async () => {
        if (!canSubmit.value) {
            showAlert("Lengkapi semua data pesanan sebelum melanjutkan.", "warning");
            return;
        }

        // Susun payload
        const payload = {
            type: orderType.value,
            items: {},
            event: null,
            delivery: {
                method: delivery.method,
                datetime: delivery.datetime,
                addressText: delivery.addressText,
                dest: delivery.dest,
                distanceKm: Number(distanceKm.value.toFixed(2)),
                fee: deliveryFee.value,
            },
            contact: { ...contact },
            subtotal: subtotal.value,
            total: grandTotal.value,
        };

        if (orderType.value === "frozen") {
            payload.items = Object.fromEntries(Object.entries(frozenQty).filter(([_, q]) => Number(q) > 0));
        } else if (orderType.value === "drinks") {
            payload.items = Object.fromEntries(Object.entries(drinksQty).filter(([_, q]) => Number(q) > 0));
        } else if (orderType.value === "rice") {
            payload.items = Object.fromEntries(Object.entries(riceQty).filter(([_, q]) => Number(q) > 0));
        } else if (orderType.value === "event") {
            payload.event = {
                totalBoxes: eventForm.totalBoxes,
                snacksPerBox: eventForm.snacksPerBox,
                includeWater: eventForm.includeWater,
                packages: eventForm.packages.map((p) => ({ boxes: p.boxes, selections: p.selections })),
            };
        }

        try {
            // Contoh kirim ke Laravel via Inertia (sesuaikan route)
            // await router.post(route('orders.store'), payload);

            // Untuk demo:
            console.log("ORDER PAYLOAD", payload);
            showAlert("Pesanan berhasil dibuat! Kami akan menghubungi Anda.", "success");
        } catch (e) {
            console.error(e);
            showAlert("Terjadi kesalahan saat membuat pesanan.", "error");
        }
    };

    onMounted(() => {
        // Optional: set default waktu 24 jam dari sekarang
        const dt = new Date(Date.now() + 24 * 60 * 60 * 1000);
        const pad = (n) => n.toString().padStart(2, "0");
        delivery.datetime = `${dt.getFullYear()}-${pad(dt.getMonth() + 1)}-${pad(dt.getDate())}T${pad(dt.getHours())}:${pad(dt.getMinutes())}`;
    });
</script>

<style>
    /* Perbaikan icon leaflet jika diperlukan (tergantung bundler) */
    .leaflet-container {
        font: inherit;
    }
</style>
