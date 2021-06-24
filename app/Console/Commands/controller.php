<?php
namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\fileName as model;

class fileName extends dashboard
{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $records= $this->model::query();
        if($request->search){
            $records->where("name","like","%".$request->search."%");
        }
        $records->orderBy($request->filterBy??"id",$request->filterType??"DESC"); // filter

        $itemPerPage= $request->itemPerPage??self::$itemPerPage;
        $totalPages= ceil($records->count()/$itemPerPage);
        $records= $records->forPage($request->page,$itemPerPage)->get();
        return response()->json([
            "status"=>$records->count()?200:204,
            "totalPages"=>$totalPages,
            "records"=>$records,
        ]);
    }
}
