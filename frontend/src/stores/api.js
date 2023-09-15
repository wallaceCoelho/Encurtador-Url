import { defineStore } from 'pinia'
import axios from 'axios'

export const urlApiStore = defineStore('api', () => {
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
    return { created , response , error }
})