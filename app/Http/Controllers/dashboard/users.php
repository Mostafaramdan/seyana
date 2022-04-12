<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Models\users as model;
use App\services\usersService;

class users extends dashboard
{
    function __construct()
    {
        $this->model= model::class;
    }
    public function index(Request $request)
    {
        $records= $this->model::query();
        if($request->search){
            $records->where('name','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ;
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
    public function store(Request $request)
    {
        $this->model::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'fees'=>$request->fees,
            'password'=>\Hash::make($request->password),
        ]);
        return response()->json(['status'=>200]);
    }
    public function update(Request $request, $id)
    {
        $record= $this->model::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'fees'=>$request->fees,
            'balance'=>$request->balance,
            'password'=>\Hash::make($request->password),
        ]);
        return response()->json(['status'=>200]);
    }
}
