import { create } from "zustand";

export const useAuthStore = create((set) => ({
  authUser: { name: "Lêvy Alves", id: 1, age: 20 },
  isLoggedIn: false,
  isLoading: false,
  
  login: () => {
    console.log("We just logged in");
    set({ isLoggedIn: true, isLoading: true });
  },
}));
