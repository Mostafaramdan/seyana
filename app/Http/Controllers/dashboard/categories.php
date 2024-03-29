<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\categories as model;
use App\Models\countries;

class categories extends dashboard

{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $records= $this->model::when($request->countries_id,function($q) use ($request){
            return $q->where('countries_id',$request->countries_id);
        });
        if($request->search){
            $records->where('name_ar','like','%'.$request->search.'%')
                    ->orWhere('name_en','like','%'.$request->search.'%');
        }
        $records->orderBy($request->filterBy??'id',$request->filterType??'DESC'); // filter

        $itemPerPage= $request->itemPerPage??self::$itemPerPage;
        $totalPages= ceil($records->count()/$itemPerPage);
        $records= $records->forPage($request->page,$itemPerPage)->get();
        return response()->json([
            "status"=>$records->count()?200:204,
            "totalPages"=>$totalPages,
            "records"=>$records,
            'countries'=>countries::find($this->model::groupBy('countries_id')->pluck('countries_id')->toArray())
        ]);
    }
    public function getAll()
    {
        return response()->json(['records'=>$this->model::all()]);
    }

}
