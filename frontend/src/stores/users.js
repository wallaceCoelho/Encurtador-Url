import { defineStore } from 'pinia'
import axios from 'axios'
import { ref } from 'vue'

export const userStore = defineStore('users', () => {
    let response = ref({})

    async function getUser(){
        const token = JSON.parse(localStorage.getItem('token'))
        const userId = token.user['user_id']

        const config = {
            headers:{
                'Authorization': `Bearer ${token.access_token}`
            }
        }
        const data = {
            id: userId
        }

        await axios.get('/api/users', data, config)
        .then((res) => {
            response = JSON.parse(JSON.stringify(res.data))
        })
        .catch((error) => {
            console.log(`ERRO: ${error}`)
        })
    }

    async function registerUser(name, email, password, active, nickname){
        const data = {
            name: name,
            email: email,
            nickname: nickname,
            password: password,
            active: active
        }

        await axios.post('api/register', data)
        .then((res) => {
            response = JSON.parse(JSON.stringify(res.data))
        })
        .catch((error) => {
            console.log(`ERRO: ${error}`)
        })
    }

    return { registerUser , getUser , response }
})