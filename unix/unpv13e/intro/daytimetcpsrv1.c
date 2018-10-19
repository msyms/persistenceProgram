#include	"unp.h"
#include	<time.h>

int
main(int argc, char **argv)
{
	int					listenfd, connfd;
	socklen_t			len;
	struct sockaddr_in	servaddr, cliaddr;
	char				buff[MAXLINE];
	time_t				ticks;

	/**
	socket,bind,listen这三个调用步骤是任何tcp服务器准备所谓的监听描述符的正常步骤
	*/
	//tcp套接字创建
	listenfd = Socket(AF_INET, SOCK_STREAM, 0);

	bzero(&servaddr, sizeof(servaddr));
	servaddr.sin_family      = AF_INET;
	servaddr.sin_addr.s_addr = htonl(INADDR_ANY);
	servaddr.sin_port        = htons(13);	/* daytime server */

	Bind(listenfd, (SA *) &servaddr, sizeof(servaddr));
	//linten函数吧该套接字转换成一个监听套接字
	Listen(listenfd, LISTENQ);

	for ( ; ; ) {
		len = sizeof(cliaddr);
		/*通常情况下，服务器进程在accept调用中被投入睡眠，等待某个客户连接的到达并被内核接受
		tcp采用三次握手建立连接，完毕后accept返回已连接描述符，用来与新近连接的客户端通信，
		accept为每个连接到本服务器的客户返回一个新描述符
		*/
		connfd = Accept(listenfd, (SA *) &cliaddr, &len);
		printf("connection from %s, port %d\n",
			   Inet_ntop(AF_INET, &cliaddr.sin_addr, buff, sizeof(buff)),
			   ntohs(cliaddr.sin_port));

        ticks = time(NULL);
        snprintf(buff, sizeof(buff), "%.24s\r\n", ctime(&ticks));
        Write(connfd, buff, strlen(buff));

		Close(connfd);
	}
}
