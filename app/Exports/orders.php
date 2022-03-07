<?php

namespace App\Exports;

use App\Models\orders as model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class orders implements FromView
{
    public $records;
    function __construct($records)
    {
        $this->records= $records;
    }
    public function view(): View
    {
        return view('orderdowlload', [
            'records' => $this->records
        ]);
    }
}
