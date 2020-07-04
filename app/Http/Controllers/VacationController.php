<?php

namespace App\Http\Controllers;

use App\Vacation;
use Illuminate\Http\Request;
use Gate;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Gate::allows('isAdmin'))
        {
            $vacation=Vacation::get()->toArray();
            // dd($vacation);
            return view('admin.vacation',compact('vacation'));
        }
        else
        {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $reqCal=$this->dayCal($req->daterange);
        $vacation=$this->storeVacation($reqCal,$req->purpose);

        if($vacation)
        {
            $vacationList='
                <tr class="respectiveRow">
                    <td>'.date('d M, Y',strtotime($vacation->start_date)).' - '.date('d M, Y',strtotime($vacation->end_date)).'</td>
                    <td>'.$vacation->duration.'</td>
                    <td>'.$vacation->purpose.'</td>
                    <td><a href="javascript:void(0)" title="Delete this vacation" class="text-danger" onclick="deleteVacation(this,'.$vacation->id.');"><i class="fa fa-trash" aria-hidden="true"></i></a><span class="text-danger delete_status" style="margin-left: 10px; display:none;">Deleting...</span></td>
                </tr>'
            ;
            return response()->json(["success"=>$vacationList],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function show(Vacation $vacation)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacation $vacation)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacation $vacation)
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacation $vacation)
    {
        // dd('sdfs');
        $vacation->delete();
    }

    protected function storeVacation($reqCal, $purpose)
    {
        $vacation=Vacation::create([
            "start_date"=>$reqCal->start_day,
            "end_date"=>$reqCal->end_day,
            "duration"=>$reqCal->totalDays,
            "purpose"=>$purpose
        ]);
        return $vacation;
    }

    protected function dayCal($dates)
    {
        $dt=explode(' - ',$dates);
        $dtemp1=explode("/",$dt[0]);
        $d1= $dtemp1[0]."-".$dtemp1[1]."-".$dtemp1[2];

        $dtemp2=explode("/",$dt[1]);
        $d2= $dtemp2[0]."-".$dtemp2[1]."-".$dtemp2[2];

        $date1=date_create($d1);
        $date2=date_create($d2);
        $diff=date_diff($date1,$date2); 
        $days= $diff->format("%a")+1;    

        $reqCal=(object)array(
            "totalDays"=>$days,
            "start_day"=>date("Y-m-d H:i:s",(strtotime($d1))),
            "end_day"=>date("Y-m-d H:i:s",(strtotime($d2)))
        );

        return $reqCal;
    }
}
