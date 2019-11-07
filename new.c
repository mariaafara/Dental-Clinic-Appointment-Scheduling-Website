#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/types.h>
#include <signal.h>
#include <sys/wait.h>
#include <fcntl.h>
#include <termios.h>

int pid; //mufide lal control -c



void shellPrompt()
{
	
	char* currentDirectory = (char*) calloc(1024, sizeof(char));

	printf("FAQISHELL-%s > ",  getcwd(currentDirectory, 1024));

}


void Debut()
{
        printf("\n\t============================================\n");
        printf("\t               Fakih's Shell\n");
        printf("\t============================================\n");
        printf("\n\n");
}

// Method to change directory
 
int changeDirectory(char* args[])
{
	// If only cd
	if (args[1] == NULL)//iza ketb cd wl args 1 = null y3n cd wenter bekhdo home
	{
		chdir(getenv("HOME"));  
		return 1;
	}
	else
	{ 
		if (chdir(args[1]) == -1) 
		{
			printf(" %s: no such directory\n", args[1]);
		            return -1;
		}
		else
			return 1;
	}
	return 0;
}

/*
void fPipe(char * args[]){
	*/	



void fPipe1(char * args[], char* inputFile, char* outputFile, int option)
{
	 
	int status;//kermel 23mel wait
	int fileDescriptor; //kermel huwe byft7 fi lfileee 

	pid=fork();//krmel leben huwe bdo ysht8l she8l msshh lbay
	if(pid==0)//bel child
	{
		// >
		if (option == 0){//y3ne eno yktob be aleb lfile (st3mlta kreml mrat lma kena nktobb eb3t > w7de y3melappend fa searched and found that hay admn)
			fileDescriptor = open(outputFile, O_CREAT | O_TRUNC |  O_WRONLY); /// ftht lfile ana 3m ektb bl outputfile ,mode o_creat , otrunnc,o_wrony
			close(1);			//sakrt lsheshe
			dup(fileDescriptor); // 7atet filedescreptor be aleb lsheshe  y3ne 3m yktop fiiiii
			if (execvp(args[0],args)==-1)
			{//iza keteb command 8alat
				printf("%s Command not found \n",args[0]);
				kill(getpid(),SIGTERM); //be2toul haleee  krmel lexit ma atlitlo ma fwta 
			}

			exit(1);
		
		}
		else if (option == 1){ // < >  3m tu2ra  mn fil wtkbon be file tene
			fileDescriptor = open(inputFile, O_RDONLY);  //awal step ino ou2ra mn file  fa fat7too ismo  inout file wl mode readonly
			if(fileDescriptor != -1)
			{			
				dup2(fileDescriptor, 0); //htyna fiel descreptorr m7al stdin lhye linput  0 hye lkeyboard 

				fileDescriptor = open(outputFile, O_CREAT | O_TRUNC  | O_WRONLY); // ftht loutput
				dup2(fileDescriptor, 1);// file tene m7al loutputt

				if (execvp(args[0],args)==-1)// 3mlt exec 
				{
					printf("%s Command not found \n",args[0]);
					kill(getpid(),SIGTERM);
				}	 
			}
			else
				printf("No File Name %s \n",inputFile);
			
			exit(1);
																
		}
		else if (option == 2){// >> append zid 3l file 
			fileDescriptor = open(outputFile, O_CREAT | O_APPEND | O_WRONLY );  // o_append o_write only iza ma fi shi bktob 
			close(1);			
			dup(fileDescriptor); 
			if (execvp(args[0],args)==-1)
			{
				printf("%s Command not found \n",args[0]);
				kill(getpid(),SIGTERM);
			}
			exit(1);
		}
		else if (option == 3){// < sort mn file  bou3rd 3l sheshe 
			fileDescriptor = open(inputFile, O_RDONLY);
			if(fileDescriptor != -1)
			{
				close(0);// skrna lkeyboard 
				dup(fileDescriptor);
				if (execvp(args[0],args)==-1)
				{
					printf("%s Command not found \n",args[0]);
					kill(getpid(),SIGTERM);
				}
			}
			else
				printf("No File Name %s \n",inputFile);
				
			exit(1);
		}		 		
	}

	wait(&status);// krmelll bayo lhye lshelll  yntrooooo lken 5las she8elll 
}



void fExec(char **args, int background)
{	 
	 
	int status;
	int n,m;
	pid=fork();

	if(pid==0)
	{
		if (execvp(args[0],args)==-1)
		{
			printf("%s Command not found \n",args[0]);
			kill(getpid(),SIGTERM);
		}
	}
	
	if (background == 0)//y3ne mshketeb & y3ne command 3ade
	{
		wait(&status);// bdl nater lwlad ymout
		
	}
	else
	{
		 printf("Process created with PID: %d\n",pid);//n5l2 process hl pid wmshakid met
	}	 

}




void fExec1(char **args)//execution la aktar mn program sawa
{	 
	 
	char * temp[30];//3m 3be fiya kel lvalues ben l& wl & 
	int status;//krmel yntor
	int i=0,j=0,k=0;//counters
	int end=0;
	//i fiha nb de command
	//j bemshe fiha 3l tableau kello
	//k b3be fiha kel partie
	while(end != 1)
	{
		k = 0;// // 3m fadi 3m rje3 lpointer lal awal
		//bjame3 kell command la halo
		
		while (strcmp(args[i],"&") != 0)//talama ana ma3m bektob and
		{
			temp[k] = args[i];
			i++;	
			if (args[i] == NULL)
			{
				end = 1;
				k++;// kermell 3m 3bi null bl akhir
				break;
			}
			k++;
		}

		temp[k] = NULL;
		i++;		
		pid=fork();
		if(!pid)
		{
			if (execvp(temp[0],temp)==-1)
			{
				printf("%s Command not found\n",temp[0]);
				kill(getpid(),SIGTERM);
			}
		}
		
		j++;
	}
	for(i=0;i<j;i++)	
		wait(&status);	
}


int Handler(char * args[]){
	int i=0;
	int j=0;
	int f;
	int s;
	int bg = 0;
	char *args1[30];
	
	while ( args[j] != NULL) //mst3mla bs b pipe t3il l < w 3yleta
	{
		if ( (strcmp(args[j],">") == 0) || (strcmp(args[j],"<") == 0) || (strcmp(args[j],"&") == 0) || (strcmp(args[j],">>") == 0)){
			j++;
			break;
		}
		args1[j] = args[j];
		j++;
	}
	args1[j]=NULL;// awal command la abel l carac special eza kenet mawjude



	if(strcmp(args[0],"exit") == 0)
	{
	        printf("\n\t============================================\n");
	        printf("\t               Fakih's Shell Terminated\n");
	        printf("\t============================================\n");
	        printf("\n\n");
			exit(0);

	}
	else if (strcmp(args[0],"clear") == 0)
		 system("clear");
	else if (strcmp(args[0],"cd") == 0)
		 changeDirectory(args);
	
		
	else
	{
		while (args[i] != NULL )//i=0
		{
			if (strcmp(args[i],"&") == 0)
			{
				if( args[i+1] != NULL )
				{
					fExec1(args);	//		iza ketbe  & byf7as  bi i+1 eno msh null y3ne fi shi b3d byb3ta 3l function le 2ela
						return 1;
	
				}
				else
				{
					bg= 1;
					break;
				}
			}
			else if (strcmp(args[i],"|") == 0)
			{

				fPipe(args);
				return 1;
			}
			else if (strcmp(args[i],"<") == 0)
			{
				if (args[i+1] != NULL && args[i+2]== NULL )
				{
					//args1 m2sam fi awal tu2sime , args i+1 keteb lfile lbde ektob menooo wll null l2no 3m 2u22ra mnn file iza 3m bektob b3tiya value
					fPipe1(args1,args[i+1],NULL,3);//null  l2no ma bde ektob be mahal hon   3m jib mn l args i+1... le 3 hye option ino tu2r wt3ml execute
					return 1;
				}
			else	if(args[i+1] != NULL &&  strcmp(args[i+2],">")==0 && args[i+3]!=NULL )
				{
				//a args1<b args  i+1>c args i+3 	
					fPipe1(args1,args[i+1],args[i+3],1);
					return 1;
				
				}
				
				else 
				{
					printf("Not enough input arguments\n");
					return -1;
				
				}
			}
			else if (strcmp(args[i],">") == 0)//hon 3m bektob be fileee  
			{
				if (args[i+1] == NULL)
				{
					printf("Not enough input arguments\n");//lakbar msln ketbe akbr bala esem lfile
					return -1;
				}
				fPipe1(args1,NULL,args[i+1],0); option 0 l null l2no mfi inputtt 
				return 1;
			}
			else if (strcmp(args[i],">>") == 0)//bziddd 3lyhonn 
			{
				if (args[i+1] == NULL){
					printf("Not enough input arguments\n");
					return -1;
				}
				fPipe1(args1,NULL,args[i+1],2);
				return 1;
			}
			i++;
		}
		//bkun khalas kel l boucle w ma le2a charactere special
		fExec(args1,bg);// akbr aaz8r aw 3moud or & bikun already nb3t 3l fct le2elo 
	}
	return 1;
}


void signalInt(int pid)
{
int i;
i=kill(pid,SIGTERM);// fiya value knt m3tito yeee mn l maain iza msln de8re 3melet ctr c mn awal ma ftht lshell so ta ma y3tin error
//bikun by deafult 3tito -10
     if(i == 0)
    {
       printf("the child dead");// iza n2tl lwlad
    }
     else// ma n2tl  iza ma ktbe shi w3mlt ctr c 
    {
      printf("\t continue");
      prompt();
      fflush(stdout);
    }
}




int main(int argc, char *argv[], char ** envp) 
{

	char line[1024]; //lal input line 
	char * tokens[256];// 3m hot fi ltou2sim
 

	int numTokens;
		
	pid = -10; // initalisation 
	
	Debut();// lprompt


	signal(SIGINT,signalInt);//control c handler


	while(1)
	{
		shellPrompt();

		// We empty the line buffer
		memset ( line, '\0', 1024);

		// We wait for user input
		fgets(line, 1024, stdin);

		//new line	
		if((tokens[0] = strtok(line," \n\t")) == NULL)
			 continue;


		
		numTokens = 1;
		while((tokens[numTokens] = strtok(NULL, " \n\t")) != NULL) 
			numTokens++;
		
		Handler(tokens);
		
	}          

	exit(0);
}


