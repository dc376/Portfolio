
 //method
import java.util.*;
public class TicTacToe
{
	//Intialize Variables
 public static final int EMPTY = 0;
 public static final int PLAYERX = 1;
 public static final int PLAYERO = 2;
 public static final int SIZE = 3;
  static int[][] board = new int [SIZE][SIZE];
  
  
//makes the board
  public static void displayBoard()
  {
//local variables 
    int col;
    int row;
    //Construct Board
    System.out.println();
    System.out.print(" ");
    for (col = 0; col < board.length; col ++)
    {
      System.out.print(" " + (col+1));
    }
    System.out.println();
    System.out.print(" ");
    for (col = 0; col < board.length; col ++)
    {
      System.out.print("--");
    }
    System.out.println("-");
    for (row = 0; row < board.length; row ++)
    {
      System.out.print((row+1) + "|");
      for (col = 0; col < board.length; col ++)
      {
    //Place blank space / X / O
        if (board[row][col] == EMPTY)
        {
          System.out.print(" ");
        }
        else if (board[row][col] == PLAYERX)
        {
          System.out.print("X");
        }
        else if (board[row][col] == PLAYERO)
        {
          System.out.print("O");
        }
        System.out.print("|");
      }
      System.out.println();
      System.out.print(" ");
      for (col = 0; col < board.length; col ++)
      {
        System.out.print("--");
      }
      System.out.println("-");
    }
  }
//clears the board
  public static void clear()
  {
    int col;
    int row;
    board = new int[SIZE][SIZE];
    for (row = 0; row < board.length; row ++)
    {
      for (col = 0; col < board.length; col ++)
      {
        board[row][col] = EMPTY;
      }
    }
  }
//player 2's turn
  public static void player2Selection()
  {
	//Prompt user for row & col
	  Scanner console = new Scanner (System.in);
	  //local variables
	    boolean a;
	    int col;
	    int row;
	    a = true;
	    while (a)
	    {
	      System.out.println("Player 2's Turn : Choose Row Number 1 - 3");
	      row = console.nextInt();
	      System.out.println("Choose Column Number 1 - 3");
	      col = console.nextInt();
	      if ((row < 1) || (row > board.length) || (col < 1) || (col > board.length))
	      {
	        System.out.println("Invalid choice, Must Be Between 1 - 3");
	      }
	      else
	      {
	        row --;
	        col --;
	        // If place is already taken 
	        if (board[row][col] != EMPTY)
	        {
	          System.out.println("Invalid, Choose Another Spot");
	          displayBoard();
	        }
	        else
	        {
	        //place O
	          board[row][col] =PLAYERO;
	          a = false;
	        }}
	    }}

 //player 1's moves
  public static void player1Selection()
  {
	  //Prompt user for row & col
  	Scanner console = new Scanner (System.in);
  	//local variables 
    boolean a;
    int col;
    int row;
    a = true;
    
    while (a)
    {
      System.out.println("Player 1's Turn : Choose Row Number 1 - 3");
      row = console.nextInt();
      System.out.println("Choose Column Number 1 - 3");
      col = console.nextInt();
      //Invalid Choice
      if ((row < 1) || (row > SIZE) || (col < 1) || (col > SIZE))
      {
    	  System.out.println("Invalid choice, Must Be Between 1 - 3");
      }
      else
      {
        row --;
        col --;
        //Place is already filled
        if (board[row][col] != EMPTY)
        {
          System.out.println("Invalid, Choose Another Spot");
          displayBoard();
        }
        else
        {
        	//Place X
          board[row][col] =PLAYERX;
          a = false;
        }}
    }}
//determines winner
  public static boolean end()
  {
	  //local variables
    int col;
    int row;
    int count;
    int win;
  
    win = EMPTY;
    for (row = 0; row < board.length; row ++)
    {
      count = 0;
      //Place is filled 
      if (board[row][0] != EMPTY)
        for (col = 0; col < board.length; col ++)
          if (board[row][0] == board[row][col])
            count ++;
      if (count == board.length)
        win = board[row][0];
    }
    for (col = 0; col < board.length; col ++)
    {
      count = 0;
      if (board[0][col] != EMPTY)
        for (row = 0; row < board.length; row ++)
          if (board[0][col] == board[row][col])
            count ++;
      if (count == SIZE)
        win = board[0][col];
    }
    count = 0;
    if (board[0][0] != EMPTY)
      for (row = 0; row < board.length; row ++)
        if (board[0][0] == board[row][row])
          count ++;
    if (count == board.length)
      win = board[0][0];
    count = 0;
    if (board[0][board.length-1] != EMPTY)
      for (row = 0; row < board.length; row ++)
        if (board[0][board.length-1] == board[row][board.length-row-1])
          count ++;
    if (count == board.length)
      win = board[0][board.length-1];
    if (win != EMPTY)
    {
    	//Player 1 Wins
      if (win == PLAYERX)
      {
    	
        System.out.println(" Player 1 Wins!");
        
      }
      //Player 2 Wins
        else if (win == PLAYERO)
        {
    	  
        System.out.println("Player 2 Wins");
        
        }
      return true;
    }
    count = 0;
    for (row = 0; row < board.length; row ++)
      for (col = 0; col < board.length; col ++)
        if (board[row][col] == EMPTY)
          count ++;
    if (count == 0)
    {
    	
      System.out.println("Tie Game!");

      return true;
    }
   
    return false;
  }
//to play game
   public static void playGame()
  {
    boolean e;
    clear();
    e = false;
    while (!e)
    {
      displayBoard();
      player1Selection();
      displayBoard();
      e = end();
      if (!e)
      {
        player2Selection();
        e = end();
        if (e)
          displayBoard();
      }
    }
  }}
