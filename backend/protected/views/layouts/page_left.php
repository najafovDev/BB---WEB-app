
<div class="logopanel">
    <h1>DAVAM</h1>
</div>

<div class="leftpanelinner">

        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media userlogged">
                <img alt="" src="/mfe/template/images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4>John Doe</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>

            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="<?=$this->createUrl('private/settings');?>"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="<?=$this->createUrl('private/logout');?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>

      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket sidebaritems">
        <li class=""><a data-module="content" href="<?=$this->createUrl('members/admin');?>"><i class="glyphicon-globe glyphicon"></i> <span>Members List</span></a></li>
        <li class=""><a ajax-enabled=1  jstree-changeparent="<?=$this->createUrl('menus/changeParent');?>" jstree-getaction="<?=$this->createUrl('menus/getActions');?>" jstree-createchild='<?=$this->createUrl('menus/create',array('language'=>$this->Lang));?>' module-href="<?=$this->createUrl('menus/getTree');?>" data-module="Menus" href="<?=$this->createUrl('menus/getTree');?>"><i class="glyphicon-heart-empty glyphicon  "></i> <span class="">Content</span></a></li>
        <li class=""><a data-module="banners" href="<?=$this->createUrl('banners/admin');?>"><i class="fa-picture-o fa"></i> <span>Banners</span></a></li>
        <li class=""><a data-module="brands" href="<?=$this->createUrl('brands/admin');?>"><i class="fa-user fa"></i> <span>Authors</span></a></li>
        <li class=""><a ajax-enabled=1  jstree-changeparent="<?=$this->createUrl('category/changeParent');?>" jstree-getaction="<?=$this->createUrl('category/getActions');?>" jstree-createchild='<?=$this->createUrl('category/create',array('language'=>$this->Lang));?>' module-href="<?=$this->createUrl('category/getTree');?>" data-module="Category" href="<?=$this->createUrl('category/getTree');?>"><i class="fa-ellipsis-v fa"></i> <span>Categories</span></a></li>
        <!--<li class=""><a  data-module="content" href="<?=$this->createUrl('ShopOrder/admin');?>"><i class="fa-barcode fa"></i> <span>Orders</span></a></li>-->
        <!--<li class=""><a  data-module="content" href="<?=$this->createUrl('districts/admin');?>"><i class="fa-barcode fa"></i> <span>Districts</span></a></li>-->
        <li class=""><a  data-module="content" href="<?=$this->createUrl('colors/admin');?>"><i class="fa-barcode fa"></i> <span>Colors</span></a></li>
        <li class=""><a  data-module="content" href="<?=$this->createUrl('items/admin');?>"><i class="fa-barcode fa"></i> <span>Items</span></a></li>
        <!--<li class=""><a  data-module="content" href="<?=$this->createUrl('customers/admin');?>"><i class="fa-barcode fa"></i> <span>Customers</span></a></li>-->
        <li class=""><a  href="<?=$this->createUrl('sourceMessage/admin');?>"><i class="glyphicon-globe glyphicon"></i> <span>Translations</span></a></li>
        <!--<li class=""><a data-module="content" href="#"><i class="fa fa-users"></i> <span>Users</span></a></li>-->
        <li class=""><a data-module="content" href="<?=$this->createUrl('settings/admin');?>"><i class="fa fa-gear"></i> <span>Settings</span></a></li>
        <li class=""><a data-module="content" href="<?=$this->createUrl('imageSizes/admin');?>"><i class="fa fa-qrcode"></i> <span>Thumbnail Sizes</span></a></li>
      </ul>


    </div>
