<template>
    <div class="auth-nav-wrapper">
        <!-- Jika user sudah login -->
        <div v-if="user" class="dropdown">
            <button 
                class="btn btn-sm btn-outline-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                {{ user.name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <Link :href="route('profile.edit')" class="dropdown-item">
                        Profil Saya
                    </Link>
                </li>
                <li>
                    <Link :href="route('dashboard')" class="dropdown-item">
                        Dashboard
                    </Link>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form @submit.prevent="logout" method="POST">
                        <button type="submit" class="dropdown-item">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Jika user belum login -->
        <div v-else>
            <Link 
                :href="route('login')" 
                class="btn btn-sm cta-primary text-white"
            >
                Login
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.auth.user)

const logout = () => {
    router.post(route('logout'))
}
</script>

<style scoped>
.auth-nav-wrapper {
    display: flex;
    align-items: center;
}

.dropdown-toggle::after {
    margin-left: 0.25rem;
}
</style>
