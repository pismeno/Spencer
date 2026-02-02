import axios from 'axios';

const api = axios.create({
    withCredentials: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
});

const token = document.head?.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (token) {
    api.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

export default api;