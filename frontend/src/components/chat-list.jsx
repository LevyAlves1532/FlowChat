import { useEffect } from "react";

import { useChatStore } from "../store/useChatStore"

import UsersLoadingSkeleton from "./users-loading-skeleton";
import NoChatsFound from "./no-chats-found";

function ChatList() {
  const { getMyChatPartners, chats, isUsersLoading, setSelectedUser } = useChatStore();

  useEffect(() => {
    getMyChatPartners();
  }, [getMyChatPartners]);

  if (isUsersLoading)
    return <UsersLoadingSkeleton />;

  if (chats.length === 0)
    return <NoChatsFound />;
  
  return (
    <>
      {chats.map(chat => (
        <div 
          className="bg-cyan-500/10 p-4 rounded-lg cursor-pointer hover:bg-cyan-500/20 transition-colors" 
          onClick={() => setSelectedUser(chat)}
          key={chat.id}
        >
          <div className="flex items-center gap-3">
            <div className="avatar online">
              <div className="size-12 rounded-full">
                <img src={chat.profile_pic || "/avatar.png"} alt={chat.name} />
              </div>
            </div>

            <h4 className="text-slate-200 font-medium truncate">
              {chat.name}
            </h4>
          </div>
        </div>
      ))}
    </>
  )
}

export default ChatList