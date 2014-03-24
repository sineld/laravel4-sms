<?php namespace Sineld\Sms;

use Config;
use Lang;
use SimpleXMLElement as XML;

class Sms {

	private $kod;
	private $sonuc;

    public function __construct()
    {
		$locale = Config::get('app.locale');
		$this->lang = Lang::get("sms::{$locale}.kodlar");
    	$config = Config::get('sms::config');

    	foreach($config as $key => $value)
    	{
			$this->$key = $value;
    	}
    }

	public function kontor()
	{
		$url = 'http://gateway.turkiyesms.net/Gateways/Credit/';
		$xml ="<KREDISORGU>
			<KULLANICIADI>{$this->kullanici}</KULLANICIADI>
			<SIFRE>{$this->sifre}</SIFRE>
		</KREDISORGU>";

		$result = $this->post($url, $xml);
		$this->process($result);
		return $this->sonuc == 1 ? $this->kod : $this->lang[$this->kod];
	}

	public function send($gsm, $mesaj, $gonderimTarihi = false, $bitisTarihi = false)
	{
		$url = 'http://gateway.turkiyesms.net/Gateways/Send/';
		$xml ="<TOPLUSMS>
			<KULLANICIADI>{$this->kullanici}</KULLANICIADI>
			<SIFRE>{$this->sifre}</SIFRE>
			<ORIGINATOR>{$this->originator}</ORIGINATOR>
			<GONDERIMTARIHI>{$this->gonderimTarihi}</GONDERIMTARIHI>
			<BITISTARIHI>{$this->bitisTarihi}</BITISTARIHI>
			<NUMARALAR>{$gsm}</NUMARALAR>
			<MESAJMETNI><![CDATA[{$mesaj}]]></MESAJMETNI>
			<MESAJTIPI>{$this->mesajTipi}</MESAJTIPI>
		</TOPLUSMS>";

		$result = $this->post($url, $xml);
		$this->process($result);
		return $this->sonuc == 1 ? true : $this->lang[$this->kod];
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

		return $result;
	}

	private function process($result)
	{
		$xml = new XML($result);

		if($xml->Status == 'true')
		{
			$this->sonuc = 1;
			$this->kod = "$xml->Code";
		}
		else
		{
			$this->sonuc = 0;
			$this->kod = "$xml->Code";
		}
	}
}