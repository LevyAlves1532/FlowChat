import { useEffect } from "react";

import { useAuthStore } from "../store/useAuthStore";
import { useChatStore } from "../store/useChatStore";

import ChatHeader from "./chat-header";
import NoChatHistoryPlaceholder from "./no-chat-history-placeholder";
import MessageInput from "./message-input";
import MessageLoadingSkeleton from "./message-loading-skeleton";

function ChatContainer() {
  const { selectedUser, getMessages, messages, isMessagesLoading } = useChatStore();
  const { authUser } = useAuthStore();

  useEffect(() => {
    getMessages(selectedUser.id);
  }, [selectedUser, getMessages])

  return (
    <>
      <ChatHeader />
      <div className="flex-1 px-6 overflow-y-auto py-8">
        {messages.length > 0 && !isMessagesLoading ? (
          <div className="max-w-3xl mx-auto space-y-6">
            {messages.map((message) => (
              <div 
                className={`chat ${message.is_you ? "chat-end" : "chat-start"}`} 
                key={message.id}
              >
                <div 
                  className={`
                    chat-bubble relative
                    ${message.is_you 
                        ? "bg-cyan-600 text-white"
                        : "bg-slate-800 text-slate-200"}
                  `}
                >
                  {message.image && (
                    <img src={message.image} alt="Compartilhada" className="rounded-lg h-48 object-cover" />
                  )}
                  {message.text && <p className="mt-2">{message.text}</p>}
                  <p className="text-xs mt-1 opacity-75 flex items-center gap-1">
                    {new Date(message.created_at).toISOString().slice(11, 16)}
                  </p>
                </div>
              </div>
            ))}
          </div>
        ) : isMessagesLoading ? <MessageLoadingSkeleton /> : (
          <NoChatHistoryPlaceholder name={selectedUser.name} />
        )}
      </div>

      <MessageInput />
    </>
  )
}

export default ChatContainer