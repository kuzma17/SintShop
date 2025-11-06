<?php

namespace App\Console\Commands;

use App\Models\Good;
use Illuminate\Console\Command;

class ExportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = $this->getCategoryGoods(1);
        $filePath = $this->saveDataCsv($data, 'computers');
        $this->info('=== Generated '.$filePath. ' ===');

        $data = $this->getCategoryGoods(2);
        $filePath = $this->saveDataCsv($data, 'monitors');
        $this->info('=== Generated '.$filePath. ' ===');

        $data = $this->getCategoryGoods(3);
        $filePath = $this->saveDataCsv($data, 'notepads');
        $this->info('=== Generated '.$filePath. ' ===');

        $data = $this->getCategoryGoods(4);
        $filePath = $this->saveDataCsv($data, 'printers');
        $this->info('=== Generated '.$filePath. ' ===');

        $data = $this->getCategoryGoods(5);
        $filePath = $this->saveDataCsv($data, 'mfu');
        $this->info('=== Generated '.$filePath. ' ===');

        $data = $this->getCategoryGoods(6);
        $filePath = $this->saveDataCsv($data, 'laser-cartridges');
        $this->info('=== Generated '.$filePath. ' ===');

        $data = $this->getCategoryGoods(7);
        $filePath = $this->saveDataCsv($data, 'jet-cartridges');
        $this->info('=== Generated '.$filePath. ' ===');

    }

    protected function getCategoryGoods($category_id)
    {
        return Good::where('category_id', $category_id)->get();

    }

    protected function saveDataCsv($data, $name_file)
    {
        // Путь, куда сохранить CSV-файл (например, storage/app/goods.csv)
        $filePath = storage_path('app/'.$name_file.'.csv');

        // Открываем файл для записи (w — перезапись файла, а не добавление)
        $file = fopen($filePath, 'w');

        // Можно добавить заголовки колонок
       // fputcsv($file, ['code', 'name'], ';');

        // Перебираем коллекцию/массив $data
        foreach ($data as $good) {
            // Записываем только нужные поля
            fputcsv($file, [
                $good['code'] ?? $good->code ?? '',
                $good['title_ru'] ?? $good->title_ru ?? '',
            ], ';');
        }

        fclose($file);

        return $filePath;

    }
}
