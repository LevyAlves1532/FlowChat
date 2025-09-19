import { useRef, useState } from "react"
import { XIcon } from "lucide-react";

import { useChatStore } from "../store/useChatStore";

function MessageInput() {
  const { sendMessage, isSoundEnabled } = useChatStore();

  const [ text, setText ] = useState("");
  const [ imagePreview, setImagePreview ] = useState(null);

  const fileInputRef = useRef(null);

  const handleSendMessage = async (e) => {
    e.preventDefault();

    if (!text.trim() && !imagePreview) 
      return;

    const formData = new FormData();

    formData.append("text", text);

    if (fileInputRef.current && fileInputRef.current.files[0]) {
      formData.append("image", fileInputRef.current.files[0]);
      fileInputRef.current.value = null;
    }
    
    sendMessage(formData);

    setText("");
    setImagePreview(null);
  }

  const handleImageChange = (e) => {
    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onloadend = () => {
      const base64Image = reader.result;
      setImagePreview(base64Image);
    };
  }

  const removeImage = () => {
    setImagePreview(null);

    if (fileInputRef.current)
      fileInputRef.current.value = null;
  }

  return (
    <div className="p-4 border-t border-slate-700/50">
      {imagePreview && (
        <div className="max-w-3xl mx-auto mb-3 flex items-center">
          <div className="relative">
            <img 
              src={imagePreview} 
              alt="Pré-visualização" 
              className="w-20 h-20 object-cover rounded-lg border border-slate-700" 
            />

            <button 
              onClick={removeImage}
              className="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-slate-800 flex items-center justify-center  text-slate-200 hover:bg-slate-700"
              type="button"
            >
              <XIcon className="w-4 h-4" />
            </button>
          </div>
        </div>
      )}
    </div>
  )
}

export default MessageInput