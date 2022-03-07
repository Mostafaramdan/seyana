<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\app_settings as model;

class app_settings extends dashboard

{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $records= $this->model::with('country');
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
        ]);
    }
    public function getAll()
    {
        return response()->json(['records'=>$this->model::all()]);
    }
    public function store(Request $request)
    {
        if( $this->model::where('countries_id',$request->countries_id)->count()){
            return response()->json([
                'status'=>406,
                'message'=>'تم إدخال اعدادات لهذه الدولة مسبقا'
            ]);
            }
        $this->model::create($request->all());
        return response()->json(['status'=>200]);
    }
}
