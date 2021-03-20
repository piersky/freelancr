<?php

namespace App\Exports;

use App\Models\HourStack;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class HourstackExport implements FromCollection
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $hourstack = DB::table('hour_stacks', 'hs')
            ->join('activities AS a', 'a.hourstack_id', '=', 'hs.id')
            ->select([
                'hs.name AS hourstack',
                'a.start_at',
                'a.stop_at',
                'a.name',
                'a.description',
                'a.used_hours'
            ])
            ->where('hs.id', '=', $this->id)
            ->get();

        return $hourstack;
    }
}
