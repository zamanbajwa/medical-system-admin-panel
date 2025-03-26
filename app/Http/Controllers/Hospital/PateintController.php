<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

//Models
use App\Patient;
use App\HospitalStaff;
use App\Hospital;
use App\ResponderPatient;
use App\PatientWill;
use App\Insurance;
use App\MedicalHistory;
use App\MedicalDocument;
use App\ReferenceDoctor;
use App\EmergencyContact;

class PateintController extends Controller
{
    
    private $hospitalId;
    
    
    public function __construct()
    {
      

        $this->middleware(function ($request, $next) {
            $this->hospitalId = Auth::user()->id;
            return $next($request);
        });
    }
    
    public function getPatientDetail($user_id)
    {
        
        $data = Patient::where('id', $user_id)->with('medicalHistory','patientReminder','patientInsurance')->first();
        return view('hospital_views.patient_detail',['patient_detail' => $data]);
        //return Response::json(array('status' => 'success', 'successData' => $data));

    }

    public function addWalkinPatient($value='')
    {
      $data['hospital_id'] =  $this->hospitalId;
      return view('hospital_views.emergency_form',$data);
    }    


    public function getPatientEmergency($user_id)
    {
        
         $data = ResponderPatient::where(['id'=> $user_id])
                ->with('patientInfo', 'responderInfo','hospitalRespoder')
                ->first();

        return view('hospital_views.patient_emergency',['patient_detail' => $data]);
        return Response::json(array('status' => 'success', 'successData' => $data));

    }

    public function getPatientSummary(Request $request)
    {
        $patient_id = $request['patient_id'];
        $type       = $request['type'];
        if ($type == 'will') {
           $data['patient_will'] =  PatientWill::where('patient_id', $patient_id)->first();
        } elseif($type == 'doctors'){
            
           $reference =  ReferenceDoctor::where('patient_id', $patient_id)->get();
           $html = '';
           if ($reference) {
               foreach ($reference as $key => $value) {
                   $html.=$value->name.' : '.$value->contact_number.'<br />';
               }
           }
            $data['reference_doctor'] =  $html;
        } elseif($type == 'documents'){
            $documents =  MedicalDocument::where('patient_id', $patient_id)->get();
            $html = '';

            if ($documents) {
               foreach ($documents as $key => $value) {
                   $html.='Name : '.$value->name.'<br />';
                   $html.='Description. : '.$value->detail.'<br />';
                   $html.='Date : '.$value->date.'<br />';
                   $html.='Documents : <img width="25" src="'.asset("$value->document").'">'.'<br /><hr>';
               }
           }
            $data['documents'] =  $html;


        } elseif($type == 'emergency'){
            $data['patient_emergency'] =  EmergencyContact::where('patient_id', $patient_id)->first();
        } elseif($type == 'Insurance'){
            $insurance =  Insurance::where('patient_id', $patient_id)->get();
            $html = '';
           if ($insurance) {
               foreach ($insurance as $key => $value) {
                   $html.='Name : '.$value->name.'<br />';
                   $html.='Policy No. : '.$value->policy_number.'<br />';
                   $html.='Carrier No. : '.$value->carrier_number.'<br />';
                   $html.='Category : '.$value->category.'<br />';
                   $html.='Providers : '.$value->providers.'<br />';
                   $html.='Providers : '.$value->providers.'<br />';
                   $html.='Insurance PCP : '.$value->insurance_pcp.'<br />';
                   $html.='Insurance Pharmacy : '.$value->insurance_pharmacy.'<br /><hr>';
               }
           }
            $data['insurance'] =  $html;
        } elseif($type == 'history'){
            $history =  MedicalHistory::where('patient_id', $patient_id)->get();
            $html = '';
           if ($history) {
               foreach ($history as $key => $value) {
                   $html.='Illness : '.$value->illness_name.'<br />';
                   $html.='Illness detail : '.$value->illness_detail.'<br />';
                   $html.='BP : '.$value->bp.'<br />';
                   $html.='Heart Rate : '.$value->heart_rate.'<br />';
                   $html.='Temperature : '.$value->temperature.'<br />';
                   $html.='OX : '.$value->ox.'<br /><hr>';
               }
           }
            $data['history'] =  $html;
        }
        return Response::json(array('status' => 'success', 'successData' => $data));

    }
}
