<?php


namespace Earthquakes;

use Curl\Curl;


class Earthquakes
{
    const UTC = 0;
    private $ml = 0;
    private $lastDay = 1;
    private $baseUrl = "https://deprem.afad.gov.tr/latestCatalogsList";
    private $curl;

    public function __construct()
    {
        // Get ile gelen query varsa, methodu çağırıp query parçalamalarını yapıyoruz.
        // Get ile gelen query yoksa, $ml ve $lastDay değerleri default olarak devam ediyor.
        $this->urlParser();


        // Yeni curl isteği başlatıp query'leri post olarak yolluyoruz.
        // Dönen değeri alıp diğer methoda taşımak için sınıf içerisindeki değişkene tanımlıyoruz($this->curl)
        $this->curl = new Curl();
        $this->curl->post($this->baseUrl, array(
            "m" => $this->ml,
            "utc" => self::UTC,
            "lastDay" => $this->lastDay,
        ));

    }

    public function getAll()
    {
        header('Content-type: application/json');

        // Dönen değerimizde hata varsa ya da yoksa if ile yakalayıp "data"
        // değişkenine eşleyip return ediyoruz
        if ($this->curl->error) {
            $data = [
                "status" => 410,
                "error_message" => $this->curl->errorMessage,
                "data" => []
            ];

        } else {
            $data = [
                "status" => 200,
                "data" => $this->curl->getResponse()
            ];
        }
        return json_encode($data);
    }

    private function urlParser()
    {
        if ($_GET) {
            if (@$_GET["ml"]) {
                $this->ml = $_GET["ml"];
            }
            if (@$_GET["lastday"]) {
                $this->lastDay = $_GET["lastday"];
            }
        }
    }

}