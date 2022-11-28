<div class="headerbar">
      
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      
      
      
      <div class="header-right">
        <ul class="headermenu">
         <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                  <img src="/mfe/template/images/photos/loggeduser.png" alt="">
                <?=Yii::app()->user->name;?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right" role="menu">
                <li><a href="<?=$this->createUrl('private/settings');?>"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                <li><a href="<?=$this->createUrl('site/logout');?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->
      
</div>