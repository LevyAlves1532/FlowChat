import { useState } from 'react'
import { Link } from 'react-router';
import { LoaderIcon, LockIcon, MailIcon, MessageCircleIcon, UserIcon } from 'lucide-react';

import { useAuthStore } from '../store/useAuthStore';

import BorderAnimatedContainer from '../components/border-animated-container';

function SignUpPage() {
  const { signup, isSigningUp } = useAuthStore();

  const [ formData, setForm ] = useState({
    fullName: "",
    email: "",
    password: "",
  });

  const handleSubmit = (e) => {
    e.preventDefault();

    signup(formData);
  }

  return (
    <div className="w-full flex items-center justify-center p-4 bg-slate-900">
      <div className="relative w-full max-w-6xl md:h-[800px] h-[650px]">
        <BorderAnimatedContainer>
          <div className="w-full flex flex-col md:flex-row">
            <div className="md:w-1/2 p-8 flex items-center justify-center md:border-r border-slate-600/30">
              <div className="w-full max-w-md">
                <div className="text-center mb-8">
                  <MessageCircleIcon className="w-12 h-12 mx-auto text-slate-400 mb-4" />
                  <h2 className="text-2xl font-bold text-slate-200 mb-2">Crie uma Conta</h2>
                  <p className="text-slate-400">
                    Cadastre uma nova conta
                  </p>
                </div>

                <form onSubmit={handleSubmit} className="space-y-6">
                  <div>
                    <label className="auth-input-label">Full Name</label>
                    <div className="relative">
                      <UserIcon className="auth-input-icon" />
                      <input 
                        type="text" 
                        value={formData.fullName}
                        onChange={(e) => setForm({ ...formData, fullName: e.target.value })}
                        className="input"
                        placeholder="Lêvy Alves"
                      />
                    </div>
                  </div>

                  <div>
                    <label className="auth-input-label">Email</label>
                    <div className="relative">
                      <MailIcon className="auth-input-icon" />
                      <input 
                        type="email" 
                        value={formData.email}
                        onChange={(e) => setForm({ ...formData, email: e.target.value })}
                        className="input"
                        placeholder="levy.pereiraA1532@gmail.com"
                      />
                    </div>
                  </div>

                  <div>
                    <label className="auth-input-label">Senha</label>
                    <div className="relative">
                      <LockIcon className="auth-input-icon" />
                      <input 
                        type="password" 
                        value={formData.password}
                        onChange={(e) => setForm({ ...formData, password: e.target.value })}
                        className="input"
                        placeholder="Digite sua senha"
                      />
                    </div>
                  </div>

                  <button className="auth-btn" type="submit" disabled={isSigningUp}>
                    {isSigningUp ? (
                      <LoaderIcon className="w-full h-5 animate-spin text-center" />
                    ) : (
                      "Criar Conta"
                    )}
                  </button>
                </form>

                <div className="mt-6 text-center">
                  <Link to="/login" className="auth-link">
                    Você já tem possui uma conta? Faça login
                  </Link>
                </div>
              </div>
            </div>

            <div className="hidden md:w-1/2 md:flex items-center justify-center p-6 bg-gradient-to-bl from-slate-800/20 to-transparent">
              <div>
                <img 
                  src="/messages-bro.png" 
                  alt="" 
                  className="w-full h-auto object-contain" 
                />

                <div className="mt-6 text-center">
                  <h3 className="text-xl font-medium text-cyan-400">
                    Comece sua jornada agora mesmo!
                  </h3>

                  <div className="mt-4 flex justify-center gap-4">
                    <span className="auth-badge">Gratuito</span>
                    <span className="auth-badge">Fácil de usar</span>
                    <span className="auth-badge">Privado</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </BorderAnimatedContainer>
      </div>
    </div>
  )
}

export default SignUpPage