import axios from 'axios';

const api = axios.create({
    baseURL:"http://127.0.0.1:8000/api",
    headers: {
        Accept: 'application/json',
    },
})

export const setAuthenToken = (token) => {
    if (token) {
        localStorage.setItem('token', token)
        api.defaults.headers.common['Authorization'] = `Bearer ${token}`
    }else{
        delete api.defaults.headers.common['Authorization']
    }
}