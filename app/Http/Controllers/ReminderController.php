<?php

namespace App\Http\Controllers;

use App\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ReminderController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $reminder = new Reminder;
        $reminder['patient_id'] = $request->patient_id;
        $reminder['reminder_name'] = $request->reminder_name;
        $reminder['reminder_value'] = $request->reminder_value;//;
        $reminder['reminder_type'] = $request->reminder_type;//;
        $reminder->save();
        return Response::json(array('status' => 'success', 'successData' => $reminder));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function show(Reminder $reminder)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reminder $reminder)
    {
         $remind = Reminder::findOrFail($id);
         $remind->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Reminder $reminder)
    {
        $id = $request->reminder_id;
        $remind = Reminder::findOrFail($id);
        $remind->delete();
        return Response::json(array('status' => 'success', 'successData' => ''));
    }
}
