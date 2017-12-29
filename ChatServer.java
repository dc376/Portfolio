
import java.io.*;
import java.net.*;
import java.util.*;

public class ChatServer extends ChatMessage
{  public static void main(String[] args ) 
   {  
      ArrayList<ChatHandler> AllHandlers = new ArrayList<ChatHandler>();
		
      try 
      {  ServerSocket s = new ServerSocket(4000);
         
         for (;;)
         {  Socket incoming = s.accept( );
            new ChatHandler(incoming, AllHandlers).start();
         }   
      }
      catch (Exception e) 
      {  System.out.println(e);
      } 
   }

}

class ChatHandler extends Thread
{  public ChatHandler(Socket i, ArrayList<ChatHandler> h) 
   { 
   		incoming = i;
		handlers = h;
		handlers.add(this);
		try{
			in = new ObjectInputStream(incoming.getInputStream());
			out = new ObjectOutputStream(incoming.getOutputStream());
		}catch(IOException ioe){
				System.out.println("Could not create streams.");
		}
		
		
   }
	public synchronized void broadcast(){
	
		ChatHandler left = null;
		for(ChatHandler handler : handlers){
			ChatMessage cm = new ChatMessage();
			ChatMessage cm1 = new ChatMessage();
			
			cm.setMessage(myObject.getMessage());
			
			try{
				handler.out.writeObject(cm);
				//for prepending name
				System.out.println(cm1.getName()+ cm.getMessage());
			}catch(IOException ioe){
				//one of the other handlers hung up
				left = handler; // remove that handler from the arraylist
			}
		}
		handlers.remove(left);
		
		if(myObject.getMessage().equals("bye")){ // my client wants to leave
			done = true;	
			handlers.remove(this);
			System.out.println("Removed handler. Number of handlers: " + handlers.size());
		}
		
		System.out.println("Number of handlers: " + handlers.size());
	
	}

   public void run()
   {  
		try{ 	
			while(!done){
				myObject = (ChatMessage)in.readObject();
				System.out.println("Message read: " + myObject.getMessage());
				broadcast();
			}			    
		} catch (IOException e){  
			if(e.getMessage().equals("Connection reset")){
				System.out.println("A client terminated its connection.");
			}else{
				System.out.println("Problem receiving: " + e.getMessage());
			}
		}catch(ClassNotFoundException cnfe){
			System.out.println(cnfe.getMessage());
		}finally{
			handlers.remove(this);
		}
   }
   public void vdone(){
		done = true;
		handlers.remove(this);
	}
   
   ChatMessage myObject = null;
   private Socket incoming;

   boolean done = false;
   ArrayList<ChatHandler> handlers;

   ObjectOutputStream out;
   ObjectInputStream in;


}

