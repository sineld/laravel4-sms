<?php namespace Sineld\Sms;

use SimpleXMLElement as XML;

class Sms {

	protected $app;
	protected $config;
	protected $lang;
	protected $code;
	protected $success;

    public function __construct($app)
    {
		$this->app = $app;
		$locale = $this->app->getLocale();
		$this->lang = $this->app['translator']->get("sms::{$locale}.codes");
		$this->config = $this->app['config']->get("sms::config");
    }

	public function counter()
	{
		$url = 'http://gateway.turkiyesms.net/Gateways/Credit/';
		$xml = sprintf('<KREDISORGU>
							<KULLANICIADI>%s</KULLANICIADI>
							<SIFRE>%s</SIFRE>
						</KREDISORGU>',
						$this->config['kullanici'],
						$this->config['sifre']
				);

		$this->post($url, $xml);
		return $this->success == 1 ? $this->code : $this->lang[$this->code];
	}

	public function send($gsm, $mesaj, $gonderimTarihi = false, $bitisTarihi = false)
	{
		$url = 'http://gateway.turkiyesms.net/Gateways/Send/';
		$xml = sprintf('<TOPLUSMS>
							<KULLANICIADI>%s</KULLANICIADI>
							<SIFRE>%s</SIFRE>
							<ORIGINATOR>%s</ORIGINATOR>
							<GONDERIMTARIHI>%s</GONDERIMTARIHI>
							<BITISTARIHI>%s</BITISTARIHI>
							<NUMARALAR>%s</NUMARALAR>
							<MESAJMETNI><![CDATA[%s]]></MESAJMETNI>
							<MESAJTIPI>%s</MESAJTIPI>
						</TOPLUSMS>',
						$this->config['kullanici'],
						$this->config['sifre'],
						$this->config['originator'],
						$gonderimTarihi,
						$bitisTarihi,
						$gsm,
						$mesaj,
						$this->config['mesajTipi']
				);

		$this->post($url, $xml);
		return $this->success == 1 ? true : $this->lang[$this->code];
	}

	private function post($url, $xml)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

		$result = curl_exec($curl);
		curl_close($curl);

		$xml = new XML($result);
		if($xml->Status == 'true')
		{
			$this->success = 1;
			$this->code = "$xml->Code";
		}
		else
		{
			$this->code = "$xml->Code";
		}
	}
}