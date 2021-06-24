<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\providers as model;
use App\Models\categories;

class providers extends dashboard
{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $records= $this->model::query();
        if($request->search){
            $records->where('name','like','%'.$request->search.'%');
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
    public function show( $id)
    {
        return response()->json(['status'=>200,
        'record'=>$this->model::findOrFail($id),
        'allCategories'=>categories::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $record= $this->model::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'subscription_at'=>$request->subscription_at,
            'subscription_end'=>$request->subscription_end,
            'first_subscription'=>$request->first_subscription,
            'categories_ids'=>$request->categories_ids,
            'balance'=>$request->balance,
            'companies_id'=>$request->companies_id,
            'images'=>$request->images,
            'password'=>\Hash::make($request->password),
        ]);
        return response()->json(['status'=>200]);
    }

}
