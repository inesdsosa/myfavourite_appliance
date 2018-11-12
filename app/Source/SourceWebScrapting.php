<?php
/**
 * Created by PhpStorm.
 * User: ines
 * Date: 5/11/18
 * Time: 15:48
 */

namespace myFavouriteAppliance\Source;
use myFavouriteAppliance\Appliance;
use myFavouriteAppliance\SourceUrl;


use Goutte\Client;


class SourceWebScrapting  implements SourceInterface
{
    const PRODUCT_DELIMITER = '.product-description';
    const PAGINATION_DELIMITER = '.result-list-pagination';
    const TITLE_DELIMITER  = 'h4 > a';
    const PRECIO_DELIMITER = 'h3';

    protected $sourceUrl;

    /**
     *  Get products from url page per page, doing web scraping
     *
     * @param  SourceUrl $sourceUrl     *
     */
    public function load(SourceUrl $sourceUrl) : void
    {
        $this->sourceUrl = $sourceUrl;
        $url = $sourceUrl->url;

        $client = new Client();
        $client->setHeader('User-Agent', "myFavouriteAppliance");

        $crawler = $client->request('GET', $url);
        $pages = $this->getPages($crawler);

        //start with page 2 because we just did request page 1
        for ($i = 2; $i < $pages + 1; $i++) {
            $this->loadProducts($crawler);
            $crawler = $client->request('GET', $url.'?page=' . $i);
        }

    }

    /**
     *  get page number of products pagination
     *
     * @param  Goutte\Client $crawler  *
     */
    protected function getPages($crawler){
        $pagination = $crawler->filter(self::PAGINATION_DELIMITER)->first();
        return $pagination->filter('a')->first()->text();
    }

    /**
     *  load product into BD
     *
     * @param  Goutte\Client $crawler  *
     */
    protected function loadProducts($crawler){
            $crawler->filter(self::PRODUCT_DELIMITER)->each(function ($nodeProduct) {
            $text = $nodeProduct->filter(self::TITLE_DELIMITER)->first()->text();
            $price = $this->getPrice($nodeProduct->filter(self::PRECIO_DELIMITER)->first()->text());
            $reference = $this->getReference(trim($text));
            $appliance = array('title' => $text, 'price'=>$price, 'reference'=>$reference, 'source_url_id' => $this->sourceUrl->id );
            $appliance = Appliance::updateOrCreate(
                    ['reference' => $reference],
                $appliance
            );
        });
    }

    /**
     *  extract code reference from title
     *
     * @param String $text *
     */
    protected function getReference(String $text){
        $split = explode(" ", $text);
        return $split[count($split)-1];
    }

    /**
     *  get decimal price
     *
     * @param  String $price  *
     */
    protected function getPrice(String $price){
        $price = str_replace('€', '', $price);
        $price = str_replace(',', '', $price);
        $price = trim($price);
        return $price;
    }

}
