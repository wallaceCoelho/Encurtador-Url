import { defineStore } from 'pinia'
import axios from 'axios'
import { ref } from 'vue'

export const urlApiStore = defineStore('url', () => {
    let error = ref('')
    let response = ref({})
    let url = ref([])

    async function getUrl() {
        const token = JSON.parse(localStorage.getItem('token'))
        let urls = []
        if(token) {
            const config = {
                headers:{
                    'Authorization': `Bearer ${token.access_token}`
                }
            }
            await axios.get("/api/getUrl", config)
            .then((res) => {
                urls = JSON.parse(JSON.stringify(res.data))
            })
            .catch((e) => {
                error = 'Erro: ', e
            })
        }
        url.value = urls
    }
    async function getShortUrl(string) {
        const token = JSON.parse(localStorage.getItem('token'))
        let data = []
        if(token) {
            const config = {
                headers:{
                    'Authorization': `Bearer ${token.access_token}`
                }
            }
            await axios.post("/api/url", {
                data: string
            }, config)
            .then((res) => {
                data = JSON.parse(JSON.stringify(res.data))
            })
            .catch((e) => {
                error = 'Erro: ', e
            })
        }
        response.value = data
    }

    async function deleteUrl(id) {
        const token = JSON.parse(localStorage.getItem('token'))
        let data = []
        if(token) {
            const config = {
                headers:{
                    'Authorization': `Bearer ${token.access_token}`
                }
            }
            await axios.post("/api/deleteUrl", {
                id: id
            }, config)
            .then((res) => {
                alert(JSON.parse(JSON.stringify(res.data.message)))
                location.reload()
            })
            .catch((e) => {
                error = 'Erro: ', e
            })
        }
        response.value = data
    }
    return { getUrl , getShortUrl , deleteUrl , response , url , error }
})