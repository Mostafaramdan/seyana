<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\admins;
use App\Models\regions;

use App\Models\users as usersModel;
use App\Exports\users as usersExport;

use App\Models\services as servicesModel;
use App\Exports\services as servicesExport;

use App\Models\providers as providersModel;
use App\Exports\providers as providersExport;

use App\Models\companies as companiesModel;
use App\Exports\companies as companiesExport;

use App\Models\categories as categoriesModel;
use App\Exports\categories as categoriesExport;

use Maatwebsite\Excel\Facades\Excel;


class dashboard extends Controller
{
    protected $model;
    public  $admin;

    public function index(Request $request)
    {
        $records= $this->model::query();
        if($request->search){
            // $records->where()
        }
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
        $this->model::create($request->all());
        return response()->json(['status'=>200]);
    }

    public function show( $id)
    {
        return response()->json(['status'=>200, 'record'=>$this->model::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $request= $request->all();
        $columns =  \Schema::getColumnListing((new $this->model)->getTable() ) ;
        foreach($request as $k=>$v){
            $filtered = Arr::where($columns, function ($value, $key) use ($k){
                return $k == $value;
            });
            if(count($filtered) == 0){
                $request = Arr::except($request, $k);
            }
        }
        $record= $this->model::where('id',$id)->update( ($request));
        return response()->json(['status'=>200]);
    }

    public function destroy($id)
    {
        $this->model::destroy($id);
        return response()->json(['status'=>200]);
    }
    public static function toggle ($model, $column, $id)
    {
        $model = "\App\Models\\".$model ;
        $record = $model::findOrFail($id);
        if($record->$column){
            $record->$column=0;
        }else{
            $record->$column=1;
        }
        $record->save();
        return response()->json(['status'=>200,$record]);
    }
    public static function dropdown (Request $request , $model )
    {
        $model = "\App\Models\\".$model ;
        $records = $model::query();
        if($request->search){
            $records->where($request->column,'like','%'.$request->search.'%');
        }
        return response()->json(['status'=>200,'records'=>$records->forPage(0,50)->get()]);
    }
    public static function permissions()
    {
        return response()->json(['status'=>200,'permissions'=>config('dashboard.permissions')]);
    }
     
    public static function dropdownDistricts (Request $request , $model )
    {
        $records = regions::with('country')->where('regions_id','!=',null);
        if($request->search){
            $records->where($request->column,'like','%'.$request->search.'%');
        }
        return response()->json(['status'=>200,'records'=>$records->forPage(0,50)->get()]);
    }

    public function exportUsers()
    {
        return Excel::download(new usersExport(usersModel::all()), 'العملاء.xlsx');
    }
    public function exportServices()
    {
        return Excel::download(new servicesExport(servicesModel::all()), 'العناصر.xlsx');
    }

    public function exportProviders()
    {
        return Excel::download(new providersExport(providersModel::all()), 'مزودي الخدمة.xlsx');
    }

    public function exportCompanies()
    {
        return Excel::download(new companiesExport(companiesModel::all()), 'الشركات.xlsx');
    }

    public function exportCategories()
    {
        return Excel::download(new categoriesExport(categoriesModel::all()), 'الخدمات.xlsx');
    }
    
    
}
