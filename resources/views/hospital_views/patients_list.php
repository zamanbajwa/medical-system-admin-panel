<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/header.php'; ?>
         <section class="patient-lists">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 patient-lists-item">
                        <h2>All Patients</h2>
                        <ul class="patient-table table-head">
                            <li>Patient</li>
                            <li>BP</li>
                            <li>HEART</li>
                            <li>temp</li>
                            <li>p/ox</li>
                            <li>illness</li>
                            <li>Distance miles</li>
                            <li>ETA</li>
                            <li>STATUS</li>
                        </ul>
                        <?php foreach($patients as $patient){
                                
                            //echo "<pre>"; print_r($patient); die;
                            ?>
                        <ul class="patient-table">
                            <li class="pathead" data-text="Patient">
                                <?php 
                                $user_image = isset($patient->patientInfo->user_image)?asset($patient->patientInfo->user_image):'';

                                $fname = isset($patient->patientInfo->first_name)?$patient->patientInfo->first_name:'';
                                $lname = isset($patient->patientInfo->last_name)?$patient->patientInfo->last_name:'';
                                $UID = isset($patient->patientInfo->thumb_id)?$patient->patientInfo->thumb_id:'';

                                ?>
                                <img src="<?php echo $user_image?>" alt="profile" />
                                <a href="<?php echo asset('/hospital/get_patient/'.$patient->patient_id);?>">
                                    <p><?=$fname.' '.$lname?><br/>
                                    <span class="id">ID</span><span class="color">: <?=$UID?></span></p>
                                </a>
                            </li>
                            <?php //die();?>
                            <li class="patbp" data-text="BP"> <?=isset($patient->patientInfo->medicalHistory[0]->bp) ? $patient->patientInfo->medicalHistory[0]->bp : 'Not Available';?></li>
                            <li class="patheart" data-text="HEART"> <?=isset($patient->patientInfo->medicalHistory[0]->heart_rate) ? $patient->patientInfo->medicalHistory[0]->heart_rate : 'Not Available';?> </li>
                            <li class="pattemp" data-text="temp"> <?=isset($patient->patientInfo->medicalHistory[0]->temperature) ? $patient->patientInfo->medicalHistory[0]->temperature : 'Not Available';?></li>
                            <li class="patpx" data-text="p/ox"><?=isset($patient->patientInfo->medicalHistory[0]->ox) ? $patient->patientInfo->medicalHistory[0]->ox:'Not Available';?>%</li>
                            <li class="patillness" data-text="illness"><?=isset($patient->patientInfo->medicalHistory[0]->illness_name) ? $patient->patientInfo->medicalHistory[0]->illness_name:'Not Available';?></li>
                            <li class="color patmile" data-text="Distance miles"><?=isset($patient->distance) ? round($patient->distance):'Not Available';?></li>
                            <li class="color pateta" data-text="ETA">15min</li>
                            <li class="patstatus" data-text="STATUS" style="padding-top: 20px;">
                                <a href="<?php echo asset('/hospital/get_patient_emergency/'.$patient->id);?>" class="active">
                                   <?=isset($patient->status) && $patient->status==1 ? 'Active':'Delivered';?>
                                </a></li>
                        </ul>
                        <?php } ?>

                    </div>
                </div>
                <?php echo $patients->links();?>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        

    </body>
</html>