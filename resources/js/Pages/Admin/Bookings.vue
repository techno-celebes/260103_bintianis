<template>
  <div class="min-vh-100 bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-dark bg-dark shadow-sm sticky-top">
      <div class="container-fluid">
        <Link href="/admin/dashboard" class="navbar-brand mb-0 h1 text-decoration-none">
          <i class="bi bi-speedometer2"></i> Bintianis Admin
        </Link>
        <div class="ms-auto">
          <button class="btn btn-outline-light btn-sm" @click="logout">
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
            <i class="bi bi-clipboard-checklist text-primary"></i> Kelola Pemesanan
          </h2>
          <p class="text-muted">Kelola semua pemesanan dari pelanggan</p>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1 small">Total Pemesanan</p>
                  <h4 class="card-title mb-0">{{ totalBookings }}</h4>
                </div>
                <i class="bi bi-calendar-check fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1 small">Menunggu Konfirmasi</p>
                  <h4 class="card-title mb-0">{{ pendingCount }}</h4>
                </div>
                <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1 small">Dikonfirmasi</p>
                  <h4 class="card-title mb-0">{{ confirmedCount }}</h4>
                </div>
                <i class="bi bi-check-circle-fill fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
          <div class="card border-0 shadow-sm bg-danger text-white">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="card-text opacity-75 mb-1 small">Dibatalkan</p>
                  <h4 class="card-title mb-0">{{ cancelledCount }}</h4>
                </div>
                <i class="bi bi-x-circle-fill fs-1 opacity-50"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bookings Table -->
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">
            <i class="bi bi-list-ul"></i> Daftar Semua Pemesanan
          </h5>
          <Link href="/admin/dashboard" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-house"></i> Kembali
          </Link>
        </div>

        <div class="card-body p-0">
          <!-- Empty State -->
          <div v-if="bookings.data.length === 0" class="text-center py-5">
            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
            <p class="text-muted mt-3">Belum ada pemesanan</p>
          </div>

          <!-- Table -->
          <div v-else class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead class="table-light">
                <tr>
                  <th class="py-3">
                    <i class="bi bi-hash"></i> ID
                  </th>
                  <th class="py-3">Pemesan</th>
                  <th class="py-3">Email</th>
                  <th class="py-3">Tipe Acara</th>
                  <th class="py-3">Tanggal</th>
                  <th class="py-3">Lokasi</th>
                  <th class="py-3">Budget</th>
                  <th class="py-3">Status</th>
                  <th class="py-3 text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="booking in bookings.data" :key="booking.id">
                  <td class="py-3">
                    <span class="badge bg-secondary">#{{ booking.id }}</span>
                  </td>
                  <td class="py-3">
                    <div>
                      <strong>{{ booking.name }}</strong>
                    </div>
                  </td>
                  <td class="py-3">
                    <small class="text-muted">{{ booking.email }}</small>
                  </td>
                  <td class="py-3">
                    <span class="badge bg-info">
                      {{ booking.event_type === 'personal' ? '👤 Pribadi' : '👥 Acara' }}
                    </span>
                  </td>
                  <td class="py-3">
                    <small>{{ formatDate(booking.event_date) }}</small>
                  </td>
                  <td class="py-3">
                    <small class="text-muted">{{ booking.location }}</small>
                  </td>
                  <td class="py-3">
                    <strong class="text-success">Rp {{ formatCurrency(booking.budget) }}</strong>
                  </td>
                  <td class="py-3">
                    <select
                      :value="booking.status"
                      @change="updateStatus(booking, $event.target.value)"
                      class="form-select form-select-sm"
                      :class="[
                        {
                          'is-pending': booking.status === 'pending',
                          'is-confirmed': booking.status === 'confirmed',
                          'is-cancelled': booking.status === 'cancelled',
                        },
                      ]"
                    >
                      <option value="pending">⏳ Menunggu</option>
                      <option value="confirmed">✓ Dikonfirmasi</option>
                      <option value="cancelled">✗ Dibatalkan</option>
                    </select>
                  </td>
                  <td class="py-3 text-center">
                    <Link
                      :href="`/booking/${booking.id}`"
                      class="btn btn-sm btn-outline-primary"
                      title="Lihat detail"
                    >
                      <i class="bi bi-eye"></i>
                    </Link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="bookings.links && bookings.links.length > 3" class="card-footer bg-light border-top">
          <nav>
            <ul class="pagination pagination-sm mb-0 justify-content-center">
              <li
                v-for="link in bookings.links"
                :key="link.label"
                :class="['page-item', { active: link.active, disabled: !link.url }]"
              >
                <Link
                  v-if="link.url"
                  :href="link.url"
                  class="page-link"
                  v-html="link.label"
                />
                <span v-else class="page-link" v-html="link.label" />
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- Custom Styles for Status Badge -->
    <style scoped>
      .is-pending {
        border-color: #ffc107 !important;
        color: #856404 !important;
      }

      .is-confirmed {
        border-color: #28a745 !important;
        color: #155724 !important;
      }

      .is-cancelled {
        border-color: #dc3545 !important;
        color: #721c24 !important;
      }

      .table-hover tbody tr:hover {
        background-color: #f5f5f5;
      }
    </style>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  bookings: Object,
});

const totalBookings = computed(() => props.bookings.total);
const pendingCount = computed(() =>
  props.bookings.data.filter((b) => b.status === 'pending').length
);
const confirmedCount = computed(() =>
  props.bookings.data.filter((b) => b.status === 'confirmed').length
);
const cancelledCount = computed(() =>
  props.bookings.data.filter((b) => b.status === 'cancelled').length
);

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  });
};

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('id-ID').format(amount);
};

const updateStatus = (booking, newStatus) => {
  router.patch(route('booking.updateStatus', booking.id), {
    status: newStatus,
  });
};

const logout = () => {
  router.post(route('logout'));
};
</script>
