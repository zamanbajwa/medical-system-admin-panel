<?php

namespace App\Http\Controllers;

use App\hospital_staff_document;
use App\HospitalStaff;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;


use App\Hospital;
use App\User;
use App\FirstResponderDetail;


class AdminController extends Controller
{
//   public function __construct()
//   {
//       $this->middleware('auth');
//       if (Auth::check()) {
//           $this->id = Auth::admin()->id;
//        }
//  }

    public function main()
    {
        $user=new User();
        $hospitals=Hospital::all();
        return view('admindashboard.main', compact('hospitals'));
    }

    public function approveHospital(Request $request, $id)
    {

        $hospital=Hospital::find($id);
        $user=User::find($hospital->user_id);
        $user->is_approved=1;
        $user->save();
        return redirect() ->back();
    }

    public function rejectHospital($id)
    {
         $user=User::find($id);

//        $user= User::find($id);
//         $user=User::find($id);
//        $staff = HospitalStaff::where('user_id',$users->id)->get();
//        if($staff->all() != null){
//
//            $user_id = $users->hospital->staff->user_id;
//            $staff_user = User::find($user_id);
//            $staff_user->delete();
//        }


        $user->delete();
        return redirect() ->back();

    }

    public function addhospital()
    {


        return view('admindashboard.addhospitals');
    }

    public function posthospital(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:7',
            'name'=> 'required',
            'area'=>'required|min:5'

        ]);

        $users= new User();
        $users-> email= $request['email'];
        $hashed = bcrypt($request['password']);
        $users-> password= $hashed;
        $users->user_type=4;
        $users->is_approved=1;
        $users->save();



        $hospitals=new Hospital();
//        $hospitals-> id= $request['id'];
        $hospitals-> name= $request['name'];
        $hospitals-> area= $request['area'];

        $hospitals-> lat= $request['lat'];
        $hospitals-> lng= $request['lng'];

        $hospitals->user_id = $users->id;
        $hospitals-> save();

        Session::flash('message','Your data has been successfully submitted');
        return redirect() ->back();

//        return view('admindashboard.addhospitals');
    }

    public function getedit($id)
    {

        $hospitals = Hospital::findOrFail($id);
        $users= User::findOrFail($hospitals->user->id);
        return view('admindashboard.edithospitals', compact('hospitals','users'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postedit($id, Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'name'=> 'required',
            'area'=>'required|min:5'

        ]);


        $hospitals = Hospital::findOrFail($id);
        $users= User::findOrFail($hospitals->user->id);
        $users->email= $request['email'];
        $hashed = bcrypt($request['password']);
        $users-> password= $hashed;
        $users->save();
        $hospitals-> name= $request['name'];
        $hospitals-> area= $request['area'];

//        $hashed = bcrypt($request['password']);
//        $hospitals-> password= $hashed;

        $hospitals-> lat= $request['lat'];
        $hospitals-> lng= $request['lng'];
        $hospitals-> save();


        Session::flash('message','Your data has been successfully updated');
        return redirect() ->back();

//        return view('admindashboard.edithospitals');
    }

    public function deletehospital($id)
    {


//
//        $staff=HospitalStaff::find($id);
//        $hospitals = Hospital::findOrFail($id);
        $users= User::find($id);
        $staff = $users->hospital->staff;
        if($staff != null){
            $user_idz=$this->propertyToArray($staff->all(),'user_id');
            DB::table('users')->whereIn('id', $user_idz)->delete();
//            $user_id = $users->hospital->staff->user_id;
//            $staff_user = User::find($user_id);
//            $staff_user->delete();

        }
        $users->delete();


        Session::flash('flash_message', 'Your Data has been successfully deleted!');
        return redirect() ->back();
    }

    public function propertyToArray(array $objects, $property)
    {
        $array = [];
        foreach($objects as $object)
        {
            $array[] = $object->$property;
        }
        return $array;
    }

    public function hospitallist($id){

//        print_r($user); exit();
        $hospital= Hospital::find($id);
        $user= User::where('id', $hospital->user_id )->first();
        $staff = HospitalStaff::where('hospital_id',$id)->get();
        return view('admindashboard.main1', compact('staff', 'hospital', 'user'));
    }


 //////////////////////////Staff module controller////////////////////////////

    public function mainpanel($id){



        $staff=HospitalStaff::where('hospital_id',$id)->get();

        return view('admindashboard.main1',  compact('staff'));
    }
    public function addstaff($id){

        $hospital= Hospital::find($id);
        return view('admindashboard.addstaff', compact('hospital'));
    }
    public function poststaff(Request $request, $id)
    {

        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5',
            'user_image'=>'required|mimes:jpeg,png',
            'user_type' => 'required'
//            'staff_documents'=>'required|mimes:jpeg,bmp,png,gif,svg,pdf'
//
        ]);

        $staff = new HospitalStaff();
        $users = new User();
        $hospital_staff_documents = new hospital_staff_document();

        $users->email = $request['email'];

        $hashed = bcrypt($request['password']);
        $users->password = $hashed;
        $users->user_type = $request['user_type'];
//        $staff->is_approved = 1;

        $users->session_id = uniqid();
        $users->is_approved = 1;
        $users->save();
        
        
        
        //////////image Upload///////////////
        $file = $request->file('user_image');
        //dd($file);
        $public_path = 'staff_images/' . uniqid(true);
        $destinationPath = public_path($public_path);
        $filename = $file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $image_path = $public_path . '/' . $filename;
        $staff->user_image = $image_path;

        $staff->hospital_id = $id;
        $staff->first_name = $request['first_name'];
        $staff->last_name = $request['last_name'];
        $staff->user_image = $image_path;
        $staff->user_id = $users->id;
        $staff->user_type = $request['user_type'];
        $staff->save();


       //////////////Documents upload//////////////////////////
        
        //Save First Responder Details
        if($request['user_type'] == 1){
            $responder = new FirstResponderDetail();
            $responder->user_id = $users->id;
            $responder->staff_id = $staff->id;
            $responder->about = $request['about'];
            $responder->address = $request['address'];
            $responder->phone = $request['phone'];
            $responder->certifications = $request['certifications'];
            $responder->business_days = $request['business_days_from'] .' to '.$request['business_days_to'];
            $responder->business_hours = $request['business_hours_from']. ' to '.$request['business_hours_to'];
            $responder->save();
        }


//$hospital_staff_documents->document_path = $request['document_path'];


        $staff_documents = [];
        if ($request->file('staff_documents') != null) {
            foreach ($request->file('staff_documents') as $file) {
                $public_path = '/staff/documents/' . uniqid(true);
                $destinationPath = public_path($public_path);
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $staff_documents[] = [
                    'staff_id' => $staff->id,
                    'document_path' => $public_path . '/' . $filename
                ];
            }
            $hospital_staff_documents=new hospital_staff_document();
            $hospital_staff_documents::insert( $staff_documents);
        }

        Session::flash('message', 'Your data has been successfully submitted');
        return redirect()->back()->withInput(Input::all());



//        }
//       $hospital_staff_documents->document_path=$request['document_path'];
//        return $medical_history_documents;


//        return view('hospitaldashboard.poststaff');

//
//        for($i=0; $i<count($_FILES['file']['name']); $i++)
//
//        {
//        $file = $request->file('document_path');
//        foreach($file as $file)
//        $public_path = 'staff_document/' . uniqid(true);
//        $destinationPath = public_path($public_path);
//        $filename = $file->getClientOriginalName();
//        $file->move($destinationPath, $filename);
//        $document_path = $public_path . '/' . $filename;
//        $staff->document_path = $document_path;
//    }

        }

//        $hospital = \auth()->guard('hospital');

    public function geteditstaff($id){

        $staff = HospitalStaff::where('id',$id)->with('documents')->get();
//        $hospital = new Hospital();
//        $hospital = Hospital::find($id);
//        $hospital = Hospital::find($hospital->id);
//        $hospital = Hospital::find($hospital->user->id);
//      $hospital = Hospital::findOrFail($id);
//        $staff= HospitalStaff::findOrFail($staff->id);
        //$hospital_staff_documents= new hospital_staff_document();
        //$hospital_staff_documents= hospital_staff_document::find($hospital_staff_documents->staff->id);
//        $users= User::findOrFail($staff->id);
//        return $staff;
        return view('hospitaldashboard.editstaff', compact('staff'));
    }
    public function posteditstaff($id, Request $request){

        $this->validate($request, [
            'email' => 'required|email',
//            'user_image'=>'required|mimes:jpeg,png',
//            'staff_documents'=>'mimes:jpeg,bmp,png,gif,svg,pdf'
//            'user_image'=>'required'

        ]);

//        $staff= new HospitalStaff();
//        $users = new User();
//        $users-> email= $request['email'];
////        $hashed = bcrypt($request['password']);
////        $users-> password= $hashed;
////        $users-> user_type= $request['user_type'];
//        $users->session_id= uniqid();
//        $users->save();
//
//
//        $file = $request->file('user_image');
//        //dd($file);
//        $public_path = 'staff_images/' . uniqid(true);
//        $destinationPath = public_path($public_path);
//
//        $filename = $file->getClientOriginalName();
//
//        $file->move($destinationPath, $filename);
//        $image_path = $public_path . '/' . $filename;
//
//        $staff->user_image = $image_path;
//
//        $hospital = \auth()->guard('hospital');
//        $staff->hospital_id = $hospital->user()->id;
//        $staff-> first_name= $request['first_name'];
//        $staff-> last_name= $request['last_name'];
//        $staff->user_image= $image_path;
//        $staff->user_id = $users->id;
////        $staff-> user_type= $request['user_type'];
//        $staff-> save();


        $staff=HospitalStaff::find($id);
        $users=User::find($staff->user_id);

//        $staff=new HospitalStaff();
//        $users = new User();
//        $users= User::findOrFail($staff->hospital->id);
        $users->email= $request['email'];


//        $hashed = bcrypt($request['password']);
//        $users-> password= $hashed;
//        $users = User::where('user_type',$id)->get();
//        $staff->HospitalStaff= Input::get('$id');
//        $users-> user_type= $request['user_type'];
//        $staff->is_approved= 0;
//        $users->session_id= uniqid();
        $users->save();

        $file = $request->file('user_image');
        if($file != null) {
            //dd($file);
            $public_path = 'staff_images/' . uniqid(true);
            $destinationPath = public_path($public_path);
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $image_path = $public_path . '/' . $filename;
            $staff->user_image = $image_path;
            $staff->user_image = $image_path;
        }

//        $staff->hospital_id = $id;
        $staff-> first_name= $request['first_name'];
        $staff-> last_name= $request['last_name'];

//        $staff->user_image = $image_path;
        $staff->user_id = $users->id;
//        $staff = HospitalStaff::where('user_type',$id)->get();
//        $staff->HospitalStaff= Input::get('$id');
//        $staff->user_type=$request['user_type'];

        $staff-> save();

////////////////////Staff Documents Upload///////////////////////


        $staff_documents = [];
        if ($request->file('staff_documents') != null) {
            foreach ($request->file('staff_documents') as $file) {
                $public_path = '/staff/documents/' . uniqid(true);
                $destinationPath = public_path($public_path);
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $staff_documents[] = [
                    'staff_id' => $staff->id,
                    'document_path' => $public_path . '/' . $filename
                ];
            }
            $hospital_staff_documents=new hospital_staff_document();
            $hospital_staff_documents::insert($staff_documents);
        }

        Session::flash('message','Your data has been successfully Updated');
        return redirect() ->back();

//        $users = User::findOrFail($id);
//        $users-> first_name= $request['first_name'];
//        $users-> last_name= $request['last_name'];
//        $users-> user_image= $request['user_image'];
//        $users-> email= $request['email'];
//        $hashed = bcrypt($request['password']);
//        $users-> password= $hashed;
//        $users-> user_type= $request['user_type'];
//
//        $users-> save();

//
//        Session::flash('message','Your data has been successfully updated');
//        return redirect() ->back();

//        return view('hospitaldashboard.editstaff');
    }
         public function deletestaff($id)
         {

        $staffs = HospitalStaff::find($id);
        $users= User::findOrFail($staffs->user->id);
        $staffs->delete();
        $users->delete();

        Session::flash('flash_message', 'Your Data has been successfully deleted!');

//     return redirect()->route('tasks.index');
        return redirect() ->back();
        
}

    public function deletedocument($id)
    {
        $hospital_staff_documents = hospital_staff_document::find($id);
        $hospital_staff_documents->delete();
        Session::flash('flash_message', 'Your Data has been successfully deleted!');
        return redirect() ->back();
    }

}

