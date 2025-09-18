import { create } from "zustand";

import { axiosInstance } from "../lib/axios";
import toast from "react-hot-toast";

export const useAuthStore = create((set, get) => ({
  authUser: null,
  isCheckingAuth: true,
  isSigningUp: false,
  isLoggingIn: false,

  checkAuth: async () => {
    try {
      const res = await axiosInstance.get("/auth");
      set({ authUser: res.data });
    } catch (error) {
      console.log("Error in authCheck:", error);
      set({ authUser: null });
    } finally {
      set({ isCheckingAuth: false });
    }
  },

  signup: async (data) => {
    set({ isSigningUp: true });

    try {
      await axiosInstance.post("/user", data);

      toast.success("Conta criada com sucesso! Valide sua conta pelo email.");
    } catch (error) {
      toast.error(error?.response?.data?.message || "Erro ao criar conta.");
    } finally {
      set({ isSigningUp: false });
    }
  },

  login: async (data) => {    
    set({ isLoggingIn: true });

    try {
      const res = await axiosInstance.post("/auth", data);

      localStorage.setItem("token", res.data.access_token);
      await get().checkAuth();

      toast.success("Login feito com sucesso.");
    } catch (error) {
      toast.error(error?.response?.data?.message || "Erro ao fazer login.");
    } finally {
      set({ isLoggingIn: false });
    }
  },
}));
