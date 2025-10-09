<?php

namespace Module\Posyandu\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Posyandu\Models\PosyanduSubService;

class SubServiceImport implements ToCollection, WithHeadingRow
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
        $this->command->info('posyandu:subservices_table');
        $this->command->getOutput()->progressStart(count($rows));

        foreach ($rows as $row) {
            $this->command->getOutput()->progressAdvance();

            /** CREATE NEW RECORD */
            $record     = (object) $row->toArray();


            /** MODEL */
            $model              = new PosyanduSubService();
            $model->name        = $record->name;
            $model->slug        = str($record->name)->slug();
            $model->service_id  = $record->service_id;
            $model->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
