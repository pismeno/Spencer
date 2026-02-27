import api from './bootstrap';
addEventListener("DOMContentLoaded", ()=>{
    showEvents();
})
async function showEvents() {
    try{
        const response = await api.post('/listevents', {});
        console.log(response);
    } catch(error){
        console.error(error);
    }
}