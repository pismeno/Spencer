import axios from 'axios';

const api = axios.create({
    // Using Vite environment variables
    baseURL: import.meta.env.VITE_API_BASE_URL || '/api',
    withCredentials: true, // Crucial for Laravel Sanctum
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

export default api;
