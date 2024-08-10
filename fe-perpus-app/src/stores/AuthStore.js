import {ref} from 'vue'
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { customAPI } from '@/api'
import axios from 'axios'

export const useAuthStore = defineStore('auth', () => {
    const router = useRouter()

    const tokenUser = ref(localStorage.getItem("token")
    ? JSON.parse(localStorage.getItem("token")) 
    : null)

    const currentUser = ref(localStorage.getItem("user")
    ? JSON.parse(localStorage.getItem("user")) 
    : null)

    const isError = ref(false)
    const errorMsg = ref("")

    const loginUser = async (inputData) => {
        try {
            isError.value = false
            errorMsg.value = ""

            const { email, password } = inputData

            const {data} = await customAPI.post('/auth/login', {
                email: email,
                password: password
            })

            const { token, user } = data

            // Store pinia
            tokenUser.value = token
            currentUser.value = user

            // LocalStorage
            localStorage.setItem('token', JSON.stringify(token))
            localStorage.setItem('user', JSON.stringify(user))

            await getMe();
            
            alert("Berhasil Login");
            router.push({ name: 'Home' });

        } catch (error) {
            isError.value = true
            errorMsg.value = error.response.data.message
            console.log(error.response.data.message);
            
        }
    }

    const logoutUser = async () => {

        const response = await customAPI.post('/auth/logout', null, {
            headers: { 'Authorization': `Bearer ${tokenUser.value}`}
        })
        
        // LocalStorage ke null
        localStorage.setItem('token', null)
        localStorage.setItem('user', null)

        // Store pinia ke kosong
        tokenUser.value = ""
        currentUser.value = ""

        console.log(response);

        alert("Berhasil Logout");
        router.push({ name: 'Home' });
    }

    const registerUser = async (inputData) => {
        try {
            isError.value = false
            errorMsg.value = ""

            const { email, password, name, password_confirmation } = inputData

            const { data } = await customAPI.post('/auth/register', {
                email: email,
                password: password,
                name: name,
                password_confirmation: password_confirmation
            })

            const { token, user } = data

            // Store pinia
            tokenUser.value = token
            currentUser.value = user

            // LocalStorage
            localStorage.setItem('token', JSON.stringify(token))
            localStorage.setItem('user', JSON.stringify(user))

            router.push({ name: 'Home' });

        } catch (error) {
            isError.value = true
            errorMsg.value = error.response.data
        }
    }

    const getMe = async () => {
        try {
            const response = await customAPI.get('/me', {
                headers: { Authorization: `Bearer ${tokenUser.value}`}
            })

            console.log(response);

        } catch (error) {
            console.log(error);
        }
    }

    return {tokenUser, currentUser, isError, errorMsg, loginUser, logoutUser, registerUser, getMe}

})