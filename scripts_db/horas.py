#!/usr/bin/python
# -*- coding: latin-1 -*-

import MySQLdb as mdb
import sys

horas = ['M1', '7:00-7:50', 
         'M2', '7:50-8:40',
         'M3', '8:40-9:30',
         'M4', '9:30-10:20',
         'M5', '10:20-11:10',
         'M6', '11:10-12:00',
         'V1', '12:00-12:50',
         'V2', '12:50-1:40',
         'V3', '1:40-2:30',
         'V4', '2:30-3:20',
         'V5', '3:20-4:10',
         'V6', '4:10-5:00',
         'N1', '5:00-5:40',
         'N2', '5:40-6:20',
         'N3', '6:20-7:00',
         'N4', '7:00-7:40',
         'N5', '7:40-8:20',
         'N6', '8:20-9:00']

#nombre, prerequisito1, prerequisito2, prerequisito3, semestre, creditos, carrera
materias = ['F�sica I','NULL','NULL','NULL','1','3', 1,
            'Laboratorio de F�sica I','NULL','NULL','NULL','1','1',1,
            '�lgebra para Ingenier�a','NULL','NULL','NULL','1','3',1,
            'Matem�ticas I','NULL','NULL','NULL','1','3',1,
            'Dibujo para Ingenier�a','NULL','NULL','NULL','1','4',1,
            'Qu�mica General','NULL','NULL','NULL','1','3',1,
            'Laboratorio de Qu�mica General','NULL','NULL','NULL','1','1',1,
            'Aplicaci�n de las Tecnolog�as de Informaci�n','NULL','NULL','NULL','1','2',1,
            'Competencia Comunicativa','NULL','NULL','NULL','1','2',1,
            'F�sica II','F�sica I','Laboratorio de F�sica I','�lgebra para Ingenier�a','2','4',1,
            'Matem�ticas II','Matem�ticas I','NULL','NULL','2','3',1,
            'Taller de Programaci�n','Matem�ticas I','NULL','NULL','2','3',1,
            'Matem�ticas Discretas','Matem�ticas I','NULL','NULL','3','3',1,
            'Matem�ticas III','Matem�ticas II','NULL','NULL','3','3',1,
            ]

try:
    con = mdb.connect(host='localhost', user='root', passwd='root', db='registro_escolar')
    cursor = con.cursor()

    #tabla horas
    cursor.execute('CREATE TABLE IF NOT EXISTS horas(hora CHAR(3) NOT NULL, duracion VARCHAR(11) NOT NULL, PRIMARY KEY(hora)) ENGINE=InnoDB DEFAULT CHARSET=latin1')

    #tabla materias
    cursor.execute('CERATE TABLE IF NOT EXISTS materias(materia INT NOT NULL, nombre VARCHAR() NOT NULL, prerrequisito_1 VARCHAR(), prerrequisito_2 VARCHAR(), prerrequisito_3 VARCHAR(), semestre CHAR(), creditos TINYINT NOT NULL, carrera INT NOT NULL, PRIMARY KEY(materia) )ENGINE=InnoDB DEFAULT CHARSET=latin1')

    for i in range( 0, len(horas), 2 ):
        query = "INSERT INTO horas(hora, duracion) VALUES('%s', '%s')" % (horas[i], horas[i+1])
        print query
        cursor.execute(query)
    con.commit()
        
    for i in range(0, len(materias), 7):
        query = ""
        print query
        cursor.execute(query)
    con.commit()

except mdb.Error, e:
    print "Error %d: %s" % (e.args[0], e.args[1])
    sys.exit(1)

finally:
    if con:
        con.close()
