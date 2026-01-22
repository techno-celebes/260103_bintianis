<template>
  <div class="min-h-screen bg-gray-100">
    <div class="max-w-6xl mx-auto px-4 py-12">
      <div class="bg-white rounded-lg shadow-md p-8">
        <div class="mb-8 flex justify-between items-center">
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Pemesanan Saya</h1>
            <p class="text-gray-600 mt-1">Kelola semua pesanan Anda</p>
          </div>
          <Link
            href="/booking/create"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700"
          >
            + Buat Pemesanan Baru
          </Link>
        </div>

        <!-- Bookings Table -->
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tipe Acara</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Lokasi</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="booking in bookings.data"
                :key="booking.id"
                class="border-b border-gray-200 hover:bg-gray-50"
              >
                <td class="px-6 py-4 text-sm text-gray-900">
                  {{ formatDate(booking.event_date) }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">
                  {{ booking.event_type === 'personal' ? 'Acara Pribadi' : 'Acara Besar' }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-900">{{ booking.location }}</td>
                <td class="px-6 py-4">
                  <span
                    :class="[
                      'inline-block px-3 py-1 rounded-full text-xs font-medium',
                      {
                        'bg-yellow-100 text-yellow-800': booking.status === 'pending',
                        'bg-green-100 text-green-800': booking.status === 'confirmed',
                        'bg-red-100 text-red-800': booking.status === 'cancelled',
                      },
                    ]"
                  >
                    {{ getStatusLabel(booking.status) }}
                  </span>
                </td>
                <td class="px-6 py-4 text-sm space-x-2">
                  <Link
                    :href="`/booking/${booking.id}`"
                    class="text-blue-600 hover:text-blue-700 font-medium"
                  >
                    Lihat
                  </Link>
                  <button
                    v-if="booking.status === 'pending'"
                    @click="deleteBooking(booking.id)"
                    class="text-red-600 hover:text-red-700 font-medium"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Empty State -->
        <div v-if="bookings.data.length === 0" class="text-center py-12">
          <p class="text-gray-500 text-lg">Belum ada pemesanan</p>
          <Link
            href="/booking/create"
            class="text-blue-600 hover:text-blue-700 font-medium mt-2 inline-block"
          >
            Buat pemesanan sekarang
          </Link>
        </div>

        <!-- Pagination -->
        <div v-if="bookings.links.length > 3" class="mt-8 flex justify-center space-x-2">
          <Link
            v-for="link in bookings.links"
            :key="link.label"
            :href="link.url"
            :class="[
              'px-3 py-2 rounded-lg text-sm font-medium',
              link.active
                ? 'bg-blue-600 text-white'
                : link.url
                  ? 'bg-gray-200 text-gray-800 hover:bg-gray-300'
                  : 'bg-gray-100 text-gray-400 cursor-not-allowed',
            ]"
            v-html="link.label"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
  bookings: Object,
});

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  });
};

const getStatusLabel = (status) => {
  const labels = {
    pending: 'Menunggu',
    confirmed: 'Dikonfirmasi',
    cancelled: 'Dibatalkan',
  };
  return labels[status] || status;
};

const deleteBooking = (bookingId) => {
  if (confirm('Apakah Anda yakin ingin menghapus pemesanan ini?')) {
    router.delete(route('booking.destroy', bookingId));
  }
};
</script>
