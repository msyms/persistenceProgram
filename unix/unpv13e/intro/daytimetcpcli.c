#include	"unp.h"

int
main(int argc, char **argv)
{
	int					sockfd, n;
	char				recvline[MAXLINE + 1];
	struct sockaddr_in	servaddr;

	if (argc != 2)
		err_quit("usage: a.out <IPaddress>");
	/**
	socket函数创建一个网际（AF_INET）字节流（SOCK_STREAM）套接字，它是TCP套接字的花哨名字
	该函数返回一个小整数描述符，yi9hou的所有函数调用（随后的connect和read）就用该描述符
	来标识这个套接字

	*/
	if ( (sockfd = socket(AF_INET, SOCK_STREAM, 0)) < 0)
		err_sys("socket error");

	/**
	12-16
	我们把服务器的IP地址和端口号填入一个网际套接字地址结构（一个名为servaddr的
	sockaddr_in结构变量）。使用bzero把整个结构清零后，置地址族为AF_INET，端口号为13
	（这是时间获取服务器的端口，支持该服务的任何TCP/IP主机都使用）
	*/

	bzero(&servaddr, sizeof(servaddr));
	servaddr.sin_family = AF_INET;
	//htons 主机到网络短整数
	servaddr.sin_port   = htons(13);	/* daytime server */
	//inet_pton 呈现形式到数值，将ASCII命令行参数转换而忽视的格式
	if (inet_pton(AF_INET, argv[1], &servaddr.sin_addr) <= 0)
		err_quit("inet_pton error for %s", argv[1]);

	/*17-18 connect函数应用于一个套接字时，将于由他的第二个参数指向的套接字地址结构指定的
		服务器建立一个tcp连接。
			头文件unp.h中，将SA定义为struct sockaddr
		*/
	if (connect(sockfd, (SA *) &servaddr, sizeof(servaddr)) < 0)
		err_sys("connect error");
	/*19-25 read函数读取服务器应答，fputs输出结果
			tcp是一个没有记录边界的字节流协议*/
	while ( (n = read(sockfd, recvline, MAXLINE)) > 0) {
		recvline[n] = 0;	/* null terminate */
		if (fputs(recvline, stdout) == EOF)
			err_sys("fputs error");
	}
	if (n < 0)
		err_sys("read error");

	exit(0);
}
