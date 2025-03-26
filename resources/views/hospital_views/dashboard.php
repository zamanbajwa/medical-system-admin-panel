<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/header.php'; ?>
        <style type="text/css">
            .ui-autocomplete {
                    width: 600px;
                    text-align: center;
                    background-color: rgb(132, 201, 203);
            }
        </style>
        <div class="main_screen">
            <h2>EMS NAME AND ORGANIZATION <span>HERE HELLO Paul Matlock</span> <span>EMT</span> OLYMPUS Transport Services</h2>
            <form action="#">
                <fieldset>
                    <input type="search" id="myautocomplete" placeholder="Please enter User's ID to search for the patient">
                    <button type="submit"><img src="<?php echo asset('hospital/images/search_icon.png');?>"></button>
                </fieldset>
            </form>
            <ul class="new_boxes">
                <li class="active">

                    <a data-toggle="modal" data-target="#myModal" href="javascript:void(0)" class="box_holder">
                        <img src="<?php echo asset('hospital/images/patients-detail-new.png');?>">
                        <strong>Add Patient</strong>
                        <p>Local Emergency</p>
                    </a>
                </li>
                <li>
                <a href="<?php echo asset('/hospital/get_patient_analytics');?>" class="box_holder">
                        <img src="<?php echo asset('hospital/images/patients-detail-new.png');?>">
                        <strong>View Patient Analytics</strong>
                        <p>See Details</p>
                    </a>
                </li>
                <li>
                <a href="#" class="box_holder">
                        <img src="<?php echo asset('hospital/images/patients-detail-new.png');?>">
                        <strong>Find Nearest Hosp</strong>
                        <p>See Details</p>
</a>
                </li>
            </ul>
        </div>

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modalheader">Add Emergency Form</h4>
        </div>
        <div class="modal-body">
          <form action="#" class="new_custom_form">
            <h2>Add Emergency Form</h2>
            <fieldset>
                <div class="custom_fields_holder">
                    <input type="text" placeholder="Condition">
                    <input type="text" placeholder="Patient Name">
                    <input type="text" placeholder="Address">
                    <input type="tel" placeholder="Contact No">
                    <input type="text" placeholder="BP">
                    <input type="text" placeholder="HEART">
                    <input type="text" placeholder="Temp">
                    <input type="text" placeholder="P/OX">
                    <input type="text" placeholder="Illness">
                    <input type="submit" value="Add Report">
                </div>
            </fieldset>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

         <script src="<?php echo asset('hospital/js/jquery.js')?>"></script>
        <script src="<?php echo asset('hospital/js/fastclick.js')?>"></script>
        <script src="<?php echo asset('hospital/js/jquery.nice-select.min.js')?>"></script>
        <script src="<?php echo asset('hospital/js/bootstrap.min.js')?>"></script>

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

        <script type="text/javascript">

                $( "#myautocomplete" ).autocomplete({
                      source:  "<?php echo asset('/hospital/get_patients');?>?term=" + $("#myautocomplete").val(),
                      minLength: 3,
                      select: function(event, ui) {
                        //$('#myautocomplete').val(ui.item.value);
                      
                        window.location.href = "<?php echo asset('/hospital/get_patient');?>/" + ui.item.id;
                      }
                });
            
         </script>
    </body>
</html>