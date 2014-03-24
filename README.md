## Laravel 4 İçin Türkiye SMS API

Türkiye SMS firmasına ait sms gönderimi API kodlarına özel hazırlanmış Laravel Paketidir. Farklı sms firmalarına kolaylıkla uyarlayabilmeniz amacıyla dil dosyaları ve konfigürasyon sayfaları birbirinden ayrılmıştır.

## Projeye Destek Olmak
Çalışmalarıma destek olmak isterseniz, [PayPal][paypal-donate-url] aracılığı ile bağışta bulunabilirsiniz.

[![PayPal ile Destek Ol][paypal-donate-img]][paypal-donate-url]

----------
## Kurulum
Bu paketi uygulamanıza eklemek için sırası ile şu adımları izlemelisiniz:

Şu satırı `composer.json` dosyanıza ekleyiniz:

```json
"sineld/sms" : "master"
```

Ardından, eğer ilk defa bir paket yükleyecekseniz `composer install`, daha önce paket yüklediyseniz `composer update` komutunu çalıştırın.

Aşağıdaki satırı `app/config/app.php` dosyası içerisindeki `providers` dizisine ilave edin.

```php
'Sineld\Sms\SmsServiceProvider',
```

Bu satırı `app/config/app.php` dosyası içerisindeki `aliases` dizisine ilave edin.

```php
'SMS' => 'Sineld\Sms\Facades\Sms',
```

Aşağıdaki komutu çalıştırarak, paketin ayar dosyasının `app/config/packages/sineld/sms/config.php` içerisine yerleştirilmesini sağlayın. Bu dosya içerisindeki ayarları Türkiye SMS firmasının size verdiği bilgilerle doldurun.

```shell
php artisan config:publish sineld/sms
```

Kurulum tamamlandı!

## Kullanım

```php
// Kontör Sorgulama
$kontor = SMS::kontor();
echo sprintf('Sistemde kullanılabilir %s kontörünüz bulunmaktadır.', $kontor);
```

```php
// Tek SMS gönderimi
$sonuc = SMS::send('5321234567', 'SMS Metni');
if($sonuc === true)
{
	echo 'Mesajınız başarıyla gönderildi!';
}
else
{
	echo 'SMS gönderilirken hata oluştu: '. $sonuc;
}
```

```php
// Çoklu SMS gönderimi
$sonuc = SMS::send('5321234567,5331234567', '1. Alıcı SMS Metni|2. Alıcı SMS Metni');
if($sonuc === true)
{
	echo 'Mesajınız başarıyla gönderildi!';
}
else
{
	echo 'SMS gönderilirken hata oluştu: '. $sonuc;
}
```

## License
This project is open-sourced software licensed under the [MIT license][mit-url].

[paypal-donate-img]: http://img.shields.io/badge/PayPal-donate-brightgreen.svg
[paypal-donate-url]: http://bit.ly/donateSineld

[mit-url]: http://opensource.org/licenses/MIT