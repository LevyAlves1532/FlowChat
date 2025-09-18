import { useState } from 'react';
import { Link, useNavigate } from 'react-router';
import { LockIcon, MailIcon, MessageCircleIcon, LoaderIcon } from 'lucide-react';

import { useAuthStore } from '../store/useAuthStore';

import BorderAnimatedContainer from '../components/border-animated-container';

function LoginPage() {
  const navigate = useNavigate();
  const { login, isLoggingIn } = useAuthStore();

  const [ formData, setForm ] = useState({
    email: "",
    password: "",
  });

  const handleSubmit = async (e) => {
    e.preventDefault();

    await login(formData);
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
                  <h2 className="text-2xl font-bold text-slate-200 mb-2">Bem-Vindo de Volta</h2>
                  <p className="text-slate-400">
                    Faça login com sua conta
                  </p>
                </div>

                <form onSubmit={handleSubmit} className="space-y-6">
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

                  <button className="auth-btn" type="submit" disabled={isLoggingIn}>
                    {isLoggingIn ? (
                      <LoaderIcon className="w-full h-5 animate-spin text-center" />
                    ) : (
                      "Entrar"
                    )}
                  </button>
                </form>

                <div className="mt-6 text-center">
                  <Link to="/sign-up" className="auth-link">
                    Você já não possui uma conta? Faça cadastro
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
                    Conecte-se a qualquer momento, em qualquer lugar
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

export default LoginPage