<?php

return [

	// Kullanıcı tanımlamaları

	/* TürkiyeSMS tarafindan size verilen kullanıcı adı dır.*/
	'kullanici' => '0123456789',

	/* TürkiyeSMS tarafindan size verilen şifre dir. */
	'sifre' => 'şifreniz',

	/* Gönderen kısmında görünecek olan max.11 karakter olabilen numerik veya alfanumerik isimdir. ORIGINATOR alanı boş bırakılırsa sistemde kayıtlı olan varsayılan originator esas alınarak sms gönderimi yapılır. */
	'originator' => 'ORIGINATORUNUZ',

	/* Mesajların kişilere ulaşmasını istediğiniz tarihtir. yyyy-mm-dd hh:nn formatındadır.(ör:2012-03-20 13:00) Tarih yazılmazsa sistem saatine göre hemen gitmeye başlar. */
	'gonderimTarihi' => '',

	 /* Mesajların kişilere ulaşmasını istediğiniz tarihtir. yyyy-mm-dd hh:nn formatındadır.(ör:2012-03-20 13:00) Tarih yazılmazsa sistem saatine göre hemen gitmeye başlar. */
	'bitisTarihi' => '',

	/* Mobil Telefon numarası yazılır. 5xxxxxxxxx formatında olmalıdır.Numaralar birbirinden virgül (,) ile ayrılır. */
	'gsm' => '',

	/* Max. 160 karakterli Türkçe karakter içermeyen mesaj metni yazılır. Türkçe karakter kullanılır ise sistem karakterleri İngilizce karakterler ile düzelterek gönderir. Mesaj metni boş olmamalıdır. Örnek: Test Mesaji1|Test Mesaji2 */
	'mesaj' => '',

	/* Gönderilen mesajın tipini belirler. 1 değerini alırsa mesaj telefonun mesaj kutusuna düşer, 2 değerini alırsa mesaj telefonun ekranına bilgi mesajı olarak görüntülenir. 1: Normal SMS, 2: Flash SMS */
	'mesajTipi' => 1

];