<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/header.php'; ?>
        <?php if(isset($patient_detail)){?>
        <section class="patient-detail">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Patient Detail</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="patientid">
                            <?php
                            $user_image = isset($patient_detail->user_image)?asset($patient_detail->user_image):'';

                           $firstname =  isset($patient_detail->first_name) ? $patient_detail->first_name : '-';

                           $lastname =  isset($patient_detail->last_name) ? $patient_detail->last_name : '-';

                           $UID = isset($patient_detail->user_id)?$patient_detail->user_id:'';

                           $phone = isset($patient_detail->phone_number)?$patient_detail->phone_number:'';
                           
                           $address = isset($patient_detail->location)?$patient_detail->location:'';
                           $city = isset($patient_detail->city)?$patient_detail->city:'';
                           $street = isset($patient_detail->street)?$patient_detail->street:'';
                           $state = isset($patient_detail->state)?$patient_detail->state:'';

                            ?>
                         <img src="<?php echo $user_image;?>"/>
                            <h3> <?=$firstname.' '.$lastname?> </h3>
                            <p>ID: <span><?=$UID?></span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="print-items">
                            <span> SCHEDULING </span>
                            <div class="box">
                                <select>
                                    <option>Surgery Department</option>
                                    <option>Imaging Department</option>
                                    <option>Emergency Room</option>
                                    <option>Surgery Department</option>
                                    <option>Intensive Care Unit</option>
                                    <option>Laboratory</option>
                                    <option>Radiology</option>
                                </select>
                            </div>  
                            <button class="summmary">Print Summmary</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="patertn-detail">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Address</h3>
                            <ul>
                                <li> <?=$city?></li>
                                <li> <?=$street?></li>
                                <li> <?=$state?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Phone</h3>
                            <ul>
                                <li>Home Phone: <?=$phone?></li>
                                <li> Work Phone:   <?=$phone?></li>
                            </ul>
                        </div>
                    </div>

                    <?php
                    /*Insurance module start here*/

                    $policy_number = isset($patient_detail->patientInsurance->policy_number)?$patient_detail->patientInsurance->policy_number:'N/A';
                    $carrier_number = isset($patient_detail->patientInsurance->carrier_number)?$patient_detail->patientInsurance->carrier_number:'N/A';
                    $category = isset($patient_detail->patientInsurance->category)?$patient_detail->patientInsurance->category:'N/A';
                    $expiry_date = isset($patient_detail->patientInsurance->expiry_date)?$patient_detail->patientInsurance->expiry_date:'N/A';
                    $providers = isset($patient_detail->patientInsurance->providers)?$patient_detail->patientInsurance->providers:'N/A';
                    $insurance_pcp = isset($patient_detail->patientInsurance->insurance_pcp)?$patient_detail->patientInsurance->insurance_pcp:'N/A';
                    $insurance_pharmacy = isset($patient_detail->patientInsurance->insurance_pharmacy)?$patient_detail->patientInsurance->insurance_pharmacy:'N/A';

                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Demographics Insurance</h3>
                            <ul>
                                <li>Policy Number: <?=$policy_number?>   </li>
                                <li>Carrier Number:  <?=$carrier_number?></li>
                                <li> Category:  <?=$category?></li>
                                <li> Expiry date:  <?=$expiry_date?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Providers</h3>
                            <ul>
                                <li><?=$providers?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Insurance PCP</h3>
                            <ul>
                                <li><?=$insurance_pcp?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Pharmacy </h3>
                            <ul>
                                <li> <?=$insurance_pharmacy?>  </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if(isset($patient_detail->patientReminder)){?>
                   <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3><span>Alert</span> <a onclick="setRemiderVal(1)" href="javascript:void(0)" data-toggle="modal" data-target="#modalSubscriptionForm">Add</a></h3>
                            <ul>
                                <?php foreach($patient_detail->patientReminder as $reminder){
                                    if ($reminder->reminder_type==1) { ?>

                                    <li><?=$reminder->reminder_name?> : <?=$reminder->reminder_value?>
                                        <span onclick="deleteReminder(<?=$reminder->id?>)" style="color: red; font-size: 12px; cursor: pointer;" class="glyphicon glyphicon-trash"></span>
                                    </li>

                                <?php } 
                            } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Reminders  <a onclick="setRemiderVal(2)" href="javascript:void(0)" data-toggle="modal" data-target="#modalSubscriptionForm">Add</a>.</h3>
                            <ul>
                                <?php foreach($patient_detail->patientReminder as $reminder){
                                    if ($reminder->reminder_type==2) { ?>

                                    <li><?=$reminder->reminder_name?> : <?=$reminder->reminder_value?>
                                        <span onclick="deleteReminder(<?=$reminder->id?>)" style="color: red; font-size: 12px; cursor: pointer;" class="glyphicon glyphicon-trash"></span>
                                    </li>
                                    
                                <?php } 
                            } ?>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>To Do List <a onclick="setRemiderVal(3)" href="javascript:void(0)" data-toggle="modal" data-target="#modalSubscriptionForm">Add</a></h3>
                            <ul>
                                <?php foreach($patient_detail->patientReminder as $reminder){
                                    if ($reminder->reminder_type==3) { ?>

                                    <li><?=$reminder->reminder_name?> : <?=$reminder->reminder_value?>
                                        <span onclick="deleteReminder(<?=$reminder->id?>)" style="color: red; font-size: 12px; cursor: pointer;" class="glyphicon glyphicon-trash"></span>
                                    </li>
                                    
                                <?php } 
                            } ?>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>To Report Patient deceased<a onclick="setRemiderVal(4)" href="javascript:void(0)" data-toggle="modal" data-target="#modalSubscriptionForm"> Add</a></h3>
                           <ul>
                                <?php foreach($patient_detail->patientReminder as $reminder){
                                    if ($reminder->reminder_type==4) { ?>

                                    <li><?=$reminder->reminder_name?> : <?=$reminder->reminder_value?>
                                        <span onclick="deleteReminder(<?=$reminder->id?>)" style="color: red; font-size: 12px; cursor: pointer;" class="glyphicon glyphicon-trash"></span>
                                    </li>
                                    
                                <?php } 
                            } ?>
                               
                            </ul>
                        </div>
                    </div>
                    <?php } else { ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>No Reminder</h3>
                          
                        </div>
                    </div>
                    <?php  } ?>


                   
                </div>
            </div>

        <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Reminder</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="alert" action="<?=action('ReminderController@store')?>" method="post">
                    <?=csrf_field()?>                    
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <input type="hidden" name="patient_id" id="patient_id" value="<?=$patient_detail->id?>">
                            <input type="hidden" name="reminder_type" id="reminder_type" value="">
                            <input type="text" id="reminder_name" name="reminder_name" class="form-control validate">
                            <label data-error="wrong" data-success="right" for="reminder_name">Reminder Title</label>
                        </div>

                        <div class="md-form mb-4">
                            <input type="text" id="reminder_value" name="reminder_value" class="form-control validate">
                            <label data-error="wrong"  data-success="right" for="reminder_value">Reminder About</label>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-indigo">Save <i class="fa fa-paper-plane-o ml-1"></i></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } else {?>
         <section class="patertn-detail">
            <div class="container-fluid">
                <div class="row" style="text-align: center;">
                    <div class="col-md-12 col-sm-6 col-xs-12">
                        <div>
                            <h3 >No Record Found</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       <?php }?>

        </section>
        <script src="<?php echo asset('hospital/js/jquery.js')?>"></script>
        <script src="<?php echo asset('hospital/js/fastclick.js')?>"></script>
        <script src="<?php echo asset('hospital/js/jquery.nice-select.min.js')?>"></script>
        <script src="<?php echo asset('hospital/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript">
            var APP_URL = <?php echo json_encode(url('/'));?>
        </script>
        <script>
                function setRemiderVal(id) {

                    $('#reminder_type').val(id);

                }

                function deleteReminder(id){
                    $.ajax({
                        type: "POST",
                        url: APP_URL+'/reminder_delete',
                        data: {reminder_id: id},
                        success: function( msg ) {
                            location.reload();
                            //console.log(msg);
                        }
                    });
                }
            $(document).ready(function () {

                
                $('select:not(.ignore)').niceSelect();
                FastClick.attach(document.body);


                $('#alert').on('submit', function (e) {
                    e.preventDefault();
                    var reminder_name = $('#reminder_name').val();
                    var reminder_value = $('#reminder_value').val();
                    var patient_id = $('#patient_id').val();
                    var reminder_type = $('#reminder_type').val();
                    $.ajax({
                        type: "POST",
                        url: APP_URL+'/reminder',
                        data: {reminder_name: reminder_name, reminder_value: reminder_value, patient_id: patient_id,reminder_type:reminder_type},
                        success: function( msg ) {
                            location.reload();
                            //console.log(msg);
                        }
                    });
                });

            });
        </script>
    </body>
</html>