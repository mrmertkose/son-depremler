# Son Depremler
Verilerin kaynağı afad.gov.tr olup, unofficial bir şekilde geliştirilmiştir.Ticari kullanımlarınız için lütfen deprem@afad.gov.tr iletişime geçiniz.

# Kurulum
```
composer require mrmertkose/son-depremler
```

# Hızlı Başlangıç
```
use Earthquakes\Earthquakes;

$data = new Earthquakes();

echo $data->getAll();
```

# Response
  - JSON
  

# API Endpoints
  - ?ml=1 (depremin büyüklük değeri için girilecek değer - default=0)
  - ?lastday=2 (kaç gün içerisindeki depremler getirilsin - default=1)

# API Endpoints Örnek
 - <a href="https://www.mertkose.net/api/son-depremler/" target="_blank">https://www.mertkose.net/api/son-depremler/</a>
 - <a href="https://www.mertkose.net/api/son-depremler/?ml=5" target="_blank">https://www.mertkose.net/api/son-depremler/?ml=5</a>
 - <a href="https://www.mertkose.net/api/son-depremler/?lastday=30" target="_blank">https://www.mertkose.net/api/son-depremler/?lastday=30</a>
 - <a href="https://www.mertkose.net/api/son-depremler/?ml=5&lastday=30" target="_blank">https://www.mertkose.net/api/son-depremler/?ml=5&lastday=30</a>
