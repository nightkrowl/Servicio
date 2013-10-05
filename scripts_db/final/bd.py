#!/usr/bin/python
#-*- coding: utf-8 -*-

import MySQLdb as mdb
import sys
import random
import string

carreras = [u"Ingeniero en Tecnología de Software", "ITS" , 
            u"Ingeniero Administrador de Sistemas", "IAS", 
            u"Ingeniero en Electrónica y Comunicaciones", "IEC",
            u"Ingeniero Mecánico Administrador","IMA",
            u"Ingeniero Mecánico Electricista", "IME"]

def get_string():
    return u"".join(random.choice(string.ascii_letters) for i in range(8))

def get_credito():
    return random.randint(1, 4)

def get_semestre():
    return random.randint(1,9)

def get_carrera():
    siglas = ["ITS", "IAS", "IEC", "IMA", "IME"]
    return random.choice(siglas)

def get_email():
    dominios = ['gmail.com', 'hotmail.com', 'yahoo.com']
    return u"".join(random.choice(string.ascii_letters) for i in range(8)) + '@' + random.choice(dominios)

def get_array(arreglo, campo):
    aux = []
    for i in arreglo:
        aux.append( i[campo].decode('latin1'))
        #aux.append( unicode( i[campo], 'latin1' ) )
        #y = unicode(i[campo], 'latin1')
    return aux


try:
    # host, database user name, user's account password, db name
    con = mdb.connect(host='localhost', user='root', passwd='root', db='registro_escolar')

    #you must create a Cursor object. It will let you execute all the query youneed
    cursor = con.cursor()

    #execute the SQL statement
    #carreras
    
    cursor.execute('CREATE TABLE IF NOT EXISTS carreras (id INT NOT NULL AUTO_INCREMENT, carrera VARCHAR(80) NOT NULL, siglas CHAR(6) NOT NULL, PRIMARY KEY(id) ) ENGINE=InnoDB DEFAULT CHARSET=latin1')
    
    for i in range( 0, len(carreras), 2 ):
        query = "SELECT carrera FROM carreras WHERE carrera = '%s'" % (carreras[i])
        cursor.execute(query)
        if (cursor.rowcount  == 0):
            query = "INSERT INTO carreras(carrera, siglas) VALUES('%s', '%s')" % (carreras[i],  carreras[i+1])
            print query
            cursor.execute(query)
    con.commit()
    cursor.close()

    cursor = con.cursor()
    #materias
    cursor.execute('CREATE TABLE IF NOT EXISTS materias (id INT NOT NULL AUTO_INCREMENT, materia VARCHAR(80), semestre TINYINT, credito TINYINT, carrera INT NOT NULL, PRIMARY KEY(id), FOREIGN KEY (carrera) REFERENCES carreras(id) ) ENGINE=InnoDB DEFAULT CHARSET=latin1')

    for i in range(0, 100):
        materia = get_string()
        semestre = get_semestre()
        creditos = get_credito()
        carrera = get_carrera()
        query = "SELECT materia FROM materias WHERE materia = '%s' " % (materia)
        cursor.execute(query)
        if (cursor.rowcount == 0):
            #INSERT INTO materias(materia, semestre, credito, carrera) SELECT 'Matemáticas I', 1, 3, id FROM carreras WHERE siglas = "ITS" LIMIT 
            query = "INSERT INTO materias(materia, semestre, credito, carrera) SELECT '%s', '%d', '%d', id FROM carreras WHERE siglas = '%s' LIMIT 1" % (materia, semestre, creditos, carrera)
            print query
            cursor.execute(query)
    con.commit()

    cursor.close()
    cursor = con.cursor()

    
    cursor.execute("CREATE TABLE IF NOT EXISTS profesores (id INT NOT NULL AUTO_INCREMENT, nombre VARCHAR(30) NOT NULL, apellidos VARCHAR(30) NOT NULL, usuario VARCHAR(20) NOT NULL, contrasena VARCHAR(20) NOT NULL, email VARCHAR(30), PRIMARY KEY(id) ) ENGINE=InnoDB DEFAULT CHARSET=latin1")
    for i in range(1,100):
       nombre = get_string()
       apellidos = get_string() + ' ' + get_string()
       usuario = get_string()
       contra = get_string()
       mail = get_email()
       query = "SELECT nombre, usuario FROM profesores WHERE nombre = '%s' AND usuario = '%s' LIMIT 1" % (nombre, usuario)
       cursor.execute(query)
       if (cursor.rowcount == 0):
           query = "INSERT INTO profesores(nombre, apellidos, usuario, contrasena, email) VALUES('%s', '%s', '%s', '%s', '%s')" % (nombre, apellidos, usuario, contra, mail)   
           print query
           cursor.execute(query)
    con.commit()
    
    cursor.execute("CCREATE TABLE IF NOT EXISTS materias_profesores (materia INT NOT NULL, profesor INT NOT NULL, FOREIGN KEY (materia) REFERENCES materias(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (profesor) REFERENCES profesores(id) ON DELETE CASCADE ON UPDATE CASCADE ) ENGINE=InnoDB DEFAULT CHARSET=latin1")
    cursor.execute("SELECT * FROM profesores")
    data = cursor.fetchall()
    profes = get_array(data,1)
    cursor.execute("SELECT * FROM materias")
    data = cursor.fetchall()
    materias = get_array(data, 1)
    for i in range(1,100):
        profe = random.choice(profes)
        materia = random.choice(materias)
        query = "INSERT INTO materias_profesores(materia, profesor) SELECT id, (SELECT id FROM profesores WHERE nombre = '%s') FROM materias WHERE materia = '%s'" %(profe, materia)
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