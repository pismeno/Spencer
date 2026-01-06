import axios from 'axios';

const axiosInstance = axios.create({
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
});

const token = document.head?.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (token) {
    axiosInstance.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

export default axiosInstance;
