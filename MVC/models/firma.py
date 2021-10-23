#
#   python_seguridad_firmas_digitales_md5_sha.py
#
#   GeneraciÃ³n de firmas digitales usando MD5 y SHA
#   marzo 2020 - Rogelio Ferreira Escutia
#

import hashlib
import random

caracteres = "abcdefghijklmnopqrstuvwxyz0123456789"

def generar_cadena():
    cadena = ""
    for ciclo in range(1,10):
        cadena = cadena + random.choice(caracteres)
    return cadena

cadena = generar_cadena()
firma_md5 = (hashlib.md5(cadena.encode())).hexdigest()
firma_sha1 = (hashlib.sha1(cadena.encode())).hexdigest()
firma_sha224 = (hashlib.sha224(cadena.encode())).hexdigest()
firma_sha256 = (hashlib.sha256(cadena.encode())).hexdigest()
firma_sha384 = (hashlib.sha384(cadena.encode())).hexdigest()
firma_sha512 = (hashlib.sha512(cadena.encode())).hexdigest()

print("\nGeneraciÃ³n de Firmas Digitales")
print("\nMD5: " + firma_md5)
print("SHA1: " + firma_sha1)
print("SHA224: " + firma_sha224)
print("SHA256: " + firma_sha256)
print("SHA384: " + firma_sha384)
print("SHA512: " + firma_sha512)