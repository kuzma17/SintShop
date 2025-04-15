<?php

namespace App\Console\Commands;


use App\Import\ERC\ErcParser;
use App\Import\ERC\ErcProducts;
use App\Import\ERC\ErcStore;
use App\Models\Category;
use Illuminate\Console\Command;

class ErcProductImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'erc-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ERC product parser';

    /**
     * Execute the console command.
     */
    public function handle(ErcParser $ercParser, ErcStore $ercStore, ErcProducts $ercProducts)
    {

       // dd($ercProducts->getToken());
//        $response = $ercStore->getCodeCategories('ru');
//        $data = $response->Data;
//        $text = '';
//
//        foreach ($data as $item) {
//            $text .= "{$item->ID} - {$item->Name}\n";
//        }
//
//        file_put_contents(base_path('ajaxDebug.log'), $text);
//        echo "Данные сохранены в data.txt";
//
//        dd($data_cat->Data[0]);



        //102.01.03.03 => Компьютеры потребительские
       // $ercParser->parse(Category::find(1), ['102.01.03.03']);

        //107.01.02.01 => Мониторы потребительские
        //$ercParser->parse(Category::find(2), ['107.01.02.01']);

        //102.01.01.01 => Ноутбуки для бизнеса
        //102.01.01.02 => Ноутбуки потребительские
       //$ercParser->parse(Category::find(3), ['102.01.01.01', '102.01.01.02']);

        //107.02.01.05 => Принтеры лазерные монохромные
        //107.02.01.06 => Принтеры лазерные цветные
        //107.02.01.10 => Принтеры струйные монохромные
        //107.02.01.11 => Принтеры струйные цветные
        $ercParser->parse(Category::find(4), ['107.02.01.05', '107.02.01.06', '107.02.01.10', '107.02.01.11']);

        //107.02.01.01 => МФУ лазерные монохромные
        //107.02.01.02 => МФУ лазерные цветные
        //107.02.01.03 => МФУ струйные монохромные
        $ercParser->parse(Category::find(5), ['107.02.01.01', '107.02.01.02', '107.02.01.03']);

        //107.02.02.07 => Картриджи для лазерных монохромных устройств
        //107.02.02.08 => Картриджи для лазерных цветных устройств
        //$ercParser->parse(Category::find(6), ['107.02.02.07', '107.02.02.08']);

        //107.02.02.09 => Картриджи для струйных устройств
        //$ercParser->parse(Category::find(7), ['107.02.02.09']);


        //
        //$ercParser->countNullGood(); // sets the quantity value to 0 if it is not in the ERC warehouse

    }


}
