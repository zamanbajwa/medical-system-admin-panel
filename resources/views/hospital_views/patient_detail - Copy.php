<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/header.php'; ?>
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
                            <img src="<?php echo asset('hospital/images/profile.png')?>"/>
                            <h3> Abubakar Butt </h3>
                            <p>ID: <span>6655846</span></p>
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
                            <h3>Phone</h3>
                            <ul>
                                <li> Street: 1 ELM Street</li>
                                <li>  City:READVILLE,MA,US 02136 </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Phone</h3>
                            <ul>
                                <li>Home Phone: 617-964-0989</li>
                                <li> Work Phone:   617-964-6681</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Demographics Insurance</h3>
                            <ul>
                                <li>Regular: CIGNA HMO/POS   </li>
                                <li>Regular:   MMIS MASSHEALTH/ SECONDARY TO OTHER INSURANCE</li>
                                <li> MEDICARE:  Health Net Orange</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Demographics Insurance</h3>
                            <ul>
                                <li>No health care proxy chosen info not offered.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Providers</h3>
                            <ul>
                                <li>Primary Provider: Snow, kenneth J.MD </li>
                                <li>  Transplant:Sands, Daniel Z. MD,MPH </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Insurance PCP</h3>
                            <ul>
                                <li>   ZPCP </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Pharmacy </h3>
                            <ul>
                                <li> Pharmacy  </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Pharmacy </h3>
                            <ul>
                                <li>  Needham</li>
                                <li> Atrius EpicWeb</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Phone</h3>
                            <ul>
                                <li>Street: 1 ELM Street </li>
                                <li> City:READVILLE,MA,US 02136</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Phone</h3>
                            <ul>
                                <li> Home Phone: 617-964-0989 </li>
                                <li>  Work Phone:   617-964-6681</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Demographics Insurance</h3>
                            <ul>
                                <li> Regular: CIGNA HMO/POS    </li>
                                <li>Regular:   MMIS MASSHEALTH/ SECONDARY TO OTHER INSURANCE</li>
                                <li>  MEDICARE:  Health Net Orange</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="contast">
                            <h3>Demographics Insurance</h3>
                            <ul>
                                <li> No health care proxy chosen info not offered.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/jquery.js"></script>
        <script src="js/fastclick.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script>
            $(document).ready(function () {
                $('select:not(.ignore)').niceSelect();
                FastClick.attach(document.body);
            });
        </script>
    </body>
</html>