<?php

namespace App\Exports;

use App\Models\providers as model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class providers implements FromView
{
    public $records;
    function __construct($records)
    {
        $this->records= $records;
    }
    public function view(): View
    {
        return view('export.providers', [
            'records' => $this->records
        ]);
    }
}
