<?php

require_once '../../models/ad.php';

class AdController
{
    // metodo que crea un banner de forma para Ads
    public function bannerAds(string $title, string $description, string $buttonTitle, string $buttonUrl, string $imgUrl)
    {
        require('../components/bannerAds.php');
    }

    public function getFirstAd()
    {
        $ad = new Ad();
        $response = $ad->getFirstAd();
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            // Paso los valores de objt a la clase user.
            $ad->construct($response);
            return $ad;
        }
    }

    public function getLastAd()
    {
        $ad = new Ad();
        $response = $ad->getLastAd();
        if ($response != false) {
            $response = $response->fetch(PDO::FETCH_OBJ);
            // Paso los valores de objt a la clase user.
            $ad->construct($response);
            return $ad;
        }
    }

    public function getAds()
    {
        $ad = new Ad();
        $response = $ad->getAds();

        if ($response != false) {
            $ads = $response->fetchAll(PDO::FETCH_OBJ);
            // retorno una lista de obj
            return $ads;
        }
    }
}
