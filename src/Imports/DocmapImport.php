<?php

namespace Module\Posyandu\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Posyandu\Models\PosyanduDocmap;

class DocmapImport implements ToCollection, WithHeadingRow
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
        $this->command->info('posyandu:docmap_table');
        $this->command->getOutput()->progressStart(count($rows));

        foreach ($rows as $row) {
            $this->command->getOutput()->progressAdvance();

            /** CREATE NEW RECORD */
            $record     = (object) $row->toArray();

            /** MODEL */
            $model              = new PosyanduDocmap();
            $model->name        = $record->name;
            $model->slug        = str($record->name . ' ' . $record->service_id . ' ' . $record->document_id)->slug();
            $model->document_id = $record->document_id;
            $model->service_id  = $record->service_id;
            $model->required    = $record->required;
            $model->save();
        }

        $this->command->getOutput()->progressFinish();
    }
}
