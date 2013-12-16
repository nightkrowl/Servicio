#!/usr/bin/python
# -*- coding: latin-1 -*-

import MySQLdb as mdb
import sys

carreras = ["Ingeniero en Tecnología de Software", "ITS" , 
            "Ingeniero Administrador de Sistemas", "IAS", 
            "Ingeniero en Electrónica y Comunicaciones", "IEC",
            "Ingeniero Mecánico Administrador","IMA",
            "Ingeniero Mecánico Electricista", "IME"]

try:
    # host, database user name, user's account password, db name
    con = mdb.connect(host='localhost', user='root', passwd='root', db='registro_escolar')

    #you must create a Cursor object. It will let you execute all the query youneed
    cursor = con.cursor()
    #execute the SQL statement
    cursor.execute('CREATE TABLE IF NOT EXISTS carreras (carrera INT NOT NULL AUTO_INCREMENT, nombre VARCHAR(80) NOT NULL, siglas CHAR(6) NOT NULL, PRIMARY KEY(carrera) ) ENGINE=InnoDB DEFAULT CHARSET=latin1')
    
    for i in range(0,len(carreras),2):
        query = "SELECT nombre FROM carreras WHERE nombre = '%s'" % (carreras[i])
        cursor.execute(query)
        if (cursor.rowcount  == 0):
            query = "INSERT INTO carreras(nombre, siglas) VALUES('%s', '%s')" % (carreras[i],  carreras[i+1])
            print query
            cursor.execute(query)
    con.commit()

except mdb.Error, e:
    print "Error %d: %s" % (e.args[0],e.args[1])
    sys.exit(1)

#release resources. 
finally:
    if con:
        con.close()
