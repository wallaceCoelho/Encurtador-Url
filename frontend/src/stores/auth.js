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
        })
    }

    function isSignedIn () {
        const token = localStorage.getItem('token')
        return !token ? null : JSON.parse(token)
    }

    async function signOut () {
      localStorage.removeItem('token');
      await axios.post("/api/logout", {
      })
      .then((res) => {
          console.log(res.data)
      })
    }

    return { signIn , signOut , isSignedIn }
})
    