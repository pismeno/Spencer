import axios from 'axios';

const axiosInstance = axios.create({
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
});

// Attach CSRF token if present (Laravel default meta tag)
const token = document.head?.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (token) {
    axiosInstance.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

export default axiosInstance;
