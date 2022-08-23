<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
//use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_info=auth()->guard('api')->user();
        $tirp=Trip::where('trip_owner_user_id','=',$user_info->id)->count();
        $driver=Driver::where('created_by','=',$user_info->id)->count();
        $transaction = Transaction::where('operator_id','=',$user_info->id)->count();
        return response(['total_trip' => $tirp, 'total_driver' => $driver,'total_transaction'=> $transaction], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function driver_list()
    {
        $user_info=auth()->guard('api')->user();
        $drivers=Driver::select('driver.*','users.email','company.company_name','users.fname','users.lname','state.state_name as state_name','city.city_name as city_name')
        ->join('users','driver.user_id','=','users.id')
        ->join('company','users.company_id','=','company.id')
        ->join('state','driver.state_id','=','state.id')
        ->join('city','driver.city_id','=','city.id')
        ->where('user_id','=',$user_info->id)->get();
        return response(['driver_list' => $drivers], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function trip_list()
    {
        $user_info=auth()->guard('api')->user();
        $trips=Trip::select('trip.*','company.company_name','sta.state_name as to_state_name','cit.city_name as to_city_name','state.state_name as from_state_name','city.city_name as from_city_name')
        ->join('company','trip.trip_owner_company_id','=','company.id')
        ->leftJoin('state','trip.from_state_id','=','state.id')
        ->leftJoin('city','trip.from_city_id','=','city.id')
        ->leftJoin('state as sta','trip.to_state_id','=','sta.id')
        ->leftJoin('city as cit','trip.to_city_id','=','cit.id')
        ->where('trip_owner_user_id','=',$user_info->id)->get();
        return response(['trip_list' => $trips], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return response(['project' => new ProjectResource($project), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response(['message' => 'Deleted']);
    }
}