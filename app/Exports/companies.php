<?php

namespace App\Exports;

use App\Models\companies as model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class companies implements FromView
{
    public $records;
    function __construct($records)
    {
        $this->records= $records;
    }
    public function view(): View
    {
        return view('export.companies', [
            'records' => $this->records
        ]);
    }
}
