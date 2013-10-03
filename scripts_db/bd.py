#!/usr/bin/python

import MySQLdb as mdb
import sys

maestros = {nombre: 'Amelia', apellido:'Gonzalez Cantu':, usuario:'1234567', contra:'abc' , correo:'amelia@gmail.com', materia:'Fisica 1'}#,nombre: 'Amelia Gonzalez Cantu', apellido:, usuario:, contra: , correo:, materia:,nombre: 'Amelia Gonzalez Cantu', apellido:, usuario:, contra: , correo:, materia:}

try:
    # host, database user name, user's account password, db name
    con = mdb.connect(host='localhost', user='root', passwd='root', db='registro_escolar')
    #you must create a Cursor object. It will let you execute all the query you need
    cur = con.cursor()
    #execute the SQL statement
    cur.execute('SELECT VERSION()')
    ver = cur.fetchone()
    print "Database version : %s " % ver

except mdb.Error, e:
    print "Error %d: %s" % (e.args[0],e.args[1])
    sys.exit(1)

#release resources.
finally:
    if con:
        con.close()
