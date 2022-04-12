<?php

namespace App\Exports;

use App\Models\categories as model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class categories implements FromView
{
    public $records;
    function __construct($records)
    {
        $this->records= $records;
    }
    public function view(): View
    {
        return view('export.categories', [
            'records' => $this->records
        ]);
    }
}
