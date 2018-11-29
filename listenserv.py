#!/usr/bin/env python
import re
import pymysql
import socket
import threading

connDB = pymysql.connect (host="localhost", user="root", passwd="dbpassword", db="eParking")

TCP_IP = '45.79.210.122'
TCP_PORT = 5005
BUFFER_SIZE = 30  # Normally 1024, but we want fast response

tcp_server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
tcp_server.bind((TCP_IP, TCP_PORT))
tcp_server.listen(5)

#conn, addr = s.accept()
#print ('Connection address:', addr)
print ('Listening on {}:{}'.format(TCP_IP, TCP_PORT))

def handle_client_connection(client_socket):
    tcp_data = client_socket.recv(1024)
    print ('Received {}'.format(tcp_data))
    tcp_message = tcp_data.decode()
    
    print(tcp_message)
    tcp_message = tcp_message.split(',')
    tcp_lotnum = tcp_message[0]
    tcp_spacenum = tcp_message[1]
    tcp_vacancy = tcp_message[2]
    
    print(tcp_lotnum)
    print(tcp_spacenum)
    print(tcp_vacancy)
    
    try:
        #print("IN")
        if tcp_lotnum.startswith('1'):
            print("Updating...")
            updateConn = connDB.cursor()
            updateConn.execute("""UPDATE parking_lot_1 SET vacant = %s WHERE space_num = %s""", (tcp_vacancy, tcp_spacenum))
            connDB.commit()
    except DataError as err:
        print("ERROR")
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Bad username or password.")
    
    
    ack_message = "Message received"
    ack_message = ack_message.encode()
    client_socket.send(ack_message)
    client_socket.close()
    
while True:
    client_sock, address = tcp_server.accept()
    print ('Accepted connection from:{}:{}'.format(address[0], address[1]))
    client_handler = threading.Thread(
        target=handle_client_connection,
        args=(client_sock,)
    )
    client_handler.start()




