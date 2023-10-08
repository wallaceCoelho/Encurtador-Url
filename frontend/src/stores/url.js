import { defineStore } from 'pinia'
import axios from 'axios'

export const urlApiStore = defineStore('url', () => {
    let error = ''
    let response = {}
    
    async function created(string) {
        await axios.post("/api/url", {
            data: string
        })
        .then((res) => {
            this.response = JSON.parse(JSON.stringify(res.data))
        })
        .catch((e) => {
            this.error = 'Erro: ', e
        })
    }

    async function getUrls(){
        
    }
    return { created , response , error }
})