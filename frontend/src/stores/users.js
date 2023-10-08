import { defineStore } from 'pinia'
import axios from 'axios'

export default userStore = defineStore('users', () => {
    async function getUser(){
        const token = JSON.parse(localStorage.getItem('token'))
        const userId = token.user['user_id']

        const header = {
            
        }

        const data = {
            id: userId
        }

        await axios.get('/api/users', {
            
        })
    }
})