<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\orders as model;
use App\Models\services;
use App\Models\categories;
use App\Models\carts;

class statistics extends dashboard
{
    function __construct(Request $request)
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $record=[
            'waiting'=> $this->model::where('created_at','>=',$request->from??'2020-12-30')->where('created_at','<=',$request->to??'3030-12-30')->where('status','waiting')->count(),
            'processing'=> $this->model::where('created_at','>=',$request->from??'2020-12-30')->where('created_at','<=',$request->to??'3030-12-30')->where('status','processing')->count(),
            'finished'=> $this->model::where('created_at','>=',$request->from??'2020-12-30')->where('created_at','<=',$request->to??'3030-12-30')->where('status','finished')->count(),
            'cancelled'=> $this->model::where('status','cancelled')->count(),
            'refused'=> $this->model::where('created_at','>=',$request->from??'2020-12-30')->where('created_at','<=',$request->to??'3030-12-30')->where('status','refused')->count(),
            'orders'=> $this->model::whereIn('status',['waiting','coming','resident','finished'])->count(),
            'allOrders'=> $this->model::where('created_at','>=',$request->from??'2020-12-30')->where('created_at','<=',$request->to??'3030-12-30')->forPage(0,100)->get(),
            'total'=> carts::whereHas('order',function($q) {
                    return $q->where('created_at','>=',$request->from??'2020-12-30')->where('created_at','<=',$request->to??'3030-12-30')->whereIn('status',['waiting','coming','resident','finished']);
                })->sum('price'),
            'fees'=> $this->model::where('created_at','>=',$request->from??'2020-12-30')->where('created_at','<=',$request->to??'3030-12-30')->whereIn('status',['waiting','coming','resident','finished'])->sum('fees'),
            'services'=> services::count(),
            'categories'=> categories::count(),
        ];

        return response()->json([
            "status"=>200,
            "record"=>$record,
        ]);
    }
}
