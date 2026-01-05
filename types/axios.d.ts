// Minimal ambient declaration so `tsc` can resolve imports when axios types are not found.
// Axios ships its own types, but in some environments the resolver can be strict; this keeps the local check simple.
declare module 'axios' {
    import axios from 'axios';
    export default axios;
}

