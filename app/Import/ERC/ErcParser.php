<?php

namespace App\Import\ERC;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Good;
use App\Models\ValueAttribute;
use App\Models\Vendor;
use App\Services\ImageService;

class ErcParser
{
    protected $category;
    protected $ercStore;
    protected $ercProducts;
    protected $imageService;
    protected $exception_attr = [379, 5445, 7974, 5117, 14993, 14994, 17967, 17968, 17969, 18080];
    protected $exception_item = ['097S05201'];

    protected $values = [];

    function __construct(ErcStore $ercStore, ErcProducts $ercProducts, ImageService $imageService){
        $this->ercStore = $ercStore;
        $this->ercProducts = $ercProducts;
        $this->imageService = $imageService;
        $this->imageService->path('/images/goods');
    }

    /**
     * $erc_categories Array
     * $category Object
     */
    public function parse(Category $category, $erc_categories){

        $this->category = $category->load('attribute');
        dump('category '.$category->id.' '.$category->title_ru);

        $data = $this->ercStore->getGoods($erc_categories, 'ru');
        $data_ua = $this->ercStore->getGoods($erc_categories);

        foreach (array_chunk($data, 10, true) as $chunk) {
            foreach ($chunk as $key => $item) {

                if (in_array($item->code, $this->exception_item)) { // Exeption item
                    continue;
                }

                $code = $this->getCode($item->code);

                $dataGoodSet = [
                    'quantity' => $this->getQuantity($item->whs),
                    'price' => $item->RRP_UAH,
                    //'action' => $item->isaction
                ];

                if ($good = Good::where('erc', 1)->where('code', $code)->first()){
                   $this->updateGood($good, $dataGoodSet);

                   dump('updated '.$good->id.' '.$good->title_ru);

                    continue;
                }

                $dataGoodSet = array_merge($dataGoodSet,[
                    'code' => $code,
                    'category_id' => $this->category->id,
                    'vendor_id' => $this->getVendor($item->vendor)->id,
                    'slug' => $this->getSlug($code),
                    'title_ru' => $this->getName($item),
                    'title_ua' => $this->getName($data_ua[$key]),
                    'active' => 1,
                    'erc' => 1
                ]);

                $product = $this->ercProducts->getGoodInfo($code, 'ru'); // API Product
                $product_ua = $this->ercProducts->getGoodInfo($code);
                if ($product && $product_ua){

                    $description = $this->getDescription($product);
                    $description_ua = $this->getDescription($product_ua);

                    $dataGoodSet = array_merge($dataGoodSet,[
                        'description_ru' => $description,
                        'description_ua' => $description_ua,
                            //'erc2' => 1
                        ]
                    );

                    if (isset($product->images)){
                        $photos = $this->getPhotos($product->images);
                    }

                    if (isset($product->videos)){
                        $videos = $this->getVideos($product->videos);
                    }

                    $this->groupsParse($product->groups, $product_ua->groups);
                }else{
                    if (isset($item->pic)){
                        $photos = $this->getStorePhotos($item->pic);
                    }
                    $videos = null;
                }

               $good = $this->createGood($dataGoodSet, $photos, $videos);

                dump('created '.$good->id.' '.$good->title_ru);
            }
        }
    }

    public function countNullGood(){
        Good::where('erc', 1)
            ->whereDate('updated_at', '<', date('Y-m-d'))
            ->update(['quantity' => 0]);
    }

    protected function createGood($goodData, $photos=null, $videos=null){
        $good = Good::create($goodData);

        if ($photos){
            $good->photos()->createMany($photos);
        }

        if ($videos){
            $good->videos()->createMany($videos);
        }

        if (count($this->values) > 0){
            $good->valueAttributes()->attach($this->values);
            $this->values = [];
        }

        return $good;
    }

    protected function updateGood(Good $good, $goodData){
        $good->update($goodData);
    }

    protected function getName($data){

        if ($this->category->id === 1 || $this->category->id === 2 || $this->category->id === 3){
            $name = explode(',', $data->gname)[0].' ('.$data->code.')';
        }else{
            $name = $data->gname;
        }
        if ($this->category->id === 6 || $this->category->id === 7){
            $name = explode('/', $name)[0];
        }
        if ($this->category->id === 1){
            $name = str_replace('ПК', 'Компьютер', $name);
            $name = str_replace('Комп’ютер персональний', 'Комп’ютер', $name);
            $name = str_replace("Персональний комп'ютер", 'Комп’ютер', $name);
        }

        $name = str_replace('\u{A0}', ' ', $name);

        return $this->clean($name);
    }

    protected function groupsParse($data, $data_ua){

        for($i=0; $i<count($data); $i++) {
            $items = $data[$i]->items;
            $items_ua = $data_ua[$i]->items;
            foreach ($items as $key => $item) {

                if (in_array($item->id, $this->exception_attr)) {
                    continue;
                }

                $attribute = $this->getAttribute($item, $items_ua[$key]);
                $this->getValues($item, $items_ua[$key], $attribute->id);
            }
        }
    }

    protected function getAttribute($data, $data_ua){
        return Attribute::firstOrCreate(
            ['erc' => $data->id],
            [
                'category_id' => $this->category->id,
                'name_ru' => $data->title,
                'name_ua' => $data_ua->title,
                'slug' => \URLify::slug($data->title),
                'type_id' => $this->getTypeAttribute($data),
                'filter' => $this->getFilterAttribute($data),
                'format' => $this->getFormat($data),
                'active' => 1
            ]
        );
    }

    protected function getFormat($data){

        if(isset($data->format)){
            $format = $data->format;
            if ($format === '%s %'){
                $format = "%s sRGB";
            }
            $format = str_replace('%s', '', $format);
            return trim($format);
        }
        return null;
    }

    protected function getTypeAttribute($data){
        $type = $data->type;
        switch ($type) {
            case 'TYPE_SET':
                return 1;
            case 'TYPE_STRING':
                return 2;
            case 'TYPE_FLOAT':
                return 3;
            case 'TYPE_BOOLEAN':
                return 4;
        }
    }

    protected function getFilterAttribute($data){
        if ($data->primary){
            return 1;
        }
        return 0;
    }

    protected function getValues($item, $item_ua, $attribute_id)
    {
        if ($item->type === 'TYPE_SET') {
            $erc_values = $item->values;
            $erc_values_ua = $item_ua->values;

            for ($i = 0; $i < count($erc_values); $i++) {
                $this->valueSet($erc_values[$i], $erc_values_ua[$i], $attribute_id);
            }
        }elseif ($item->type === 'TYPE_BOOLEAN'){
            $this->valueBoolean($item, $attribute_id);
        }elseif ($item->type === 'TYPE_STRING'){
            $this->valueString($item, $item_ua, $attribute_id);
        }elseif ($item->type === 'TYPE_FLOAT'){
            $this->valueFloat($item, $attribute_id);
        }
    }
    protected function valueString($data, $data_ua, $attribute_id){
        $value = $data->value;
        $value_ua = $data_ua->value;
        $value_attribute = ValueAttribute::create(
            ['sting_ru' => $value, 'string_ua' => $value_ua, 'attribute_id' => $attribute_id]
        );
        $this->values[] = $value_attribute->id;
    }
    protected function valueFloat($data, $attribute_id){
        $value = $data->value;

        $value_attribute = ValueAttribute::create(
            ['float' => $value,  'attribute_id' => $attribute_id]
        );
        $this->values[] = $value_attribute->id;
    }
    protected function valueBoolean($data, $attribute_id){
        $value = $data->value;

        $value_attribute = ValueAttribute::firstOrCreate(
            ['erc' => $data->id],
            ['float' => $value,  'attribute_id' => $attribute_id]
        );
        $this->values[] = $value_attribute->id;
    }
    protected function valueSet($data, $data_ua, $attribute_id){
        $value = $data->value;
        $value_ua = $data_ua->value;
        $value_attribute = ValueAttribute::firstOrCreate(
            ['erc' => $data->id],
            ['string_ru' => $value, 'string_ua' => $value_ua, 'attribute_id' => $attribute_id]
        );
        $this->values[] = $value_attribute->id;
    }

    protected function optimizationValue($string){
        $text = trim($string);
        $text = str_replace('No', 'Нет', $text);
        $text = str_replace('нет', 'Нет', $text);
        $text = str_replace('Discrete', 'Дискретная', $text);
        $text = str_replace('дискретная', 'Дискретная', $text);
        $text = str_replace('Integrated', 'Встроенная', $text);
        $text = str_replace('встроенная', 'Встроенная', $text);

        return $text;
    }

    protected function optimizationValueUa($string){
        $text = trim($string);
        $text = str_replace('No', 'Ні', $text);
        $text = str_replace('ні', 'Ні', $text);
        $text = str_replace('Нет', 'Ні', $text);
        $text = str_replace('Discrete', 'Дискретна', $text);
        $text = str_replace('дискретная', 'Дискретная', $text);
        $text = str_replace('Integrated', 'Вбудована', $text);
        $text = str_replace('встроенная', 'Вбудована', $text);

        return $text;
    }

    protected function getDescription($data){
        if (!$data){
            return null;
        }
        $text = '<p>'.$data->description.'</p>';
        if (isset($data->descriptionFull)){
            $text .= $data->descriptionFull;
        }
        return $this->cleanDescription($text);
    }

    protected function getVideos($videos){
        return array_map(function ($video){
            return [
                'youtube' => $video->youtubeId,
                'active' => 1
            ];
        }, $videos);
    }

    protected function cleanDescription($text){
        $text = trim($text);
        // $text = strip_tags($text, ['ul', 'li', 'p']);
        $text = strip_tags($text, ['p']);

        $text = str_replace(["\r\n", "\t", "<p></p>"], "", $text);

        $str = explode('Features:', $text)[0];
        $text = explode('The essentials', $text)[0];
        $text = explode('<p>Detail driven', $text)[0];
        $text = explode('<p>High-speeds', $text)[0];
        $text = explode('.<p>Beauty in the way', $text)[0];
        $text = explode('<p>Give your visuals', $text)[0];
        $text = explode('<p>The ideal portable', $text)[0];
        $text = explode('<p>True color', $text)[0];
        $text = explode('.<p>Designed with wellness', $text)[0];
        $text = explode('<p>Designed for more', $text)[0];
        $text = explode('<p style="text-align:justify">LCD 27&quot;', $text)[0];
        $text = explode('<p>Incredible visual', $text)[0];
        $text = explode('<p>Make the world', $text)[0];
        $text = explode('<p>An expansive view', $text)[0];
        $text = explode('<p>The Xerox C310 laser printer', $text)[0];
        $text = explode('<p>The VersaLink&reg;', $text)[0];
        $text = explode('.<p>Epson Heat-Free Technology', $text)[0];

        return $text;
    }

    protected function clean($string){
        return trim($string);
    }

    protected function getCode($code){
        return $this->clean($code);
    }

    protected function getVendor($vendor){
        $vendor = explode(' ', $vendor)[0];
        return Vendor::firstOrCreate(
            ['title' => $vendor],
        );
    }

    public function getCurr(){
        return (float)$this->ercStore
            ->getCurrency()
            ->cash;
    }

    protected function getPrice($price){
        return round((float)$price * $this->getCurr(), 2);
    }

    protected function getQuantity($data){
        $qtu = 0;
        foreach ($data as $item){
            $qtu += (int)trim($item->q, '>');
        }

        return $qtu;
    }

    protected function getSlug($string){
        return \URLify::slug($string);
    }

    protected function getPhotos($images){
        $photos = [];
        foreach ($images as $image){
            if($name = $this->getPhoto($image->src)){
                $photos[] = ['src' => $name];
            }
        }

        if (count($photos) > 0){
            return $photos;
        }

        return false;
    }

    protected function getStorePhotos($image){
        $url = str_replace('http://www.erc.ua', 'https://service-fw.erc.ua', $image);

        if($name = $this->getPhoto($url)){
            return [['src' => $name]];
        }
        return false;
    }

    protected function getPhoto($url){
        try {
            $image = $this->imageService->createGoodPhotosFile($url);
        }
        catch(\Exception $error) {
            dump('Error: '.$error->getMessage());
            return false;
        }
        return $image;
    }

}
