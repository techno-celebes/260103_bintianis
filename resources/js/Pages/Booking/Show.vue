<template>
  <div class="min-h-screen bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-12">
      <div class="bg-white rounded-lg shadow-md p-8">
        <div class="mb-6">
          <Link href="/" class="text-blue-600 hover:text-blue-700">← Kembali</Link>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Pemesanan</h1>
        <p class="text-gray-600 mb-8">ID: {{ booking.id }}</p>

        <!-- Status Badge -->
        <div class="mb-8">
          <span
            :class="[
              'inline-block px-4 py-2 rounded-full font-medium text-white',
              {
                'bg-yellow-500': booking.status === 'pending',
                'bg-green-500': booking.status === 'confirmed',
                'bg-red-500': booking.status === 'cancelled',
              },
            ]"
          >
            {{ statusLabel }}
          </span>
        </div>

        <!-- Booking Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
          <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pemesanan</h2>
            <dl class="space-y-4">
              <div>
                <dt class="text-sm font-medium text-gray-600">Nama</dt>
                <dd class="text-lg text-gray-900">{{ booking.name }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-600">Email</dt>
                <dd class="text-lg text-gray-900">{{ booking.email }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-600">Telepon</dt>
                <dd class="text-lg text-gray-900">{{ booking.phone }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-600">Tipe Acara</dt>
                <dd class="text-lg text-gray-900">
                  {{ booking.event_type === 'personal' ? 'Acara Pribadi' : 'Acara Besar' }}
                </dd>
              </div>
            </dl>
          </div>

          <div>
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Acara</h2>
            <dl class="space-y-4">
              <div>
                <dt class="text-sm font-medium text-gray-600">Tanggal & Waktu</dt>
                <dd class="text-lg text-gray-900">{{ formatDateTime(booking.event_date) }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-600">Lokasi</dt>
                <dd class="text-lg text-gray-900">{{ booking.location }}</dd>
              </div>
              <div v-if="booking.budget">
                <dt class="text-sm font-medium text-gray-600">Budget</dt>
                <dd class="text-lg text-gray-900">{{ formatCurrency(booking.budget) }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-600">Dibuat</dt>
                <dd class="text-lg text-gray-900">{{ formatDateTime(booking.created_at) }}</dd>
              </div>
            </dl>
          </div>
        </div>

        <!-- Description -->
        <div v-if="booking.description" class="mb-8 bg-gray-50 rounded-lg p-4">
          <h3 class="text-sm font-medium text-gray-600 mb-2">Deskripsi</h3>
          <p class="text-gray-900 whitespace-pre-wrap">{{ booking.description }}</p>
        </div>

        <!-- User Info -->
        <div v-if="booking.user" class="mb-8 bg-blue-50 rounded-lg p-4">
          <h3 class="text-sm font-medium text-gray-600 mb-2">Pembuat Pesanan</h3>
          <p class="text-gray-900">{{ booking.user.name }} ({{ booking.user.email }})</p>
        </div>

        <!-- Actions -->
        <div class="flex gap-4">
          <button
            @click="deleteBooking"
            class="px-6 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700"
          >
            Hapus Pesanan
          </button>
          <Link
            href="/"
            class="px-6 py-2 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400"
          >
            Kembali
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  booking: Object,
});

const statusLabel = computed(() => {
  const statuses = {
    pending: 'Menunggu Konfirmasi',
    confirmed: 'Dikonfirmasi',
    cancelled: 'Dibatalkan',
  };
  return statuses[props.booking.status] || props.booking.status;
});

const formatDateTime = (dateString) => {
  return new Date(dateString).toLocaleString('id-ID', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  });
};

const formatCurrency = (value) => {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
  }).format(value);
};

const deleteBooking = () => {
  if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
    router.delete(route('booking.destroy', props.booking.id));
  }
};
</script>
