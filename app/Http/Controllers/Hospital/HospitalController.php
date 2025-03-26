<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

//Models
use App\HospitalStaff;
use App\Hospital;
use App\ResponderPatient;
use App\Patient;

class HospitalController extends Controller
{
    
    private $hospitalId;
    
    
    public function __construct()
    {
        
        $this->middleware(function ($request, $next) {
            $this->hospitalId = Auth::user()->id;
            return $next($request);
        });
    }
    
    public function getDashboard()
    {

        $hospital = Hospital::where('user_id', $this->hospitalId)->first();

        $data = ResponderPatient::selectRaw("*,
                                ( 6371 * acos( cos( radians($hospital->lat) ) *
                                cos( radians(lat) ) *
                                cos( radians(lng) - radians($hospital->lng) ) + 
                                sin( radians($hospital->lat) ) *
                                sin( radians(lat) ) ) ) 
                                AS distance")
                ->where(['hospital_id'=> $this->hospitalId])
                ->with('patientInfo', 'patientInfo.medicalHistory')
                ->orderBy('distance', 'asc')
                ->paginate(15);
                //->get();
                //dd($data);
         //return view('hospital_views.patients_list',['patients' => $data]);
         return view('hospital_views.dashboard',['patients' => $data]);
        
        //return Response::json(array('status' => 'success', 'successData' => $data));

    }


    public function getIncomingPatientAnalytics()
    {

        $hospital = Hospital::where('user_id', $this->hospitalId)->first();

        $data = ResponderPatient::selectRaw("*,
                                ( 6371 * acos( cos( radians($hospital->lat) ) *
                                cos( radians(lat) ) *
                                cos( radians(lng) - radians($hospital->lng) ) + 
                                sin( radians($hospital->lat) ) *
                                sin( radians(lat) ) ) ) 
                                AS distance")
                ->where(['hospital_id'=> $this->hospitalId])
                ->with('patientInfo', 'patientInfo.medicalHistory')
                ->orderBy('distance', 'asc')
                ->paginate(15);
                //->get();
                //dd($data);
         return view('hospital_views.patients_list',['patients' => $data]);
        //return Response::json(array('status' => 'success', 'successData' => $data));

    }
 public function getPatients(Request $request)
    {
        $thumb_id = $request->term;
        $patients = Patient::where('thumb_id', $thumb_id)->get();
        $results = array();
        foreach ($patients as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->first_name.' '.$query->last_name ];
        }
        return Response::json($results);

    }
}
