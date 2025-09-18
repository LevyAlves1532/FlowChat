import { useEffect } from "react";

import { useChatStore } from "../store/useChatStore";

import UsersLoadingSkeleton from "./users-loading-skeleton";

function ContactList() {
  const { getAllContacts, allContacts, isUsersLoading, setSelectedUser } = useChatStore();

  useEffect(() => {
    getAllContacts();
  }, [getAllContacts]);

  if (isUsersLoading)
    return <UsersLoadingSkeleton />;

  return (
    <>
      {allContacts.map((contact) => (
        <div 
          className="bg-cyan-500/10 p-4 rounded-lg hover:bg-cyan-500/20 transition-colors"
          onClick={() => setSelectedUser(contact)}
          key={contact.id}
        >
          <div className="flex items-center gap-3">
            <div className="avatar online">
              <div className="size-12 rounded-full">
                <img src={contact.profile_pic || "/avatar.png"} alt={contact.name} />
              </div>
            </div>

            <h4 className="text-slate-200 font-medium">{contact.name}</h4>
          </div>
        </div>
      ))}
    </>
  )
}

export default ContactList