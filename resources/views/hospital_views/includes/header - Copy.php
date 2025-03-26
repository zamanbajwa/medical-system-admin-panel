<header class="mainheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 pull-left patient-detail">
                <a href="<?php echo URL::previous();?>"><img src="<?php echo asset('hospital/images/arrow.png')?>" class="arrow"></a>
            </div>
            <div class="col-md-6">
              <a href="#"><img src="<?php echo asset('hospital/images/logo.png')?>" alt="logo" class="logo" /></a>
            </div>
            <div class="col-md-2">
              <div class="profilelogo">
                <img src="<?php echo asset('hospital/images/profile.png')?>"/>
              </div>
            </div>
            <div class="col-md-1 img-port">
              <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle logout-profile" type="button" data-toggle="dropdown">Dropdown Example
                      <span class="caret"></span></button>
                      <ul class="listing">
                        <li><a href="<?php echo asset('hospital/login_view');?>">LOG OUT</a></li>
                      </ul>
                </div>
            </div>
          </div>
       </div>
     </div>  
   </div>
</header>