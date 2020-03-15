#define _GNU_SOURCE 1
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <assert.h>
#include <stdio.h>
#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <poll.h>
#include <fcntl.h>

#define USER_LIMIT 5 /*最大用户数*/
#define BUFFER_SIZE 64 /*读缓冲区的大小*/
#define FD_LIMIT 65535 /*文件描述符数量限制*/

/*客户数据：客户端socket地址、待写到客户端的数据的位置、从客户端读入的数据*/
struct client_data
{
	sockaddr_in address;
	char* write_buf;
	char buf[ BUFFER_SIZE ];
};

int setnonblocking( int fd )
{
	int old_option = fcntl( fd, F_GETFL );
	int new_option = old_option | O_NONBLOCK;
	fcntl( fd, F_SETFL, new_option );
	return old_option;
}

int main( int argc, char* argv[] )
{
	if( argc <= 2 )
	{
		printf("usage:%s ip_address port_number\n", basename(argv[0]) );
		return 1;
	}
	const char* ip = argv[1];
	int port = atoi( argv[2] );

	struct sockaddr_in address;
	bzero(&address,sizeof(address));
	address.sin_family = AF_INET;
	inet_pton(AF_INET, ip, &address.sin_addr);
	address.sin_port = htons(port);

	int listenfd = socket( PF_INET, SOCK_STREAM, 0 );
	assert( listenfd >= 0 );

	ret = bind( listenfd, ( struct sockaddr* )&address, sizeof( address ));
	assert( ret != -1 );

	ret = listen( listenfd, 5 );
	assert( ret != -1 );

	/*创建users数组，分配FD_LIMIT个client_data对象，可以预期：每个可能的socket链接都可以获得
		一个这样的对象，并且socket的值可以直接用来索引（作为数组的下标）socket链接对应的
		client_data对象，这是将socket和客户数据关联的简单而高效的方法*/
	client_data* users = new client_data[FD_LIMIT];
	/*尽管我们分配了足够多的client_data对象，但为了提高poll的性能，仍然有必要限制用户的数量*/
	pollfd fds[USER_LIMIT + 1];
	int user_counter = 0;
	for( ini i = 1; i <= USER_LIMIT; ++i )
	{
		fds[i].fd = -1;
		fds[i].events = 0;
	}
	fds[0].fd = listenfd;
	fds[0].events = POLLIN | POLLERR;
	fds[0].revents = 0;

}
