import { defineStore } from 'pinia'
import axios from 'axios'


export const authStore = defineStore('auth', () => {
    
    async function signIn(email, password) {
        await axios.post("/api/login", {
            email: email,
            password: password
        })
        .then((res) => {
            localStorage.setItem('token', JSON.stringify(res.data))
            location.reload()
        })
    }

    async function signOut () {
        const token = JSON.parse(localStorage.getItem('token'))
        if(token) {
            const config = {
                header:{
                    'Authorization': `Bearer ${token.access_token}`
                }
            }
            const data = {}

            await axios.post("/api/logout", data, config)
            .then((res) => {
                localStorage.removeItem('token')
                location.reload()
            })
            .catch((error) => {
                console.log(error)
            })
        }
    }
    
    function isSignedIn () {
        return !localStorage.getItem('token') ? false : true
    }
    
    return { signIn , signOut , isSignedIn }
})
    