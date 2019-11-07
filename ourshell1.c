#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<unistd.h>
#include<sys/types.h>
#include<sys/wait.h>
#define Size 1024
#define buf_split_size 64
#define Delemetres " \t\r\n\a"
#define pipe_ "|"

//=======================================================================================================
void initShell()
{
    system("clear");
    printf("\n\n\n\n******************"
        "************************");
    printf("\n\n\n\t****Welcome To Our Shell****");
    printf("\n\n\t-Mariya and Mohammad-");
    printf("\n\n\n\n*******************"
        "***********************");
    printf("\n");
    //sleep(1);

}


//=======================================================================================================
//reading inputs
char *inputReading(void)
{
  int bufsize = Size;
  int position = 0;
  char *buffer = malloc(sizeof(char) * bufsize);
  int c;

  if (!buffer) {//if no space to allocate buffer
    printf("maria: allocation error\n");
    exit(0);
  }

  while (1) {
    // Read a character from stdin
    c = getchar();

    // If we hit EOF, replace it with a '\0' and return.
    if (c == EOF || c == '\n') {
      buffer[position] = '\0';
      return buffer;
    } else {//buffer is saving the characters
      buffer[position] = c;
    }
    position++;

    // If we have exceeded the buffer, reallocate.
    if (position >= bufsize) {
      bufsize += Size;
      buffer = realloc(buffer, bufsize);
      if (!buffer) {
        printf("lsh: allocation error\n");
        exit(0);
      }
    }
  }
}
//=======================================================================================================

char **splitingInput(char *line){//spliting from delemeters the saved line from the stdin since the execvp executes the arguments that are splitted from delemeters
  int bufsize = buf_split_size, position = 0;
  char **args = malloc(bufsize * sizeof(char*));
  char *arg;

  if (!args) {//if we cannot allocat args
    printf("lsh: allocation error\n");
    exit(0);
  }

  arg = strtok(line, Delemetres);//strtok generates pointers of the arg that are splited from the given delemeters
  while (arg != NULL) { //while we still have an arguments to split
    args[position] = arg;// we are storing the argument in the array of arguments while the above condition is true
    position++;

    if (position >= bufsize) {//if we exeeds the allocated size we realloc
      bufsize += buf_split_size;
      args = realloc(args, bufsize * sizeof(char*));
      if (!args) {// if we fail to realloc args we will exit
        printf("lsh: allocation error\n");
        exit(0);
      }
    }

    arg = strtok(NULL, Delemetres);
  }
  args[position] = NULL;//after we finish splitting we put null at the last of args since when executing execvp we should give the last argument which is null or (char *)null
  return args;
}
//=======================================================================================================

char **splitingPipe(char *line){//this is used when we have a pipe inorder to make a first split on '|' and then we will use the above method to split delemeters of each agument
//for splitting the pipe same procedure is followed as in func splittingInput but here we replace the delemeters whith the pipe character '|'
  int bufsize = buf_split_size, position = 0;
  char **args = malloc(bufsize * sizeof(char*));
  char *arg;

  if (!args) {
    printf("lsh: allocation error\n");
    exit(0);
  }

  arg = strtok(line, pipe_);
  while (arg != NULL) {
    args[position] = arg;
    position++;

    if (position >= bufsize) {
      bufsize += buf_split_size;
      args = realloc(args, bufsize * sizeof(char*));
      if (!args) {
        printf("lsh: allocation error\n");
        exit(0);
      }
    }

    arg = strtok(NULL, pipe_);
  }
//  args[position] = NULL;
  return args;
}

//=======================================================================================================
/*
  Function Declarations for builtin shell commands:(cd and exit)
 */
int cd(char **args);
//int help(char **args);
int exiting(char **args);

/*
  List of builtin commands, followed by their corresponding functions.
 */
char *builtin_str[] = {
  "cd",
  "exit"
};
//pointer 3ala array of functions  args lhye pointr 3a array
int (*builtin_func[]) (char **) = {
  &cd,
  &exiting
};

int num_builtins() {
  return sizeof(builtin_str) / sizeof(char *);
}

/*
  Builtin function implementations.
*/
int cd(char **args)
{
  if (args[1] == NULL) {
    printf("lsh: expected argument to \"cd\"\n"); 
  } else {
    if (chdir(args[1]) != 0) {//this function changes the process's current work directory biku 3m yshte8el hon bsir 3m ysht8l bel mtr7 ltyto
	printf("error");
    }
  }
  return 1;
}

//=======================================================================================================
int exiting(char **args){ // this returs 0 in execution which meen we will call exit(0) to end the program execution
  return 0;
}

//=======================================================================================================

int parsePipeCount(char* str){//, char** strpiped){
//we give this function the line entered from stdin and this will check if their are pipes in oreder to know how to execute this statment
//printf("In parsePipeCount");
int count=0;
int i=0;
	while(1){
		if(str[i]=='\0'){
			return count;
		}
		else{
			if(str[i]=='|'){
				count++;
			}
			i++;
		//puts(str);
		}

	}

	return count;
}
//=======================================================================================================
//
int launch(char **args){// it used if their are no pipes we should give the work for a child inorder to keep the program running otherwise the program will execute the args and terminate
  pid_t pid, wpid;// ana lparent 3m ynfez process by3mla bimout so an abekhl2 eben y3ml lprocess tb3 lbay by3mela wbimout wl bay bekafe ywfet inputs
  int status;

  pid = fork();
  if (pid == 0) {
    // Child process
    if (execvp(args[0], args) == -1) {
      perror("lsh");
    }
    exit(0);
  } else if (pid < 0) {
    // Error forking
    printf("Cann't fork");
  } else {
    // Parent process
    do {
      wpid = waitpid(pid, &status, WUNTRACED);
    } while (!WIFEXITED(status) && !WIFSIGNALED(status));
  }

  return 1;
}
//=======================================================================================================
int executing(char **args){
  int i;

  if (args[0] == NULL) {
    // An empty command was entered.
    return 1;
  }

  for (i = 0; i < num_builtins(); i++) {
    if (strcmp(args[0], builtin_str[i]) == 0) {
      return (*builtin_func[i])(args);
    }
  }

  return launch(args);
}

//=======================================================================================================

//=======================================================================================================
void execArgsPiped1(char** parsed, char** parsedpipe)//hay tb3it bas one pipe
{
printf("in execArgsPiped1...\n");
puts(parsed[0]);
puts(parsedpipe[0]);
int sts1,sts2;
    // 0 is read end, 1 is write end
    int pipefd[2]; 
    pid_t p1, p2;
 
    if (pipe(pipefd) < 0) {
        printf("\nPipe could not be initialized");
        return;
    }
    p1 = fork();
    if (p1 < 0) {
        printf("\nCould not fork");
        return;
    }
 
    if (p1 == 0) {
printf("in p1\n");
        // Child 1 executing..
        // It only needs to write at the write end
//close(1);
        close(pipefd[0]);
        dup2(pipefd[1],1);//, STDOUT_FILENO);
        //close(pipefd[1]);
//sleep(3);
 //printf("in p1 after dup\n");
        if (execvp(parsed[0], parsed) < 0) {
            printf("\nCould not execute command 1..");
            exit(sts1);
        }

// printf("in p1 after execvp\n");
    } else {
        // Parent executing
//printf("waiting child 1....");
//            wait(NULL);
sleep(1);
        p2 = fork();
 
        if (p2 < 0) {
            printf("\nCould not fork");
            return;
        }
 
        // Child 2 executing..
        // It only needs to read at the read end
        if (p2 == 0) {
printf("in p2\n");
//close(0);
            close(pipefd[1]);
            dup2(pipefd[0],0);//, STDIN_FILENO);
          //  close(pipefd[0]);
 printf("in p2 after dup\n");
puts(parsedpipe[0]);
system(parsedpipe[0]);
int x=execvp(parsedpipe[0], parsedpipe) ;
//printf("execvp result:%d",x);
            if (x< 0) {
                printf("\nCould not execute command 2..");
                exit(sts2);
            }
 printf("in p2 after execvp\n");
        } else {
            // parent executing, waiting for two children
//sleep(2);
close(pipefd[1]);
close(pipefd[0]);
 printf("waiting...\n");
            wait(&sts1);
            wait(&sts2);
        }
    }
}
//=======================================================================================================
int launchMany(char *args){// it used if their are no pipes we should give the work for a child inorder to keep the program running otherwise the program will execute the args and terminate
  pid_t pid, wpid;
  int status;

  pid = fork();
  if (pid == 0) {
    // Child process
   system(args);
    
    //exit(0);
  } else if (pid < 0) {
    // Error forking
    printf("Cann't fork");
  } else {
    // Parent process
    do {
      wpid = waitpid(pid, &status, WUNTRACED);
    } while (!WIFEXITED(status) && !WIFSIGNALED(status));
  }

  return 1;
}


//=======================================================================================================

void shell_loop(){
  char *line;
  char **args;

int x;
  initShell();  
  do {
    printf(">>>>> ");
    line = inputReading();

    x=parsePipeCount(line);   

if(x==1){
char  **args1;
char  **args2;
    args=splitingPipe(line);
	puts(args[0]);
	puts(args[1]);
args1=splitingInput(args[0]);
args2=splitingInput(args[1]);

execArgsPiped1(args1,args2);
}
else{
if(x>=2){

system(line);
}
else{
args = splitingInput(line);
executing(args);
}  }
    free(line);
    free(args);
  } while (1);
}
//=======================================================================================================
void end(int s){
 printf("\n\n\n\n******************"
        "************************");
    printf("\n\n\n\t****Good Bye****");
    printf("\n\n\t-Mariya and Mohammad-");
    printf("\n\n\n\n*******************"
        "***********************");
    printf("\n");  
    exit(0);

}
//=======================================================================================================
int main(){
signal(SIGINT,end);
shell_loop();
  pause();

  return 0;
}
//=======================================================================================================

