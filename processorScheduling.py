##Dean Cristman
##CS 332 Final Project

#############################################################
############first come first serve algorithm###############
##########################################################


import csv
#gets the csv file and reads it in
ifile  = open('example.csv', "r")
read = csv.reader(ifile)
#lists to keep data in
burstTime = []
arriveTime= []
procName = []
#extracts data from and appends each to list, named as such
for row in read :
    procName.append(row[0])
    burstTime.append(row[2])
    arriveTime.append(row[1])

    
#prints first come first serve
print("FCFS\n" , procName)


#######################################################
###############Shortest Remaining Time#################
#######################################################



#concatenates the two lists
a = procName + burstTime

#blank lists to fill each process
aProc=[]
bProc=[]
cProc=[]
dProc=[]
eProc=[]

#processes combined with there service time
aProc= (a[5]) + "," + (a[0])
bProc = (a[6]) + "," + (a[1])
cProc = (a[7]) + "," + (a[2])
dProc = (a[8]) + "," + (a[3])
eProc = (a[9]) + "," + (a[4])

#creating a master  list
cat = [aProc,bProc,cProc,dProc,eProc]
#sorting the master list to shortest time first
cat.sort()

#printing SRT and some formatting to strip the list away, seperated by commas
print("SRT\n" ,cat[0][2], ", ",cat[1][2], ", ",  cat[2][2], ", ", cat[3][2], ", ", cat[4][2])


##############################################################
#############Highest Response Ratio Next######################
#############################################################

#time is set to 0 for the while loop, and created a blank list
t = 0
hrrtList = []



#checks grant table to make sure first iteration service times are < 9 seconds
#then places them into a list to be displayed later
checkMath = int(burstTime[0]) + int(burstTime[1])

if(checkMath <= 9):
    hrrtList.append(procName[0])
    hrrtList.append(procName[1])
    hrrtList.append(procName[2])

#equations to find the next highest ratios to be scheduled
firstMath = int(arriveTime[3]) + int(burstTime[3])/int(burstTime[3])
secondMath= int(arriveTime[4]) + int(burstTime[4])/int(burstTime[4])

#conditional statement to place the last two processes to be scheduled
if(firstMath > secondMath):
    hrrtList.append(procName[3])
    hrrtList.append(procName[4])
    
else:
    hrrtList.append(procName[4])
    hrrtList.append(procName[3])
#print statement to display the process + some formatting    
print("HRRN\n" , hrrtList[0] , ", " , hrrtList[1], ", ", hrrtList[2], ", ", hrrtList[3], ", ", hrrtList[4])



###########################################################
###################Round Robin#############################
###########################################################


#create time quantum of 3
quantum = 3

#find the total service time
totalTime = int(burstTime[0]) + int(burstTime[1]) + int(burstTime[2]) + int(burstTime[3]) + int(burstTime[4]) 

#blank list and counter tick
rrList = []
tick = 0

#loop for while the counter is less than total time
while (tick <= totalTime):
    #for loop to append tasks to list
    for i in range(totalTime):
        #counter for totalTime
        tick+=1
        #if loops to change at every 3 seconds for RR
        if(tick ==3):
            rrList.append(procName[0])
        if(tick==6):
            rrList.append(procName[1])
        if(tick==9):
            rrList.append(procName[2])
        if(tick==12):
            rrList.append(procName[3])
        if(tick==15):
            rrList.append(procName[4])
        if(tick==18):
            rrList.append(procName[0])
        if(tick==21):
            rrList.append(procName[1])
#prints the RR list.
print("Round Robin\n" , rrList)
