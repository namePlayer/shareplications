<?php

class UrlGenerator
{

    private pdo $database;

    public function __construct(pdo $database)
    {

        $this->database = $database;

    }

    private function generateRandomUrlString(int $stringLength = 8): string|null {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $urlString = '';
        for ($i = 0; $i < $stringLength; $i++) {
            $urlString .= $characters[rand(0, $charactersLength - 1)];
        }

        if($this->checkKeyExists($urlString) === true && $stringLength != 12) {
            $this->generateRandomUrlString($stringLength + 1);
        }

        return $urlString;
    }

    private function checkKeyExists(string $code): bool {

        $stmt = $this->database->prepare("SELECT COUNT(*) FROM `shortlinks` WHERE `link_shortcode` = :code");
        $stmt->execute(['code' => $code]);

        return $stmt->fetchColumn() != 0;
    }

    public function addShortenUrl(string $origUrl, string $enableTelemetry, ?int $maxLinkUse, string $accessToken,string $shortUrl): string|null {

        if(empty($shortUrl)) {
            $shortUrl = $this->generateRandomUrlString();
        }

        $time = time();

        if(!$this->checkKeyExists($shortUrl)) {

            $stmt = $this->database->prepare("INSERT INTO `shortlinks` SET `link_redirect` = :origurl, `link_shortcode` = :shortcode, `link_created` = :curtime, `link_telemetry` = :enableTelemetry, `link_maxuse` = :maxuse, `link_password` = :accesstoken");
            if($stmt->execute(['origurl' => $origUrl, 'shortcode' => $shortUrl, 'curtime' => $time, 'enableTelemetry' => $enableTelemetry, 'maxuse' => $maxLinkUse, 'accesstoken' => $accessToken])) {
                return $shortUrl;
            }
        }

        return null;
    }

}