import axios from "axios";

export const axiosInstance = axios.create({
  baseURL: import.meta.env.MODE === "development" ? "http://127.0.0.1:8000/api/v1" : "https://flowchat.levyalvesdev.com.br/api/v1",
  headers: {
    "Accept": "application/json",
  },
});
