import { useEffect } from "react";

import { useAuthStore } from "../store/useAuthStore";
import { useChatStore } from "../store/useChatStore";

import ChatHeader from "./chat-header";

function ChatContainer() {
  const { selectedUser, getMessages, messages } = useChatStore();
  const { authUser } = useAuthStore();

  useEffect(() => {
    getMessages(selectedUser.id);
  }, [selectedUser, getMessages])

  return (
    <>
      <ChatHeader />
    </>
  )
}

export default ChatContainer