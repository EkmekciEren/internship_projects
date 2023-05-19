from random import *
import multiprocessing
import datetime
import random
import time

random.seed(time.time()) #zamana göre rastgele sayı verilmesi

def ucgenmi(a, b, c): #ucgen kontrol
    return ((a + b) > c) and ((a + c) > b) and ((b + c) > a)

def rastgele(): #random sayı atanması
    nokta1 = randint(1, 98)
    nokta2 = randint(nokta1 + 1, 99)

    a = nokta1
    b = nokta2 - nokta1
    c = 100 - nokta2

    if a > 0 and b > 0 and c > 0:
        return a, b, c
    else:
        return rastgele() 
test = 0
def main(_): 
    ucgenoldu = 0
    for i in range(1, 10000000):
        a, b, c = rastgele()
        if ucgenmi(a, b, c):
            ucgenoldu += 1
            global test
            test += 1
    return ucgenoldu

if __name__ == '__main__':
    num_processors = multiprocessing.cpu_count()

    with multiprocessing.Pool(processes=num_processors) as pool:
        start_time = datetime.datetime.now()
        ucgenoldu = sum(pool.map(main, range(1)))
        end_time = datetime.datetime.now()
        diff = end_time - start_time
        time_in_seconds = diff.total_seconds()
        zaman = float(time_in_seconds)

    print(f"10.000.000 denemede {ucgenoldu} sayıda üçgen %{ucgenoldu*100/10000000:.2f} başarı oranı ile {zaman:.3f} saniyede oluşturuldu")
