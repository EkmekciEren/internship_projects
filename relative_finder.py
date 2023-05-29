def onuncu_basamak(tc):
    tc_digits = [int(digit) for digit in str(tc)[:-2]] #tc'nin son 2 bas hariç diğerlerini al
    cift_sayilar = sum(tc_digits[::2]) #burada çift sayılar tc'nin 1 3 5 7 ve 9. değerlerini alır ve toplar
    tek_sayilar = sum(tc_digits[1::2]) #burada tek sayılar tc'nin 2 4 6 ve 8. değerlerini alır ve toplar

    onuncu_basamak = (7 * cift_sayilar - tek_sayilar) % 10 #burada yapılan islem sayesinde 10. basamagı buluruz
    return onuncu_basamak   

def akrabalar(tc, kactane):
    tc_list = []
    ilk5 = int(str(tc)[:5])
    sonraki4 = int(str(tc)[5:9])
    
    while len(tc_list) < kactane: #kullanıcı kaç tane akrabasını bulmasını istiyorsa o kadar kod çalışır ve döngünün içerisindeki işlemler sayesinde tahmini tc'ler bulunmuş olur. 
        ilk5 += 3
        sonraki4 -= 1
        if ilk5 > 99999: #yukarıdaki işlemlerden sonra değişkenler basamak sayılarını aşıyorsa onları düzenleriz
            ilk5 -= 100000
        if sonraki4 < 0:
            sonraki4 += 10000

        yeni_tc = f"{ilk5}{sonraki4}{onuncu_basamak(int(str(ilk5)) + int(str(sonraki4)))}"
        sonbas = sum(int(digit) for digit in str(yeni_tc)) % 10

        if sonbas % 2 == 0:  # Eğer son basamak çift sayı ise listeye ekle
            son_yeni_tc = f"{ilk5:05d}{sonraki4:04d}{onuncu_basamak(int(str(ilk5)) + int(str(sonraki4)))}{int(sonbas)}"
            tc_list.append(son_yeni_tc)
    
    return tc_list

tc = input("TC kimlik numaranızı giriniz: ")
kactane = int(input("Kaç akrabanın TC kimlik numarasını keşfetmek istiyorsun? "))

tc_numbers = akrabalar(int(tc), kactane)

for tc_number in tc_numbers:
    print(tc_number)
