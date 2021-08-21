<?php

class UrlGenerator
{

    private pdo $database;

    public function __construct(pdo $database)
    {

        $this->database = $database;

    }

    private function generateUrlString($stringLength = 8): string {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $urlString = '';
        for ($i = 0; $i < $stringLength; $i++) {
            $urlString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $urlString;
    }

    private function checkKeyExists($code): bool {

        $stmt = $this->database->prepare("SELECT COUNT(*) FROM `shortlinks` WHERE `link_shortcode` = :code");
        $stmt->execute(['code' => $code]);

        return $stmt->fetchColumn() != 0;
    }

    public function addShortenUrl($origUrl, $shortUrl) {

        if(empty($shortUrl)) {
            $shortUrl = $this->generateUrlString();
        }

        $time = time();

        if(!$this->checkKeyExists($shortUrl)) {
            $stmt = $this->database->prepare("INSERT INTO `shortlinks` SET `link_redirect` = :origurl, `link_shortcode` = :shortcode, `link_created` = :curtime");
            if($stmt->execute(['origurl' => $origUrl, 'shortcode' => $shortUrl, 'curtime' => $time])) {
                return $shortUrl;
            }
        }

        return null;
    }

}