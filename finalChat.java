import java.awt.*;
import java.awt.List;
import java.awt.event.*;
import java.io.*;
import java.net.*;
import java.util.*;

public class finalChat extends Thread implements ActionListener{

    ChatMessage myObject;
	boolean sendingdone = false, receivingdone = false;
	Scanner scan;
	Socket socketToServer;
	ObjectOutputStream myOutputStream;
	ObjectInputStream myInputStream;
	Frame f;
	TextField tf;
	TextArea ta;
	String response;

	public finalChat(){	
		
		f = new Frame();
		f.setSize(1000,500);
		f.setTitle("My chat, wihteboard frame");
		f.addWindowListener(new WindowAdapter(){
			public void windowClosing(WindowEvent we){
				System.exit(0);
			}
		});
      tf = new TextField();
		tf.addActionListener(this);
		f.add(tf, BorderLayout.NORTH);
		ta = new TextArea();
		f.add(ta, BorderLayout.CENTER);
		
            
      MyPanel mpb = new MyPanel();
		f.add(mpb);
				
		try{						

			//scan = new Scanner(System.in);

			//myObject = new ChatMessage();

			socketToServer = new Socket("127.0.0.1", 4000);

			myOutputStream =
				new ObjectOutputStream(socketToServer.getOutputStream());

			myInputStream =
				new ObjectInputStream(socketToServer.getInputStream());
			start();
			
				
		}
		catch(Exception e){
			System.out.println(e.getMessage());	
        }
		f.setVisible(true);
	}
	public void actionPerformed(ActionEvent ae){
		myObject = new ChatMessage();
		myObject.setMessage(tf.getText());
		tf.setText("");
		
		try{
			myOutputStream.reset();
			myOutputStream.writeObject(myObject);
		}catch(IOException ioe){
			System.out.println(ioe.getMessage());
		}
		
	} 
  
   public void run(){
	    System.out.println(response + "has entered the chat");
		System.out.println("Listening for messages from server . . . ");
		try{
			while(!receivingdone){
				myObject = (ChatMessage)myInputStream.readObject();
               	ta.append(myObject.getMessage() + "\n");

			}
		}catch(IOException ioe){
			System.out.println("IOE: " + ioe.getMessage());
		}catch(ClassNotFoundException cnf){
			System.out.println(cnf.getMessage());
		}
	}
      
   
    
   public static void main(String[] args){
		
		finalChat fp = new finalChat();
		
	}

class MyPanel extends Panel implements ActionListener{


   Panel chatPanel;
	WhiteboardPanel wbPanel;
	Panel buttonPanel;
	List list;
	Button disconnect, connect;
   Scanner scan = new Scanner(System.in);
   
   public MyPanel(){
   
      setLayout(new BorderLayout());
		
		list = new List();
      
      //need a loop
		//for prepending name
		
			
		
		ChatMessage cm = new ChatMessage();
		System.out.println("Enter your name: ");
      	response = scan.nextLine();
      	
      	cm.setName(response);
      	
		
      
      
		list.add(cm.getName());
		add(list, BorderLayout.WEST);
		
		chatPanel = new Panel();
		chatPanel.setLayout(new BorderLayout());
      
		//TextField tf = new TextField();
      //tf.addActionListener(this);
      
		//TextArea ta = new TextArea();
      //tf.addActionListener(this);
            
		//chatPanel.add(tf, BorderLayout.NORTH);
		//chatPanel.add(ta, BorderLayout.CENTER);
		//add(chatPanel, BorderLayout.CENTER);
		
		wbPanel = new WhiteboardPanel();
		add(wbPanel, BorderLayout.EAST);
		
		buttonPanel = new Panel();
		connect = new Button("Connect");
		disconnect = new Button("Disconnect");
		disconnect.setEnabled(true);
		buttonPanel.add(connect);
		buttonPanel.add(disconnect);
		disconnect.addActionListener(this);
		connect.addActionListener(this);
		
		add(buttonPanel, BorderLayout.SOUTH);
   
   }
   public void actionPerformed(ActionEvent ae){
   if (ae.getSource() == disconnect){
	   f.setVisible(false);
	   System.out.println(response + " has left the chat");
	   
   }
   if(ae.getSource() == connect){
	   finalChat ff = new finalChat();
	   System.out.println(response + " has enter the chat");
	   
	   
   }
   }	   
}

class WhiteboardPanel extends DoubleBuffer implements MouseListener, MouseMotionListener, ActionListener{
	
	Button green, blue, red, cyan, magenta;
   Dimension minimum;
	Dimension preferred;
	Panel drawPanel;
	Panel buttonPanel;
   
   int lastX=0, lastY=0;
	ArrayList<Line>lines;
	Color drawColor;

	
		public WhiteboardPanel(){
			setLayout(new BorderLayout());
			minimum = new Dimension(200,200);
			preferred = new Dimension(500,500);
			
			drawPanel = new Panel();
			buttonPanel = new Panel();
         
			Button red = new Button("Red");
         red.addActionListener(this);
         
			Button green = new Button("Green");
         green.addActionListener(this);
         
			Button blue = new Button("Blue");
         blue.addActionListener(this);
         
			Button cyan = new Button("Cyan");
         cyan.addActionListener(this);
         
			Button magenta = new Button("Magenta");
         magenta.addActionListener(this);
         
			buttonPanel.add(red);
			buttonPanel.add(green);
			buttonPanel.add(blue);
			buttonPanel.add(cyan);
			buttonPanel.add(magenta);
			add(buttonPanel, BorderLayout.SOUTH);
			f.add(drawPanel, BorderLayout.CENTER);
         
         lines = new ArrayList<Line>();
		   setBackground(Color.white);
		   drawColor = Color.black;
		   setForeground(drawColor);
		   addMouseListener(this);
		   addMouseMotionListener(this);  
			
		}
      
		public Dimension getMinimumSize(){
			return minimum;
		}
		public Dimension getPreferredSize(){
			return preferred;
		}
      public void mouseExited(MouseEvent me){}
	   public void mouseClicked(MouseEvent me){}
	   public void mouseReleased(MouseEvent me){}
	   public void mouseEntered(MouseEvent me){
	   	record(me.getX(), me.getY());
	   }
	   public void mousePressed(MouseEvent me){
	   	record(me.getX(), me.getY());
	   }
	   public void mouseMoved(MouseEvent me){}
      public void mouseDragged(MouseEvent me){
	   	int x = me.getX();
	   	int y = me.getY();
	   	lines.add(new Line(lastX, lastY, x, y, drawColor));
	   	record(x, y);
	   	repaint();
      }
	   public void paint(Graphics g){
	   	for(Line line: lines){
            g.setColor(line.getColor());
	   		g.drawLine(line.getStartX(), line.getStartY(), line.getEndX(), line.getEndY());
	   	}
	   }
	   protected void record(int x, int y) {
	   	lastX = x;
	   	lastY = y;
	   }
      public void actionPerformed(ActionEvent ae){
   
         if(ae.getSource() == red){
         
               drawColor = Color.red;                        
         }  
      
         if(ae.getSource() == green){
         
               drawColor = Color.green;      
         } 
   
         if(ae.getSource() == blue){
         
               drawColor = Color.blue; 
         }  
     
         if(ae.getSource() == cyan){
         
               drawColor = Color.cyan;              
         }  
      
         if(ae.getSource() == magenta){
         
               drawColor = Color.magenta;        
         }  
   }
      

      class Line{

    		int startx, starty, endx, endy;
    	   Color color;
    		
    		public Line(){}
    		public Line(int startx, int starty, int endx, int endy, Color color){
    			setStartX(startx);
    			setStartY(starty);
    			setEndX(endx);
    			setEndY(endy);
    	      setColor(color);
    	      
    		}
    	   public void setColor(Color color){
    	      this.color = color;
    	   }
    	   public Color getColor(){
    	      return color;
    	   }
    		public void setStartX(int startx){
    			this.startx = startx;
    		}
    		public void setStartY(int starty){
    			this.starty = starty;
    		}
    		public void setEndX(int endx){
    			this.endx = endx;
    		}
    		public void setEndY(int endy){
    			this.endy = endy;
    		}
    		public int getStartX(){
    			return startx;
    		}
    		public int getStartY(){
    			return starty;
    		}
    		public int getEndX(){
    			return endx;
    		}
    		public int getEndY(){
    			return endy;
    		}
    	}
}


}


   

   
