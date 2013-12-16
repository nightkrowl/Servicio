#!/usr/bin/python 
# -*- coding: latin-1 -*-

import MySQLdb as mdb
import sys

try:
    con = mdb.connect(host='localhost', user='root', passwd='root', db='registro_escolar')
    cursor = con.cursor()

    cursor.execute('CREATE TABLE IF NOT EXISTS salones (salon TINYINT NOT NULL AUTO_INCREMENT, aula CHAR(6) NOT NULL, PRIMARY KEY (salon)) ENGINE=InnoDB DEFAULT CHARSET=latin1')

    i = 1101;
    n = 0
    while True:
        for y in range(i,i+9):
            query = "INSERT INTO salones(aula) VALUES('%s')" % (y)
            cursor.execute(query)
            print y
        con.commit()
        i += 100
        n += 1
        if (n == 4):
            i +=600
            n += 1
        
        if (i==6101):
            break

except mdb.Error, e:
    print "Error %d: %s" % (e.args[0],e.args[1])
    sys.exit(1)

finally:
    if con:
        con.close()
