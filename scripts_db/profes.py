#!/usr/bin/python
# -*- coding: latin-1 -*-

import MySQLdb as mdb
import sys
from random import choice

#nombre, apellidos, usuario, contra, email, materia1, materia2, materia3

#secuencia
sec = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z']

nums = ['0','1','2','3','4','5','6','7','8','9']

def get_string():
    a = ''
    for i in range(6):
        a += choice(sec)
    return a

def get_num():
    a = ''
    for i in range(6):
        a += choice(nums)
    return a

try:
     con = mdb.connect(host='localhost', user='root', passwd='root', db='registro_escolar')

     cursor = con.cursor()
     
     #cursor.execute()

except mdb.Error, e:
    print "Error %d: %s" % (e.args[0],e.args[1])
    sys.exit(1)

#release resources.
finally:
    if con:
        con.close()

