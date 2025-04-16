<?php

namespace App\Import\ERC;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Erc\ErcAttribute;
use App\Models\Erc\ErcFloatValue;
use App\Models\Erc\ErcValue;
use App\Models\Good;
use App\Models\ValueAttribute;
use App\Models\Vendor;
use App\Services\ImageService;
use phpDocumentor\Reflection\Types\Float_;

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
        $this->imageService->format('webp');
    }

    /**
     * $erc_categories Array
     * $category Object
     */
    public function parse(Category $category, $erc_categories){


//    Attributes ======================


   //     $category_id = 7; //


//        $data = Attribute::where('category_id', $category_id)
//           // ->where('filter', 1)
//            ->where('active',1)
//            //->where('_use', 0)
//            ->where(function ($query){
//                return $query->where('type_id', 1)
//                    ->orWhere('type_id', 4);
//            })
//            ->get();
//
//
//        foreach ($data as $item){
//
//            $ercAttribute = new ErcAttribute();
//            $ercAttribute->attribute_id = $item->id;
//            $ercAttribute->erc = $item->erc;
//            $ercAttribute->category___id = $category_id;
//            $ercAttribute->save();
//        }
//
//        dd($data);

        // Check

//        $ercAttributes = ErcAttribute::with('attributeGood')->get();
//
//        foreach ($ercAttributes as $attribute){
//
//            dump($attribute->attributeGood->type_id);
//        }
//
//        dd(4321432143);


//        // Values============

//        $attributesCategory = Attribute::where('category_id',$category_id)
//           // ->where('filter', 0)
//            ->where('active',1)
//            ->where('_use', 0)
//            ->where(function ($query){
//                return $query->where('type_id', 1)
//                    ->orWhere('type_id', 4);
//            })
//            ->get();
//
// $attributesCategory = [Attribute::find(155)];
//
 //       dd($attributesCategory[0]->values->take(10));
//
//        $category_id = 4;
//        foreach ($attributesCategory as $attr){
//            foreach ($attr->values as $value){
//                $ercValue = new ErcValue();
//                $ercValue->value_id = $value->id;
//                $ercValue->erc =$value->erc;
//                $ercValue->category___id = $category_id;
//                $ercValue->save();
//            }
//        }
//
//        dd(111);



        /// FloatAttributeValue


//        $attribute_id = 293;
//
//        $values = ValueAttribute::where('attribute_id',$attribute_id)->get();
//
//        foreach ($values as $value){
//            $ercFloatValue = new ErcFloatValue();
//            $ercFloatValue->attribute_id = $attribute_id;
//            $ercFloatValue->erc_value = (float)$value->string_ru;
//            $ercFloatValue->value_id = $value->id;
//            //$ercFloatValue->filter_value_id = $this->getFilerValueResourceJetCartridges((float)$value->string_ru);
//
//
//            $ercFloatValue->save();
//        }
//
//        dd('=== Finish ===');



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

                //==================

                if ($good = Good::where('erc', 1)->where('code', $code)->first()){
                   $this->updateGood($good, $dataGoodSet);

                   dump('updated '.$good->id.' '.$good->title_ru);

                    continue;
                }

                //=======================

                $name = $this->getName($item);

                $dataGoodSet = array_merge($dataGoodSet,[
                    'code' => $code,
                    'category_id' => $this->category->id,
                    'vendor_id' => $this->getVendor($item->vendor)->id,
                    'slug' => $this->getSlug($name),
                    'title_ru' => $name,
                    'title_ua' => $this->getName($data_ua[$key]),
                    'active' => 1,
                    'erc' => 1
                ]);

                $product = $this->ercProducts->getGoodInfo($code, 'ru'); // API Product
                $product_ua = $this->ercProducts->getGoodInfo($code);

                //dd($product);
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

//                if ($good = Good::where('erc', 1)->where('code', $code)->first()) {
//                    $this->updateGood($good, $dataGoodSet, $photos);
//
//                    dump('updated '.$good->id.' '.$good->title_ru);
//
//                    continue;
//
//                }

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

//        if ($photos){
//            $good->photos()->createMany($photos);
//        }

//        if (count($this->values) > 0){
//            $good->valueAttributes()->syncWithoutDetaching($this->values);
//            $this->values = [];
//        }
    }

    protected function getName($data){

        $str_name = trim($data->gname);
        $str_name = preg_replace('/\s+/', ' ', $str_name); // Удаляем двойные пробелы
        $str_name = preg_replace('/\s*\([^)]*\)/', '', $str_name);

        if ($this->category->id === 1 || $this->category->id === 2 || $this->category->id === 3 || $this->category->id === 4 || $this->category->id === 5){
            $name = explode(',', $str_name)[0].' ('.$data->code.')';
        }elseif ($this->category->id === 6 || $this->category->id === 7){
            $name = explode('/', $str_name)[0].' ('.$data->code.')';
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

            //dd($data);
            foreach ($items as $key => $item) {

                if (in_array($item->id, $this->exception_attr)) {
                    continue;
                }


  //              $attribute = $this->getAttribute($item, $items_ua[$key]); // Атрибуты не нужны только value. Ибо оные записываются в good_value_attributes
//
//                if (!$attribute){
//                    continue;
//                }

                //dump('attr : '.$attribute);
                $ercAttr = ErcAttribute::where('erc', $item->id)->first();

                if ($ercAttr){
                    $this->getValues($item, $items_ua[$key], $ercAttr->attribute_id);
                }


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

//        $ercAttribute = ErcAttribute::where('erc', $data->id)->first();
//
//        return $ercAttribute? $ercAttribute->attribute_id: null;
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
        }
 //       elseif ($item->type === 'TYPE_STRING'){
//            $this->valueString($item, $item_ua, $attribute_id);
//        }
          elseif ($item->type === 'TYPE_FLOAT'){
            //$this->valueFloat($item, $attribute_id);

              $data = $this->getErcFloatValue($item, $attribute_id);

              $this->addFloatValue($data); //отправляем values
        }

        return null;
    }

    protected function addFloatValue($item)
    {

        $this->addValue($item->value_id);
        if ($item->filter_value_id){ // добавляем 2 атрибут если есть, это диагональ в мониторах
            $this->addValue($item->filter_value_id);

        }

    }

    protected function getErcFloatValue($item, $attribute_id)
    {
        if ($floatValue = ErcFloatValue::where('attribute_id', $attribute_id)->where('erc_value', $item->value)->first()){

            return $floatValue;
        }

        $attribute = Attribute::find($attribute_id);

        $value_attributes = $attribute->values()->create([ // Записываем новое значение
            'slug' => $this->getSlug($item->value),
            'string_ru' => $item->value,
            'string_ua' => $item->value,
            'active' => 1
        ]);

        $ercFloatValue = new ErcFloatValue();
        $ercFloatValue->attribute_id = $attribute->id;
        $ercFloatValue->erc_value = $item->value;
        $ercFloatValue->value_id = $value_attributes->id;

        if ($attribute->id == 26){ // если диагональ мониторы

            $filter_value = $this->getFilerValueDiagonalMonitors($item->value);
            $ercFloatValue->filter_value_id = $filter_value;

        }elseif ($attribute->id == 77){  // если диагональ ноутбуки

            $filter_value = $this->getFilerValueDiagonalLaptops($item->value);
            $ercFloatValue->filter_value_id = $filter_value;

        }elseif ($attribute->id == 279){ // если ресурс картридж лазерный

            $filter_value = $this->getFilerValueResourceLaserCartridges($item->value);
            $ercFloatValue->filter_value_id = $filter_value;

        }elseif ($attribute->id == 290){ // если ресурс картридж струйный

            $filter_value = $this->getFilerValueResourceJetCartridges($item->value);
            $ercFloatValue->filter_value_id = $filter_value;
        }

        $ercFloatValue->save();
       return $ercFloatValue;
    }

    protected function getFilerValueDiagonalMonitors(float $value)
    {
        if ($value < 15){
            return 15950;
        }elseif ($value >= 15 && $value < 20){
            return 15951;
        }elseif ($value >= 20 && $value < 25){
            return 15952;
        }elseif ($value >= 25 && $value < 30){
            return 15953;
        }elseif ($value >= 30 && $value < 35){
            return 15954;
        }elseif ($value >= 35 && $value < 40){
            return 15955;
        }elseif ($value >= 40 && $value < 45){
            return 15956;
        }elseif ($value >= 45 && $value < 50){
            return 15957;
        }elseif ($value >= 50){
            return 15958;
        }

    }

    protected function getFilerValueDiagonalLaptops(float $value)
    {
        if ($value < 13){
            return 15989;
        }elseif ($value >= 13 && $value < 14){
            return 15990;
        }elseif ($value >= 14 && $value < 15){
            return 15991;
        }elseif ($value >= 15 && $value < 16){
            return 15992;
        }elseif ($value >= 16 && $value < 17){
            return 15993;
        }elseif ($value >= 17){
            return 15994;
        }

    }

    protected function getFilerValueResourceLaserCartridges(float $value)
    {
        if ($value < 2000){
            return 16054;
        }elseif ($value >= 2000 && $value < 5000){
            return 16055;
        }elseif ($value >= 5000 && $value < 15000){
            return 16056;
        }elseif ($value >= 15000 && $value < 30000){
            return 16057;
        }elseif ($value >= 30000){
            return 16059;
        }

    }

    protected function getFilerValueResourceJetCartridges(float $value)
    {
        if ($value < 250){
            return 16065;
        }elseif ($value >= 250 && $value < 500){
            return 16066;
        }elseif ($value >= 500 && $value < 1000){
            return 16067;
        }elseif ($value >= 1000 && $value < 2000){
            return 16068;
        }elseif ($value >= 2000 && $value < 3000){
            return 16069;
        }elseif ($value >= 3000){
            return 16070;
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
  //      $value = $data->value;

//        $value_attribute = ValueAttribute::firstOrCreate(
//            ['erc' => $data->id],
//            ['float' => $value,  'attribute_id' => $attribute_id]
//        );

        //dd($data);
        // Тут наеврно нужно сделать общий для всех 1 "Да"

        $attribute = ErcValue::with('valueAttribute')
            ->where('erc', $data->id)
            ->first();

        if(isset($attribute->valueAttribute)){
            $id = $attribute->valueAttribute->id;
            $this->addValue($id);
        }
    }
    protected function valueSet($data, $data_ua, $attribute_id){
//        $value = $data->value;
//        $value_ua = $data_ua->value;
//
//        $value_attribute = ValueAttribute::firstOrCreate(
//            ['erc' => $data->id],
//            ['string_ru' => $value, 'string_ua' => $value_ua, 'attribute_id' => $attribute_id, 'active' => 1, 'slug' => \Str::slug($value)]
//        );

        $attribute = ErcValue::with('valueAttribute')
            ->where('erc', $data->id)
            ->first();

//        ErcValue::firstOrCreate(
//            ['erc' => $data->id],
//            ['value_id' => $value_attribute->id]
//        );



        if(isset($attribute->valueAttribute)){
            $id = $attribute->valueAttribute->id;
            $this->addValue($id);
        }

//        $this->addValue($value_attribute->id);

    }

    protected function addValue($id)
    {
        if (!in_array($id, $this->values)){
            $this->values[] = $id;
        }

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
        $string = str_replace([' з ', ' с ', ' и ', ' і '], ' ', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = str_replace('Компьютер', 'computer', $string);
        $string = str_replace('Монитор', 'monitor', $string);
        $string = str_replace('Ноутбук', 'laptop', $string);
        $string = str_replace('Принтер', 'printer', $string);
        $string = str_replace('МФУ', 'mfp', $string);
        $string = str_replace('Картридж', 'cartridge', $string);

        //$string = str_replace(['Компьютер','Монитор','Ноутбук','Принтер','МФУ','Картридж'], '', $string);
        //$string = trim($string);
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
