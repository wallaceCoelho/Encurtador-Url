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
            location.href = "/profile"
        })
    }

    async function signOut () {
        const token = JSON.parse(localStorage.getItem('token'))
        if(token) {
            const config = {
                headers:{
                    'Authorization': `Bearer ${token.access_token}`
                }
            }
            const data = {}

            await axios.post("/api/logout", data, config)
            .then((res) => {
                localStorage.removeItem('token')
                location.href = "/"
            })
            .catch((error) => {
                console.log(error)
            })
        }
    }
    
    function isSignedIn () {
        const token = JSON.parse(localStorage.getItem('token'))
        if(token){
            const dateToken = new Date(token.login_in['date'])
            if((dateToken - new Date()) > token.expires_in){
                localStorage.removeItem('token')
                return false
            }   
            else if ((dateToken - new Date()) < token.expires_in) return true
        }
        else return false
    }
    
    return { signIn , signOut , isSignedIn }
})
    