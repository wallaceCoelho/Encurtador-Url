import { defineStore } from 'pinia'
import axios from 'axios'

export default userStore = defineStore('users', () => {
    let response = {}
    let error = ''

    async function getUser(){
        const token = JSON.parse(localStorage.getItem('token'))
        const userId = token.user['user_id']

        const config = {
            header:{
                'Authorization': `Bearer ${token.access_token}`
            }
        }
        const data = {
            id: userId
        }

        await axios.get('/api/users', data, config)
        .then((res) => {
            this.response = JSON.parse(JSON.stringify(res.data))
        })
        .catch((e) => {
            this.error = 'Erro: ', e
        })
    }

    return { getUser , response , error }
})