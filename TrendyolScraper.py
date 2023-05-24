from bs4 import BeautifulSoup
import requests

r = requests.get("https://www.trendyol.com/erkek-saat-x-g2-c34")
html_icerigi = r.content
soup = BeautifulSoup(html_icerigi, "html.parser")

isim = soup.find_all("span", attrs={"class": "prdct-desc-cntnr-name hasRatings"})
marka = soup.find_all("span", attrs={"class": "prdct-desc-cntnr-ttl"})
fiyat = soup.find_all("div", attrs={"class": "prc-box-dscntd"})
link = soup.find_all("div", attrs={"class": "p-card-chldrn-cntnr card-border"})

liste = []

for i in range(len(isim)):
    isim[i] = isim[i].text.strip("\n").strip()
    fiyat[i] = fiyat[i].text.strip("\n").strip()
    marka[i] = marka[i].text.strip("\n").strip()
    link[i] = "https://www.trendyol.com" + link[i].find("a", href=True)["href"]

    liste.append((isim[i], marka[i], fiyat[i], link[i]))

for urun in liste:
    print("Ürün Adı:", urun[1], urun[0])
    print("Fiyatı:", urun[2].split()[0])
    print("Ürün Linki:", urun[3])
    print("-" * 30)
