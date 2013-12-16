#!/usr/bin/python
#-*- coding: utf-8 -*-
import MySQLdb as mdb
import sys
import random
import string

''' tabla
CREATE DATABASE registro_escolar CHARACTER SET utf8 COLLATE utf8_general_ci;'''

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

def get_horas():
    siglas = ['M1', 'M2', 'M3', 'M4', 'M5', 'M6', 'V1', 'V2', 'V3', 'V4', 'V5', 'V6', 'N1', 'N2', 'N3', 'N4', 'N5', 'N6' ]
    horas = ['7,00,00', '7,50,00', '8,40,00', '9,30,00', '10,20,00', '11,10,00', '12,00,00', '12,50,00', '13,40,00', '14,30,00', '15,20,00', '16,10,00', '17,00,00', '17,40,00', '18,20,00', '19,00,00', '19,40,00', '20,20,00', '21,00,00']
    return siglas, horas

def get_array(arreglo, campo):
    aux = []
    for i in arreglo:
        aux.append( i[campo].decode('latin1'))
        #aux.append( unicode( i[campo], 'latin1' ) )
        #y = unicode(i[campo], 'latin1')
    return aux


def tabla_carreras():
    cursor.execute('CREATE TABLE IF NOT EXISTS carreras (id INT NOT NULL AUTO_INCREMENT, carrera VARCHAR(80) NOT NULL, siglas CHAR(6) NOT NULL, PRIMARY KEY(id) ) ENGINE=InnoDB DEFAULT CHARSET=latin1')
    
    for i in range( 0, len(carreras), 2 ):
        query = "SELECT carrera FROM carreras WHERE carrera = '%s'" % (carreras[i])
        cursor.execute(query)
        if (cursor.rowcount  == 0):
            query = "INSERT INTO carreras(carrera, siglas) VALUES('%s', '%s')" % (carreras[i],  carreras[i+1])
            print query
            cursor.execute(query)
    con.commit()

def tabla_materias():
    cursor.execute('CREATE TABLE IF NOT EXISTS materias (id INT NOT NULL AUTO_INCREMENT, materia VARCHAR(80), semestre TINYINT, credito TINYINT, carrera INT NOT NULL, PRIMARY KEY(id), FOREIGN KEY (carrera) REFERENCES carreras(id) ) ENGINE=InnoDB DEFAULT CHARSET=latin1')
    
    for i in range(1, 3):
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

def tabla_profesores():
    cursor.execute("CREATE TABLE IF NOT EXISTS profesores (id INT NOT NULL AUTO_INCREMENT, nombre VARCHAR(30) NOT NULL, apellidos VARCHAR(30) NOT NULL, usuario VARCHAR(20) NOT NULL, contrasena VARCHAR(20) NOT NULL, email VARCHAR(30), PRIMARY KEY(id) ) ENGINE=InnoDB DEFAULT CHARSET=latin1")
    '''for i in range(1,3):
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
           cursor.execute(query)'''
    con.commit()

def tabla_alumnos():
    cursor.execute("CREATE TABLE IF NOT EXISTS alumnos( id INT NOT NULL AUTO_INCREMENT, nombre VARCHAR(30) NOT NULL, apellidos VARCHAR(30) NOT NULL, usuario INT NOT NULL, contrasena VARCHAR(20) NOT NULL, email VARCHAR(30), semestre TINYINT,PRIMARY KEY(id), carrera INT, FOREIGN KEY (carrera) REFERENCES carreras(id) ON DELETE CASCADE ON UPDATE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=latin1")
    cursor.execute("SELECT * FROM carreras")
    '''data = cursor.fetchall()
    carreras = get_array(data, 1)
    #for i in range(1,3):
    nombre = get_string()
    apellidos = get_string() + ' ' + get_string()
    usuario = 1440000
    contra = get_string()
    mail = get_email()
    carrera = random.choice(carreras)
    semestre = get_semestre()

    query = "SELECT nombre, usuario FROM alumnos WHERE nombre = '%s' AND usuario = '%s' LIMIT 1" % (nombre, usuario)
    cursor.execute(query)
        
    if (cursor.rowcount == 0):
        query = "INSERT INTO alumnos(nombre, apellidos, usuario, contrasena, email, semestre) VALUES('%s', '%s', '%s', '%s', '%s', '%s')" % (nombre, apellidos, usuario, contra, mail, semestre)
        print query
        cursor.execute(query)
        query = "UPDATE alumnos SET carrera = (SELECT id FROM carreras WHERE carrera ='%s') WHERE nombre = '%s' " %(carrera, nombre)
        print query
        cursor.execute(query)'''
    con.commit()

def tabla_horas():
    cursor.execute("CREATE TABLE IF NOT EXISTS horas (id INT NOT NULL AUTO_INCREMENT, siglas CHAR(3) NOT NULL, inicio TIME NOT NULL, fin TIME NOT NULL,  PRIMARY KEY(id) )ENGINE=InnoDB DEFAULT CHARSET=latin1")
    siglas, horas = get_horas()

    for i in range( len(siglas) ):
        query = "INSERT INTO horas(siglas, inicio, fin) VALUES ('%s', MAKETIME(%s), MAKETIME(%s) ) " % (siglas[i], horas[i], horas[i+1])
        cursor.execute(query)
    con.commit()

def tabla_salones():
    cursor.execute('CREATE TABLE IF NOT EXISTS salones (id INT NOT NULL AUTO_INCREMENT, salon CHAR(6) NOT NULL, PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=latin1')

    i = 1101;
    n = 0
    while True:
        for y in range(i,i+9):
            query = "INSERT INTO salones(salon) VALUES('%s')" % (y)
            cursor.execute(query)
            print y
        con.commit()
        i += 100
        n += 1
        #if (n == 4):
            #i +=600
            #n += 1
        
        if (i==1201):
            con.commit()
            break

def tabla_materias_profesores():
    cursor.execute("CREATE TABLE IF NOT EXISTS materias_profesores (materia INT NOT NULL, profesor INT NOT NULL, FOREIGN KEY (materia) REFERENCES materias(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (profesor) REFERENCES profesores(id) ON DELETE CASCADE ON UPDATE CASCADE ) ENGINE=InnoDB DEFAULT CHARSET=latin1")
    cursor.execute("SELECT * FROM profesores")
    data = cursor.fetchall()
    profes = get_array(data,1)
    cursor.execute("SELECT * FROM materias")
    data = cursor.fetchall()
    materias = get_array(data, 1)
    for i in range(1,3):
        profe = random.choice(profes)
        materia = random.choice(materias)
        query = "INSERT INTO materias_profesores(materia, profesor) SELECT id, (SELECT id FROM profesores WHERE nombre = '%s') FROM materias WHERE materia = '%s'" %(profe, materia)
        print query
        cursor.execute(query)
    con.commit()

def tabla_carreras_materias():
    cursor.execute("CREATE TABLE IF NOT EXISTS carreras_materias (materia INT NOT NULL, carrera INT NOT NULL, FOREIGN KEY (materia) REFERENCES materias(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY ( carrera) REFERENCES carreras(id) ) ENGINE=InnoDB DEFAULT CHARSET=latin1")
    cursor.execute("SELECT * FROM materias")
    data = cursor.fetchall()
    materias = get_array(data, 1)
    cursor.execute("SELECT * FROM carreras")
    data = cursor.fetchall()
    carreras = get_array(data, 1)
    for i in range(1,3):
        materia = random.choice(materias)
        carrera = random.choice(carreras)
        query = "INSERT INTO carreras_materias(materia, carrera) SELECT id, (SELECT id FROM carreras WHERE carrera = '%s') FROM materias WHERE materia = '%s'" %(carrera, materia)
        print query
        cursor.execute(query)
    con.commit()

try:
    # host, database user name, user's account password, db name
    con = mdb.connect(host='localhost', user='root', passwd='root', db='registro_escolar')

    #you must create a Cursor object. It will let you execute all the query youneed
    cursor = con.cursor()

    #execute the SQL statement
    tabla_carreras()
    tabla_materias()
    #tabla_profesores()
    #tabla_alumnos()
    tabla_horas()
    tabla_salones()
    #tabla_materias_profesores()
    #tabla_carreras_materias()

    #cursor.execute('CREATE TABLE IF NOT EXISTS inscripciones(id INT NOT NULL AUTO_INCREMENT, carrera INT NOT NULL, materia INT NOT NULL, profesor INT NOT NULL, hora INT NOT NULL, salon INT NOT NULL, PRIMARY KEY (id), FOREIGN KEY (carrera) REFERENCES carreras(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (materia) REFERENCES materias(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (profesor) REFERENCES profesores(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (hora) REFERENCES horas(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (salon) REFERENCES salones(id) ON DELETE CASCADE ON UPDATE CASCADE)')


except mdb.Error, e:
    print "Error %d: %s" % (e.args[0],e.args[1])
    sys.exit(1)

#release resources. 
finally:
    if con:
        con.close()