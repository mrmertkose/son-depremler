# Son Depremler
Verilerin kaynağı afad.gov.tr olup, unofficial bir şekilde geliştirilmiştir.Ticari kullanımlarınız için lütfen deprem@afad.gov.tr iletişime geçiniz.

# Kurulum
```
composer require mertkose/son-depremler 
```

# Hızlı Başlangıç
```
use Earthquakes\Earthquakes;

$data = new Earthquakes();

echo $data->getAll();
```

# Response
```
  - JSON
```
  

# API Endpoints
```
  - ?ml=1 (depremin büyüklük değeri için girilecek değer - default=0)
  - ?lastday=2 (kaç gün içerisindeki depremler getirilsin - default=1)
```

# API Endpoints Örnek
```
  - https://www.mertkose.net/api/son-depremler/
  - https://www.mertkose.net/api/son-depremler/?ml=5
  - https://www.mertkose.net/api/son-depremler/?lastday=30
  - https://www.mertkose.net/api/son-depremler/?ml=5&lastday=30
  - [https://www.mertkose.net/api/son-depremler/](https://www.mertkose.net/api/son-depremler/)
  [I'm an inline-style link](https://www.mertkose.net/api/son-depremler)
```
