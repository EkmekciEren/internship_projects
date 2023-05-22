from scapy.all import *
from contextlib import redirect_stdout

kacTane = 3

def paket_isle(paket):
    with open("dosya.txt", "a") as dosya:
        if IP in paket:
            ip_adresi = paket[IP].src
            dosya.write("Kaynak IP adresi: " + ip_adresi + "\n")
        if Ether in paket:
            mac_adresi = paket[Ether].src
            dosya.write("Kaynak MAC adresi: " + mac_adresi + "\n")
        
        dosya.write("Paket içeriği:\n")
        with redirect_stdout(dosya):
            paket.show()
        
        dosya.write("=" * 25 + "\n")

def ana():
    sniff(prn=paket_isle, count=kacTane)

ana()
