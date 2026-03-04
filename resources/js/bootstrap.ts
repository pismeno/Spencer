import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

export default api;
