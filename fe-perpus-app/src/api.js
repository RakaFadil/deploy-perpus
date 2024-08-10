import axios from "axios";

export const customAPI = axios.create({
    baseURL: '/api/v1',
});