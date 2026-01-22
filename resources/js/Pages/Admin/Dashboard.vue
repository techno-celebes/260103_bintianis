<template>
  <div class="min-vh-100 bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-dark bg-dark shadow-sm sticky-top">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">
          <i class="bi bi-speedometer2"></i> Bintianis Admin Panel
        </span>
        <div class="ms-auto">
          <button
            @click="logout"
            class="btn btn-outline-light btn-sm"
          >
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </div>
      </div>
    </nav>

    <div class="container-fluid py-4">
      <!-- Header -->
      <div class="row mb-4">
        <div class="col">
          <h2 class="h2 fw-bold text-dark">
            <i class="bi bi-house-fill text-primary"></i> Dashboard Admin
          </h2>
          <p class="text-muted">Selamat datang di panel admin Bintianis</p>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm h-100 bg-primary text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1">Total Pemesanan</p>
                  <h4 class="card-title mb-0">{{ totalBookings }}</h4>
                </div>
                <i class="bi bi-calendar-check fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm h-100 bg-info text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1">Pengguna</p>
                  <h4 class="card-title mb-0">{{ totalUsers }}</h4>
                </div>
                <i class="bi bi-people-fill fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm h-100 bg-success text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1">Dikonfirmasi</p>
                  <h4 class="card-title mb-0">{{ confirmedCount }}</h4>
                </div>
                <i class="bi bi-check-circle-fill fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm h-100 bg-danger text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1">Menunggu</p>
                  <h4 class="card-title mb-0">{{ pendingCount }}</h4>
                </div>
                <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Menu Cards -->
      <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
          <Link href="/admin/bookings" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 transition-all" style="cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;" @mouseenter="e => e.currentTarget.parentElement.classList.add('shadow-lg')" @mouseleave="e => e.currentTarget.parentElement.classList.remove('shadow-lg')">
              <div class="card-body text-center py-5">
                <div class="mb-3">
                  <i class="bi bi-clipboard-checklist text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h5 class="card-title fw-bold text-dark mb-2">Kelola Pemesanan</h5>
                <p class="card-text text-muted small mb-0">
                  Lihat dan kelola semua pemesanan dari pelanggan Anda
                </p>
              </div>
              <div class="card-footer bg-transparent border-0 text-center pb-3">
                <small class="text-primary fw-bold">
                  Buka <i class="bi bi-arrow-right"></i>
                </small>
              </div>
            </div>
          </Link>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card border-0 shadow-sm h-100" style="opacity: 0.7;">
            <div class="card-body text-center py-5">
              <div class="mb-3">
                <i class="bi bi-people text-secondary" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="card-title fw-bold text-dark mb-2">Kelola Pengguna</h5>
              <p class="card-text text-muted small mb-0">
                Kelola data dan akun pengguna sistem
              </p>
            </div>
            <div class="card-footer bg-transparent border-0 text-center pb-3">
              <small class="text-muted">Coming soon...</small>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card border-0 shadow-sm h-100" style="opacity: 0.7;">
            <div class="card-body text-center py-5">
              <div class="mb-3">
                <i class="bi bi-graph-up text-secondary" style="font-size: 2.5rem;"></i>
              </div>
              <h5 class="card-title fw-bold text-dark mb-2">Laporan</h5>
              <p class="card-text text-muted small mb-0">
                Lihat laporan dan statistik penjualan
              </p>
            </div>
            <div class="card-footer bg-transparent border-0 text-center pb-3">
              <small class="text-muted">Coming soon...</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Info -->
      <div class="row mt-4">
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm">
            <div class="card-header bg-light border-bottom">
              <h5 class="card-title mb-0">
                <i class="bi bi-info-circle"></i> Informasi Sistem
              </h5>
            </div>
            <div class="card-body">
              <ul class="list-unstyled">
                <li class="mb-2">
                  <strong>Aplikasi:</strong> <span class="badge bg-success">Bintianis Booking System</span>
                </li>
                <li class="mb-2">
                  <strong>Status:</strong> <span class="badge bg-success">Online</span>
                </li>
                <li class="mb-0">
                  <strong>Versi:</strong> <span class="badge bg-info">1.0.0</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm bg-light">
            <div class="card-body text-center">
              <h6 class="card-title text-muted mb-3">Navigasi Cepat</h6>
              <Link href="/admin/bookings" class="btn btn-sm btn-primary w-100 mb-2">
                <i class="bi bi-calendar-check"></i> Pemesanan
              </Link>
              <button @click="logout" class="btn btn-sm btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const bookings = ref([]);
const users = ref([]);

const totalBookings = computed(() => bookings.value.length);
const totalUsers = computed(() => users.value.length);
const pendingCount = computed(() => bookings.value.filter(b => b.status === 'pending').length);
const confirmedCount = computed(() => bookings.value.filter(b => b.status === 'confirmed').length);

const logout = () => {
  router.post(route('logout'));
};
</script>
