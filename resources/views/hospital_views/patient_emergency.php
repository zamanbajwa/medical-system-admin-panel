<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/header.php'; ?>
        <section class="patient-portfolio">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="portf-detail">
                            <?php
                            $user_image = isset($patient_detail->patientInfo->user_image)?asset($patient_detail->patientInfo->user_image):'';

                           $firstname =  isset($patient_detail->patientInfo->first_name) ? $patient_detail->patientInfo->first_name : '-';

                           $lastname =  isset($patient_detail->patientInfo->last_name) ? $patient_detail->patientInfo->last_name : '-';

                           $UID = isset($patient_detail->patientInfo->user_id)?$patient_detail->patientInfo->user_id:'';

                           $phone = isset($patient_detail->patientInfo->phone_number)?$patient_detail->patientInfo->phone_number:'';
                           
                           $address = isset($patient_detail->patientInfo->location)?$patient_detail->patientInfo->location:'';
                           $city = isset($patient_detail->patientInfo->city)?$patient_detail->patientInfo->city:'';
                           $street = isset($patient_detail->patientInfo->street)?$patient_detail->patientInfo->street:'';
                           $state = isset($patient_detail->patientInfo->state)?$patient_detail->patientInfo->state:'';
                           $age = isset($patient_detail->patientInfo->age)?$patient_detail->patientInfo->age:'';
                           $blood = isset($patient_detail->patientInfo->blood_type)?$patient_detail->patientInfo->blood_type:'';
                           $gender = isset($patient_detail->patientInfo->gender)?$patient_detail->patientInfo->gender:'';
                           $dlnumber = isset($patient_detail->patientInfo->dl_number)?$patient_detail->patientInfo->dl_number:'N/A';
                           $dnr = isset($patient_detail->patientInfo->dnr)?$patient_detail->patientInfo->dnr:'NO';

                            ?>
                            
                            <img src="<?php echo asset($user_image)?>" class="center-block">
                            <h2><?=$firstname.' '.$lastname?></h2>
                            <p><?=$city.', '.$street.', '.$state?></p>
                            <ul>
                                <li>
                                    <h2>Age</h2>
                                    <p><?=$age?><sub>year</sub></p>
                                </li>
                                <li>
                                    <h2>Blood</h2>
                                    <p><?=$blood?></p>
                                </li>
                                <li>
                                    <h2>Gender</h2>
                                    <p><?=$gender?></p>
                                </li>
                                <li>
                                    <h2>DL Number</h2>
                                    <p><?=$dlnumber?></p>
                                </li>
                                <li>
                                    <h2>State</h2>
                                    <p><?=$state?></p>
                                </li>
                                <li>
                                    <h2>DNR</h2>
                                    <p><?=$dnr?></sub></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="patient-links">
                            <div class="patient-will">
                                <div class="patient-box">
                                    <a href="#." data-toggle="modal" data-target="#myModal" onclick="patientDetail('will')">
                                    <img src="<?php echo asset('hospital/images/patients-detail1_03.png')?>" class="center-block" />
                                    <h3>Patient Will</h3>
                                    </a>
                                </div>
                            </div>
                            <div class="patient-will">
                                <a href="#." onclick="patientDetail('doctors')" data-toggle="modal" data-target="#myModal">
                                <div class="patient-box">
                                    <img src="<?php echo asset('hospital/images/patients-detail1_04.png')?>" class="center-block" />
                                    <h3>Previous Doctors</h3>
                                </div>
                            </a>
                            </div>
                            <div class="patient-will">
                                <a href="#." onclick="patientDetail('Insurance')" data-toggle="modal" data-target="#myModal">
                                <div class="patient-box">
                                    <img src="<?php echo asset('hospital/images/patients-detail1_07.png')?>" class="center-block" />
                                    <h3>Insurance</h3>
                                </div>
                            </a>
                            </div>
                            <div class="patient-will">
                                <a href="#." onclick="patientDetail('emergency')" data-toggle="modal" data-target="#myModal">
                                <div class="patient-box">
                                    <img src="<?php echo asset('hospital/images/patients-detail1_12.png')?>" class="center-block" />
                                    <h3>Emergency Contact</h3>
                                </div>
                            </a>
                            </div>
                            <div class="patient-will">
                                <a href="#." onclick="patientDetail('history')" data-toggle="modal" data-target="#myModal">
                                <div class="patient-box">
                                    <img src="<?php echo asset('hospital/images/patients-detail1_13.png')?>" class="center-block" />
                                    <h3>Medical History</h3>
                                </div>
                            </a>
                            </div>
                            <div class="patient-will">
                                <a href="#." onclick="patientDetail('documents')" data-toggle="modal" data-target="#myModal">
                                <div class="patient-box">
                                    <img src="<?php echo asset('hospital/images/patients-detail1_14.png')?>" class="center-block" />
                                    <h3>Medical Document</h3>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalheader">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                    <p id="modalcontent">This is a small modal.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

        </section>
        <section class="maps">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="map" id="map">
                          <!--<iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3197.503326254655!2d-119.4954486854201!3d36.73448797996218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8094ff3eca994039%3A0x1c303f117d41342f!2s16357+E+Trimmer+Springs+Rd%2C+Sanger%2C+CA+93657!5e0!3m2!1sen!2s!4v1527538170974" width="" height="" frameborder="0" allowfullscreen="allowfullscreen"></iframe>-->
                        </div>
                        <div class="johnsmith">
                            <div class="johncontact">
                                <div class="map-contact">
                        <?php

                           $user_image = isset($patient_detail->hospitalRespoder->user_image)?asset($patient_detail->hospitalRespoder->user_image):'';

                           $firstname =  isset($patient_detail->hospitalRespoder->first_name) ? $patient_detail->hospitalRespoder->first_name : '-';

                           $lastname =  isset($patient_detail->hospitalRespoder->last_name) ? $patient_detail->hospitalRespoder->last_name : '-';
                           $about =  isset($patient_detail->responderInfo->about) ? $patient_detail->responderInfo->about : '-';
                           $address =  isset($patient_detail->responderInfo->address) ? $patient_detail->responderInfo->address : '-';
                           $phone =  isset($patient_detail->responderInfo->phone) ? $patient_detail->responderInfo->phone : '-';
                           $certifications =  isset($patient_detail->responderInfo->certifications) ? $patient_detail->responderInfo->certifications : '-';
                           $business_hours =  isset($patient_detail->responderInfo->business_hours) ? $patient_detail->responderInfo->business_hours : '-';

                        ?>
                                    <div class="contact-name">
                                        <img src="<?php echo asset($user_image)?>" class="center-block"/>
                                        <h4><?=$firstname.' '.$lastname?></h4>
                                        <p>First Responder</p>
                                    </div>
                                    <div class="contact-content">
                                        <h2>About</h2>
                                        <p>
                                            <?=$about?>
                                        </p>
                                    </div>
                                    <div class="contact-content">
                                        <h2>Address & Timing</h2>
                                        <p><?=$address?></p>
                                        <p><?=$business_hours?>, Monday to Friday</p>
                                    </div>
                                    <div class="contact-content">
                                        <h2>Phone</h2>
                                        <p><?=$phone?></p>
                                    </div>
                                    <div class="contact-content">
                                        <h2>Certificate</h2>
                                        <?php
                                        if (isset($certifications) && ($certifications!='')) {
                                            $cert = explode(',', $certifications);
                                            foreach ($cert as $key => $value) {
                                                echo $value.'<br />';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="contact-button">
                                    <ul>
                                        <li><img src="<?php echo asset('hospital/images/phone.png')?>" class="center-block" /></li>
                                        <li id="msgbox"> <img src="<?php echo asset('hospital/images/messsage.png')?>" class="center-block" /></li>
                                    </ul>
                                </div>
                            </div>
                            <i class="fa fa-close pull-right" style="font-size:24px"></i>
                            <iframe src="<?php echo asset('hospital/message-detail/'.$patient_detail->respondent_id)?>" class="messageframe"></iframe>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
         <script type="text/javascript">
            var APP_URL = <?php echo json_encode(url('/'));?>
        </script>
        <script src="<?php echo asset('hospital/js/jquery.js')?>"></script>
        <script src="<?php echo asset('hospital/js/bootstrap.min.js')?>"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
        <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA7l5RqKcybbGrvSVnI2siEFFuv-VqkuZY"></script>
        
        <?php $hospital_location = getHospitalLatLng($current_id)?>
        
        <script type="text/javascript">
        current_id = <?= $current_id ?>;
        socket.on('send_responder_location', function (data) {
            console.log(data);
            console.log(current_id);

            if (data.user_id == current_id ) {

                
                
            }
        });
        
        </script>
        
        
        <script type="text/javascript">
        
        function mapLocation() {
            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();
            var map;

            function initialize() {
                directionsDisplay = new google.maps.DirectionsRenderer();
                var chicago = new google.maps.LatLng(37.334818, -121.884886);
                var mapOptions = {
                    zoom: 7,
                    center: chicago
                };
                map = new google.maps.Map(document.getElementById('map'), mapOptions);
                directionsDisplay.setMap(map);
//                google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);
                calcRoute();
            }

            function calcRoute() {
                var start = new google.maps.LatLng(<?= $patient_detail->lat; ?>, <?= $patient_detail->lng; ?>);
                //var end = new google.maps.LatLng(38.334818, -181.884886);
//                var end = new google.maps.LatLng(37.441883, -122.143019);
                var end = new google.maps.LatLng(<?= $hospital_location['lat']; ?>, <?= $hospital_location['lng']; ?>);
                /*
        var startMarker = new google.maps.Marker({
                    position: start,
                    map: map,
                    draggable: true
                });
                var endMarker = new google.maps.Marker({
                    position: end,
                    map: map,
                    draggable: true
                });
        */
                var bounds = new google.maps.LatLngBounds();
                bounds.extend(start);
                bounds.extend(end);
                map.fitBounds(bounds);
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        directionsDisplay.setMap(map);
                    } else {
                        alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                    }
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        };
//        mapLocation();
        </script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                
                mapLocation();
                
                $('#msgbox').click(function () {
                    $('.messageframe').fadeIn('slow');
                });
                $('i.fa.fa-close').click(function () {
                   $('.messageframe').fadeOut('slow');
                });

                 if (window.matchMedia('(max-width: 767px)').matches) {
                     
                       $('#msgbox').click(function () {
                        $('.johncontact').fadeOut('slow');
                    });
                    } else {
                        $('i.fa.fa-close').click(function () {
                            $('..johncontact').fadeIn('slow');
                        });
                    }
            });

            function patientDetail(value) {
                var header = '';
                var id = "<?=$patient_detail->patient_id;?>";
                switch(value) {
                    case 'emergency':
                        header = 'Emergency Contact';
                        break;
                    case 'will':
                        header = 'Patient Will';
                        break;
                    case 'doctors':
                        header = 'Previous Doctors';
                        break;
                    case 'Insurance':
                        header = 'Insurance';
                        break;
                    case 'history':
                        header = 'Medical History';
                        break;
                    case 'documents':
                        header = 'Medical Document';
                        break;
                }
                $('#modalheader').html(header);

                $.ajax({
                        type: "POST",
                        url: APP_URL+'/patient_detail',
                        data: {patient_id: id,type:value},
                        success: function(data) {
                            var result='';
                            if (value=='will' && data!='') {
                                result = data.successData.patient_will.description;
                            } else if(value=='emergency' && data!=''){
                                 result+= 'Name : '+data.successData.patient_emergency.name+'<br />';
                                 result+= 'Relation : '+data.successData.patient_emergency.contact_relation+'<br />';
                                 result+= 'Contact 1 : '+data.successData.patient_emergency.phone_1+'<br />';
                                 result+= 'Contact 2 : '+data.successData.patient_emergency.phone_2+'<br />';
                                 result+= 'Address : '+data.successData.patient_emergency.address+'<br />';
                            } else if(value=='doctors'){
                                result = data.successData.reference_doctor;
                            } else if(value=='Insurance'){
                                result = data.successData.insurance;
                            } else if(value=='documents'){
                                result = data.successData.documents;
                            } else if(value=='history'){
                                result = data.successData.history;
                            }
                            $('#modalcontent').html(result);
                        }
                });

            }
        </script>
        <script>

            function bs_input_file() {
                $(".input-file").before(
                    function () {
                        if (!$(this).prev().hasClass('input-ghost')) {
                            var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                            element.attr("name", $(this).attr("name"));
                            element.change(function () {
                                element.next(element).find('input').val((element.val()).split('\\').pop());
                            });
                            $(this).find("button.btn-choose").click(function () {
                                element.click();
                            });
                            $(this).find("button.btn-reset").click(function () {
                                element.val(null);
                                $(this).parents(".input-file").find('input').val('');
                            });
                            $(this).find('input').css("cursor", "pointer");
                            $(this).find('input').mousedown(function () {
                                $(this).parents('.input-file').prev().click();
                                return false;
                            });
                            return element;
                        }
                    }
                );
            }
            $(function () {
                bs_input_file();
            });
        </script>

    </body>
</html>