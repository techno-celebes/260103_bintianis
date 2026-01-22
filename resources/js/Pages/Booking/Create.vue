<template>
  <div class="min-h-screen bg-gray-100">
    <div class="max-w-4xl mx-auto px-4 py-12">
      <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Buat Pemesanan</h1>

        <form @submit.prevent="submitForm" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Lengkap -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nama Lengkap <span class="text-red-500">*</span>
              </label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
              <p v-if="errors.name" class="mt-1 text-sm text-red-500">{{ errors.name }}</p>
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email <span class="text-red-500">*</span>
              </label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
              <p v-if="errors.email" class="mt-1 text-sm text-red-500">{{ errors.email }}</p>
            </div>

            <!-- Nomor Telepon -->
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                Nomor Telepon <span class="text-red-500">*</span>
              </label>
              <input
                id="phone"
                v-model="form.phone"
                type="tel"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
              <p v-if="errors.phone" class="mt-1 text-sm text-red-500">{{ errors.phone }}</p>
            </div>

            <!-- Tipe Event -->
            <div>
              <label for="event_type" class="block text-sm font-medium text-gray-700 mb-1">
                Tipe Acara <span class="text-red-500">*</span>
              </label>
              <select
                id="event_type"
                v-model="form.event_type"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="">Pilih tipe acara</option>
                <option value="personal">Acara Pribadi</option>
                <option value="event">Acara Besar</option>
              </select>
              <p v-if="errors.event_type" class="mt-1 text-sm text-red-500">{{ errors.event_type }}</p>
            </div>

            <!-- Tanggal Event -->
            <div>
              <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">
                Tanggal Acara <span class="text-red-500">*</span>
              </label>
              <input
                id="event_date"
                v-model="form.event_date"
                type="datetime-local"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
              <p v-if="errors.event_date" class="mt-1 text-sm text-red-500">{{ errors.event_date }}</p>
            </div>

            <!-- Lokasi -->
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                Lokasi <span class="text-red-500">*</span>
              </label>
              <input
                id="location"
                v-model="form.location"
                type="text"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
              <p v-if="errors.location" class="mt-1 text-sm text-red-500">{{ errors.location }}</p>
            </div>

            <!-- Budget -->
            <div>
              <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">
                Budget (Opsional)
              </label>
              <input
                id="budget"
                v-model.number="form.budget"
                type="number"
                step="0.01"
                min="0"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
              <p v-if="errors.budget" class="mt-1 text-sm text-red-500">{{ errors.budget }}</p>
            </div>
          </div>

          <!-- Deskripsi -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
              Deskripsi (Opsional)
            </label>
            <textarea
              id="description"
              v-model="form.description"
              rows="4"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Jelaskan detail acara Anda..."
            />
            <p v-if="errors.description" class="mt-1 text-sm text-red-500">{{ errors.description }}</p>
          </div>

          <!-- Buttons -->
          <div class="flex gap-4">
            <button
              type="submit"
              :disabled="loading"
              class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {{ loading ? 'Memproses...' : 'Pesan Sekarang' }}
            </button>
            <Link
              href="/"
              class="px-6 py-2 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400"
            >
              Batal
            </Link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const loading = ref(false);
const errors = ref({});

const form = useForm({
  name: '',
  email: '',
  phone: '',
  event_type: '',
  event_date: '',
  location: '',
  budget: null,
  description: '',
});

const submitForm = async () => {
  loading.value = true;
  errors.value = {};

  try {
    await form.post(route('booking.store'), {
      onError: (err) => {
        errors.value = err;
      },
      onFinish: () => {
        loading.value = false;
      },
    });
  } catch (error) {
    console.error('Error:', error);
    loading.value = false;
  }
};
</script>
