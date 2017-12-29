
 //tester class
import java.util.Scanner;


public class TicTacToe_Tester 
{
	//Instance Variables
	static String res,win;
	static int xWinCount,oWinCount,tieCount;
	
	public static void main(String[] args)
	{
		//call consturctor
		TicTacToe test = new TicTacToe();
       
		
    	do
    	{
    		
    		test.playGame();
    		
    		 
    		 
    	 // response loop
    			do {
    				
    					Scanner in = new Scanner(System.in);
    					 
    					 System.out.println("Who Won?:  1 / 2 / Tie");
    					 win = in.next();
    					 win = win.toUpperCase();
    					 		
    					    	  if(win.charAt(0)== '1')
    					    	  {
    					    		  xWinCount++;
    					    	  }
    					    	  else if(win.charAt(0)== 'O')
    					    	  {
    					    		  oWinCount++;
    					    	  }
    					    	  else if(win.charAt(0)== 'T')
    					    	  {
    					    		  tieCount++;
    					    	  }
    					          System.out.println("Total player 1 Wins: " + xWinCount);
    					          System.out.println("Total player 2 Wins: " + oWinCount);
    					          System.out.println("Total Ties: " + tieCount);
    			
    						
    			                System.out.println("Play Another Game? Y/N");
    			                res = in.next();
    			                res = res.toUpperCase();
    		 		
    			        }
    			        while (res.charAt(0) != 'Y' && res.charAt(0) != 'N');  // Not Vaild Response

    	}
    			while (res.charAt(0) == 'Y');  

    	
    	
    }
	}
