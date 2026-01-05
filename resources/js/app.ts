import axios from 'axios';

// This helps Axios work with Laravel's CSRF protection
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Example Axios call in TypeScript
const fetchData = async (): Promise<void> => {
    try {
        const response = await axios.get('/api/user');
        console.log(response.data);
    } catch (error) {
        console.error('Error fetching data', error);
    }
}
