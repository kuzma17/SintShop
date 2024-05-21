<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Good;
use DOMDocument;

class ErcPriceService
{
    protected $company = 'Sint-shop';

    protected $url = 'https://sint-shop.com';
    protected $path_photo = '/images/goods/';
    protected $xml_file = 'price_erc.xml';

    protected function getCategories()
    {
        return Category::active()
            ->sort()
            ->limit(7)
            ->get(['id', 'name_ua']);

    }

    protected function getGoods()
    {
        return Good::with('vendor', 'photos')
            ->active()
            ->erc()
            ->get();

    }

    public function createXml()
    {

        //create xml
        $xmlDoc = new DOMDocument('1.0', 'utf-8');

        //yml_catalog
        $yml_catalog = $xmlDoc->createElement('yml_catalog');
        $yml_catalog->setAttribute('date', date('Y-m-d H:i'));
        $xmlDoc->appendChild($yml_catalog);

        //shop
        $shop = $xmlDoc->createElement('shop');
        $yml_catalog->appendChild($shop);

        // name
        $name = $xmlDoc->createElement('mame', $this->company);
        $shop->appendChild($name);

        //Company
        $company = $xmlDoc->createElement('company', $this->company);
        $shop->appendChild($company);

        //url
        $url = $xmlDoc->createElement('url', $this->url);
        $shop->appendChild($url);

        // Currencies
        $currencies = $xmlDoc->createElement('currencies');

        $currency_uah = $xmlDoc->createElement('currency');
        $currency_uah->setAttribute('id', 'UAH');
        $currency_uah->setAttribute('rate', "1");
        $currencies->appendChild($currency_uah);

        $currency_usd = $xmlDoc->createElement('currency');
        $currency_usd->setAttribute('id', 'USD');
        $currency_usd->setAttribute('rate', "13");
        $currencies->appendChild($currency_usd);

        $currency_eur = $xmlDoc->createElement('currency');
        $currency_eur->setAttribute('id', 'EUR');
        $currency_eur->setAttribute('rate', "NBU");
        $currencies->appendChild($currency_eur);

        $shop->appendChild($currencies);

        // Categories
        $categories = $xmlDoc->createElement('categories');
        $items_category = $this->getCategories();

        foreach ($items_category as $item){
            $category = $xmlDoc->createElement('category');
            $category->setAttribute('id', $item->id);
            $category_text = $xmlDoc->createTextNode($item->name_ua);
            $category->appendChild($category_text);
            $categories->appendChild($category);
        }

        $shop->appendChild($categories);

        // Offers
        $offers = $xmlDoc->createElement('offers');

        $items_good = $this->getGoods();
        foreach ($items_good as $item){
            // offer
            $offer = $xmlDoc->createElement('offer');
            $offer->setAttribute('id', $item->id);
            $offer->setAttribute('available', 'true');

            // name
            $name_good = $xmlDoc->createElement('name');
            $name_good_text = $xmlDoc->createTextNode($item->name_ua);
            $name_good->appendChild($name_good_text);
            $offer->appendChild($name_good);

            // code
            $code = $xmlDoc->createElement('code');
            $code_text = $xmlDoc->createTextNode($item->code);
            $code->appendChild($code_text);
            $offer->appendChild($code);

            // url
            $url_good = $xmlDoc->createElement('url', route('good', [$item->slug, $item->id]));
            $offer->appendChild($url_good);

            // price
            $price = $xmlDoc->createElement('price', $item->price);
            $offer->appendChild($price);

            // currency
            $currency_id = $xmlDoc->createElement('currencyId', 'UAH');
            $offer->appendChild($currency_id);

            // category
            $category_good = $xmlDoc->createElement('categoryId', $item->category_id);
            $offer->appendChild($category_good);

            // photo
            if (count($item->photos) > 0){
                $picture = $xmlDoc->createElement('picture', $this->url.$this->path_photo.$item->first_photo->src);
                $offer->appendChild($picture);
            }

            // vendor
            $vendor = $xmlDoc->createElement('vendor');
            $vendor_text = $xmlDoc->createTextNode($item->vendor->title);
            $vendor->appendChild($vendor_text);
            $offer->appendChild($vendor);

            // description
            $description = $xmlDoc->createElement('description');
            $description_text = $xmlDoc->createTextNode(strip_tags($item->description_ua));
            $description->appendChild($description_text);
            $offer->appendChild($description);

            $offers->appendChild($offer);

        }

        $shop->appendChild($offers);

        // Сохраняем XML в файл
        $xmlDoc->formatOutput = true;
        $xmlDoc->save(public_path($this->xml_file));

    }


}