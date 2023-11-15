import { defineStore } from 'pinia'
import axios from 'axios'
import { ref } from 'vue'

export const authStore = defineStore('auth', () => {
    let response = ref(false)

    async function signIn(email, password) {
        await axios.post("/api/login", {
            email: email,
            password: password
        })
        .then((res) => {
            localStorage.setItem('token', JSON.stringify(res.data))
            location.reload()
            location.href = "/panel"
        })
        .catch((erro) => {
            console.log(erro)
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
    
    async function isSignedIn () {
        const token = JSON.parse(localStorage.getItem('token'))
        if(token){
            const dateToken = new Date(token.login_in.date)
            const tokenExpiresIn = Math.ceil((Math.abs(new Date() - dateToken))/ (1000 * 60))
            
            if(tokenExpiresIn > token.expires_in){
                localStorage.removeItem('token')
                response.value = false
            }   
            else if (token.expires_in - tokenExpiresIn < 15){
                response.value = await refresh()
            }
            else response.value = true
            /*
            const config = {
                headers: {
                    'Authorization': `Bearer ${token.access_token}`,
                    'Content-Type': 'application/json'  
                }
            }
            await axios.get(`api/me`, config)
            .then(res => {
                if (!res.ok) {
                    localStorage.removeItem('token')
                    response.value = false
                }
                return res.json() 
            })
            .then(res => {
                response.value = true
            })
            .catch(error => {
            });
            */
        }
        else response.value = false
    }

    async function refresh(){
        const token = JSON.parse(localStorage.getItem('token'))
        const config = {
            headers: {
                'Authorization': `Bearer ${token.access_token}`,
                'Content-Type': 'application/json'
            }
        }
        await axios.post('api/refresh', config)
        .then(response => {
            if (!response.ok) {
            throw new Error(`Erro na solicitação: ${response.status}`)
            }
            localStorage.removeItem('token')
            return false 
        })
        .then(res => {
            localStorage.setItem('token', JSON.stringify(res))
            return true
        }) 
    }
    
    return { signIn , signOut , isSignedIn , response }
})



    