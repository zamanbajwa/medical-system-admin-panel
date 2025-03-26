<?php
$current_user = Auth::user();
$current_id = $current_user->id;

$page =  request()->segment(count(request()->segments()));

?>
<header class="mainheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-6 pull-left patient-detail">
               <?php if($page != 'dashboard'){?>
                <a onclick="window.history.back()" href="javascript:void(0)"><img src="<?php echo asset('hospital/images/arrow.png')?>" class="arrow"></a>
                <?php } ?>
            </div>
            <div class="col-md-6 col-sm-4 col-xs-6">
              <a href="#"><img src="<?php echo asset('hospital/images/logo.png')?>" alt="logo" class="logo" /></a>

            </div>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="prfle">
                    <div class="profilelogo">
                      <img src="<?php echo asset('hospital/images/profile.png')?>"/>

                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle logout-profile" type="button" data-toggle="dropdown">Dropdown Example
                            <span class="caret"></span>
                        </button>
                        <ul class="listing">
                          <li><a href="<?php echo asset('/logout');?>">LOG OUT</a></li>
                        </ul>
                    </div>
                </div>    
            </div>
<!--            <div class="col-md-1 img-port">
              <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle logout-profile" type="button" data-toggle="dropdown">Dropdown Example
                      <span class="caret"></span></button>
                      <ul class="listing">
                        <li><a href="<?php echo asset('hospital/login_view');?>">LOG OUT</a></li>
                      </ul>
                </div>
            </div>-->
          </div>
       </div>
     </div>  
   </div>
</header>