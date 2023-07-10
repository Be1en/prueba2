#Importando librerías
from flask import Flask,request,jsonify
from flask_cors import CORS,cross_origin

#configuración del proyecto
application = Flask(__name__)
cors = CORS(application)
application.config["CORS_HEADERS"] = "Content-Type" # realizar llamadas sin que la solicitud de datos sea rechazada por el servidor

#métodos de llamada
@application.route("/")
def indice_contenidos():
    return "hola mundo"
