<?php

namespace App\Exports;

use App\Models\users as model;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class users implements FromView
{
    public $records;
    function __construct($records)
    {
        $this->records= $records;
    }
    public function view(): View
    {
        return view('export.users', [
            'records' => $this->records
        ]);
    }
}
