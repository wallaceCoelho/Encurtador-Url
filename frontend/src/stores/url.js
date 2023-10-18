import { defineStore } from 'pinia'
import axios from 'axios'

export const urlApiStore = defineStore('url', () => {
    let error = ''
    let response = {}

    async function created(){
        const token = JSON.parse(localStorage.getItem('token'))
        if(token) {
            const config = {
                header:{
                    'Authorization': `Bearer ${token.access_token}`
                }
            }
            const data = {}
            await axios.post("/api/getUrl", data, config)
            .then((res) => {
                this.response = JSON.parse(JSON.stringify(res.data))
            })
            .catch((e) => {
                this.error = 'Erro: ', e
            })
        }
    }
    
    async function makeShortUrl(string) {
        const token = JSON.parse(localStorage.getItem('token'))
        if(token) {
            const config = {
                header:{
                    'Authorization': `Bearer ${token.access_token}`
                }
            }
            await axios.post("/api/url", {
                data: string
            }, config)
            .then((res) => {
                this.response = JSON.parse(JSON.stringify(res.data))
            })
            .catch((e) => {
                this.error = 'Erro: ', e
            })
        }
    }
    return { created , makeShortUrl , response , error }
})