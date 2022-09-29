<?php

namespace Earthquakes;

use GuzzleHttp\Client;


class Earthquakes
{
    private $baseUrl = "https://deprem.afad.gov.tr/EventData/GetEventsByFilter";
    private $ml = 0;
    private $lastDay = 1;
    private $response;
    private $error = [];
    private $localZone = "Europe/Istanbul";
    private $dateFormatUrl = "Y-m-d\TH:i:s.000\Z";
    private $dateFormatData = "Y-m-d\TH:i:s";
    private $dateFormat;


    public function __construct()
    {
        $this->dateFormat = new \DateTime($this->localZone);
        $client = new Client();

        try {
            $this->urlParser();

            $nowDate = $this->dateFormat->format($this->dateFormatUrl);

            $this->response = $client->post($this->baseUrl, [
                "json" => [
                    "EventSearchFilterList" => [
                        ["FilterType" => 9, "Value" => $nowDate],
                        ["FilterType" => 8, "Value" => $this->lastDate("30", $nowDate, $this->dateFormatUrl)],
                    ],
                    "Skip" => 0,
                    "SortDescriptor" => [
                        "dir" => "desc",
                        "field" => "eaeventId"
                    ],
                    "Take" => rand(9000, 10000)
                ]
            ]);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            $this->error = [$e->getResponse()->getBody()->getContents()];
        }
    }

    public function getAll()
    {
        header('Content-type: application/json');

        if ($this->error) {
            return json_encode([
                "status" => 410,
                "error_message" => $this->error,
                "data" => []
            ]);
        }

        $returnData = [];
        foreach (json_decode($this->response->getBody()->getContents())->eventList as $item) {
            $nowDate = $this->dateFormat->format($this->dateFormatData);
            if ($item->magnitude > $this->ml && $item->eventDate > $this->lastDate($this->lastDay, $nowDate, $this->dateFormatData))
            {
                $returnData[] = $item;
            }
        }

        return json_encode([
            "status" => 200,
            "data" => $returnData
        ]);
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

    private function lastDate($day, $nowDate, $dateFormat)
    {
        return date($dateFormat, strtotime('-' . $day . ' day', strtotime($nowDate)));
    }

}