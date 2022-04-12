<?php

namespace App\Exports;

use App\Models\services as model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class services implements FromView
{
    public $records;
    function __construct($records)
    {
        $this->records= $records;
    }
    public function view(): View
    {
        return view('export.services', [
            'records' => $this->records
        ]);
    }
}
