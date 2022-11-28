<style>
	.langs div {
		display:inline-block;
		
	}
	.langs {
		float:left;
		margin-left:40px;
		
	}
	.langs a{
		color:green;
	}
</style>
<div id="admin" style="">
		<div id="welcome">You are logged in as <strong><?=Yii::app()->user->name; ?></strong></div>

		<div class="extraLinks1">
			<p>
				<div>
						<a href="<?=$this->CreateUrl('/site/addMenu',array('language'=>$lang)); ?>">Add Menu</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/private/register',array('language'=>$lang)); ?>">Add User</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/addItem',array('language'=>$lang)); ?>">Add Item</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/addColor',array('language'=>$lang)); ?>">Add Color</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/addCategory',array('language'=>$lang)); ?>">Add Category</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/addBanner',array('language'=>$lang)); ?>">Add Banner</a>
				</div>

				<div>
						<a href="<?=$this->CreateUrl('/settings/create',array('language'=>$lang)); ?>">Add Setting</a>
				</div>
			</p>
			<p>
				<div>
						<a href="<?=$this->CreateUrl('/site/sitemap',array('language'=>$lang)); ?>">Sitemap</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/alloffers',array('language'=>$lang)); ?>">Offers</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/orders',array('language'=>$lang)); ?>">Orders</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/allitems',array('language'=>$lang)); ?>">Items</a>
				</div>				
				<div>
						<a href="<?=$this->CreateUrl('/private/users',array('language'=>$lang)); ?>">Users</a>
				</div>				
				<div>
						<a href="<?=$this->CreateUrl('/site/allcolors',array('language'=>$lang)); ?>">Colors</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/allcategories',array('language'=>$lang)); ?>">Categories</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/settings/admin',array('language'=>$lang)); ?>">Settings</a>
				</div>
				<div>
						<a href="<?=$this->CreateUrl('/site/logout',array('language'=>$lang)); ?>">Logout</a>
				</div>
			</p>
		</div>
</div>