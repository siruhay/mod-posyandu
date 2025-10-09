<?php

namespace Module\Posyandu\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Posyandu\Models\PosyanduCategory;
use Module\Posyandu\Models\PosyanduSubService;

class CategoryImport implements ToCollection, WithHeadingRow
{
    /**
     * The construct function
     *
     * @param [type] $command
     * @param string $mode
     */
    public function __construct(protected $command)
    {
    }

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        $this->command->info('posyandu:category_table');
        $this->command->getOutput()->progressStart(count($rows));

        foreach ($rows as $row) {
            $this->command->getOutput()->progressAdvance();

            /** CREATE NEW RECORD */
            $record     = (object) $row->toArray();

            /** MODEL */
            $model          = new PosyanduCategory();
            $model->name    = $record->name;
            $model->slug    = str($record->name)->slug();
            $model->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
