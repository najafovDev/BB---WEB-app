<?php

class m140805_114948_initial extends CDbMigration
{
        public function up()
        {
            $this->createTable('Message', array(
                'id'=>'int(11) NOT NULL',
                'language'=>'varchar(16) NOT NULL',
                'translation'=>'text DEFAULT NULL',
                'fid'=>'pk',
            ), '');

            $this->createTable('ShopOrder', array(
                'order_id'=>'pk',
                'customer_id'=>'int(11) NOT NULL',
                'ordering_date'=>'timestamp NOT NULL',
                'ordering_done'=>'tinyint(1) DEFAULT NULL',
                'ordering_confirmed'=>'tinyint(1) DEFAULT NULL',
                'shipped'=>'int(11) NOT NULL',
                'finished'=>'int(11) NOT NULL',
                'cancelled'=>'int(11) NOT NULL',
                'transaction_id'=>'varchar(255) DEFAULT NULL',
                'shipping_fee'=>'float NOT NULL',
                'shipping_name'=>'varchar(255) NOT NULL',
                'shipping_surname'=>'varchar(255) NOT NULL',
                'address'=>'varchar(255) NOT NULL',
                'email'=>'varchar(255) NOT NULL',
                'phone'=>'varchar(255) NOT NULL',
                'message'=>'varchar(255) DEFAULT NULL',
                'payment_method'=>'varchar(255) DEFAULT NULL',
                'ip'=>'varchar(255) NOT NULL',
            ), '');

            $this->createTable('ShopProductOrder', array(
                'order_id'=>'int(11) NOT NULL',
                'product_id'=>'int(11) NOT NULL',
                'product_shipped'=>'tinyint(1) DEFAULT NULL',
                'product_arrived'=>'tinyint(1) DEFAULT NULL',
                'name'=>'varchar(255) DEFAULT NULL',
                'body'=>'varchar(255) DEFAULT NULL',
                'size'=>'varchar(255) DEFAULT NULL',
                'amount'=>'float NOT NULL',
                'quantity'=>'int(11) DEFAULT NULL',
                'pic_name'=>'varchar(255) DEFAULT NULL',
            ), '');

            $this->addPrimaryKey('pk_ShopProductOrder', 'ShopProductOrder', 'order_id,product_id');

            $this->createTable('SourceMessage', array(
                'id'=>'pk',
                'category'=>'varchar(32) NOT NULL',
                'message'=>'text NOT NULL',
            ), '');

            $this->createTable('album', array(
                'id'=>'pk',
                'pic_name'=>'varchar(255) NOT NULL',
                'name'=>'varchar(255) NOT NULL',
                'date'=>'timestamp NOT NULL',
                'type'=>'enum(\'video\',\'photo\') NOT NULL',
                'video'=>'varchar(255) NOT NULL',
            ), '');

            $this->createTable('articles', array(
                'id'=>'pk',
                'parent_id'=>'int(11) NOT NULL',
                'sort'=>'int(11) NOT NULL',
                'carousel'=>'tinyint(1) NOT NULL',
                'pic_name'=>'varchar(255) DEFAULT NULL',
                'file_name'=>'varchar(255) DEFAULT NULL',
                'type'=>'varchar(255) NOT NULL DEFAULT \'static\'',
                'menucontent'=>'tinyint(1) NOT NULL',
                'front'=>'tinyint(1) NOT NULL',
                'right'=>'tinyint(1) NOT NULL',
                'date'=>'timestamp NOT NULL',
            ), '');

            $this->createTable('articles_translate', array(
                'id'=>'pk',
                'articles_id'=>'int(11) NOT NULL',
                'language'=>'varchar(2) NOT NULL',
                'name'=>'varchar(255) NOT NULL',
                'summary'=>'tinytext NOT NULL',
                'body'=>'text NOT NULL',
            ), '');

            $this->createTable('banners', array(
                'id'=>'pk',
                'text'=>'varchar(255) NOT NULL',
                'link'=>'varchar(255) NOT NULL',
                'pic_name'=>'varchar(255) NOT NULL',
                'sort'=>'int(11) NOT NULL',
                'date'=>'timestamp NOT NULL',
            ), '');

            $this->createTable('banners_translate', array(
                'id'=>'pk',
                'parent_id'=>'int(11) NOT NULL',
                'language'=>'varchar(2) NOT NULL',
                'link'=>'varchar(255) NOT NULL',
                'topic'=>'varchar(255) NOT NULL',
                'content'=>'varchar(255) NOT NULL',
            ), '');

            $this->createTable('brands', array(
                'id'=>'pk',
                'name'=>'varchar(255) NOT NULL',
                'logo'=>'varchar(255) NOT NULL',
                'logo_dark'=>'varchar(255) DEFAULT NULL',
            ), '');

            $this->createTable('category', array(
                'id'=>'pk',
                'parent_id'=>'int(11) NOT NULL DEFAULT \'-1\'',
                'name'=>'varchar(255) DEFAULT NULL',
                'deleted'=>'int(11) NOT NULL',
                'sort'=>'int(11) NOT NULL',
                'active'=>'int(11) NOT NULL DEFAULT \'1\'',
            ), '');

            $this->createTable('category_fieldset', array(
                'id'=>'pk',
                'name'=>'varchar(255) NOT NULL',
                'type'=>'varchar(255) NOT NULL',
            ), '');

            $this->createTable('category_fieldset_relation', array(
                'id'=>'pk',
                'category_id'=>'int(11) NOT NULL',
                'fieldset_id'=>'int(11) NOT NULL',
            ), '');

            $this->createIndex('idx_category_id', 'category_fieldset_relation', 'category_id', FALSE);

            $this->createIndex('idx_fieldset_id', 'category_fieldset_relation', 'fieldset_id', FALSE);

            $this->createTable('colors', array(
                'id'=>'pk',
                'name'=>'varchar(255) NOT NULL',
                'rgb'=>'varchar(6) NOT NULL DEFAULT \'000000\'',
                'pic_name'=>'varchar(255) DEFAULT NULL',
            ), '');

            $this->createTable('customers', array(
                'id'=>'pk',
                'name'=>'varchar(255) NOT NULL',
                'surname'=>'varchar(255) NOT NULL',
                'phone'=>'varchar(255) NOT NULL',
                'email'=>'varchar(255) NOT NULL',
                'login'=>'varchar(255) NOT NULL',
                'password'=>'varchar(255) NOT NULL',
                'subscribe'=>'tinyint(1) NOT NULL',
                'date'=>'timestamp NOT NULL',
            ), '');

            $this->createTable('gallery', array(
                'id'=>'pk',
                'parent_id'=>'varchar(11) NOT NULL',
                'pic_name'=>'varchar(255) NOT NULL',
                'created_date'=>'timestamp NOT NULL',
                'mod_date'=>'timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\'',
            ), '');

            $this->createTable('item_photos', array(
                'id'=>'pk',
                'pic_name'=>'varchar(255) NOT NULL',
                'color_id'=>'int(11) NOT NULL',
                'item_id'=>'int(11) NOT NULL',
                'name'=>'varchar(255) NOT NULL',
            ), '');

            $this->createIndex('idx_item_id', 'item_photos', 'item_id', FALSE);

            $this->createTable('items', array(
                'id'=>'pk',
                'category_id'=>'int(11) NOT NULL',
                'brands_id'=>'int(11) NOT NULL',
                'name'=>'varchar(255) NOT NULL',
                'body'=>'text NOT NULL',
                'color_id'=>'int(11) NOT NULL',
                'size'=>'varchar(255) NOT NULL',
                'price'=>'float NOT NULL',
                'discount'=>'float NOT NULL',
                'pic_name'=>'varchar(255) DEFAULT NULL',
                'sort'=>'int(11) NOT NULL',
                'stock'=>'int(11) NOT NULL',
                'params'=>'text DEFAULT NULL',
                'deleted'=>'int(11) NOT NULL',
                'active'=>'int(11) NOT NULL',
                'artikul'=>'varchar(255) NOT NULL',
                'artikul2'=>'varchar(255) DEFAULT NULL',
                'barcode'=>'varchar(255) NOT NULL',
            ), '');

            $this->createIndex('idx_category_id', 'items', 'category_id', FALSE);

            $this->createTable('items_paramset', array(
                'id'=>'pk',
                'fieldset_id'=>'int(11) NOT NULL',
                'items_id'=>'int(11) NOT NULL',
                'language'=>'varchar(2) NOT NULL DEFAULT \'az\'',
                'value'=>'varchar(255) DEFAULT NULL',
            ), '');

            $this->createIndex('idx_fieldset_id', 'items_paramset', 'fieldset_id', FALSE);

            $this->createIndex('idx_items_id', 'items_paramset', 'items_id', FALSE);

            $this->createTable('items_translate', array(
                'id'=>'pk',
                'parent_id'=>'int(11) NOT NULL',
                'body'=>'text DEFAULT NULL',
                'language'=>'varchar(2) NOT NULL',
            ), '');

            $this->createIndex('idx_parent_id', 'items_translate', 'parent_id', FALSE);

            $this->createTable('languages', array(
                'id'=>'pk',
                'code'=>'varchar(5) NOT NULL',
                'name'=>'varchar(255) NOT NULL',
                'active'=>'int(11) NOT NULL DEFAULT \'1\'',
            ), '');

            $this->createTable('menus', array(
                'id'=>'pk',
                'parent_id'=>'int(11) NOT NULL',
                'pic_name'=>'varchar(255) DEFAULT NULL',
                'banner'=>'tinyint(1) NOT NULL',
                'sort'=>'int(11) NOT NULL',
                'keyword'=>'varchar(255) DEFAULT NULL',
                'active'=>'int(11) NOT NULL DEFAULT \'1\'',
                'deleted'=>'int(11) NOT NULL',
            ), '');

            $this->createTable('menus_translate', array(
                'id'=>'pk',
                'menus_id'=>'int(11) NOT NULL',
                'language'=>'varchar(2) NOT NULL',
                'name'=>'varchar(255) NOT NULL',
                'link'=>'varchar(255) NOT NULL',
            ), '');

            $this->createTable('modules', array(
                'id'=>'pk',
                'name'=>'varchar(255) NOT NULL',
                'active'=>'tinyint(1) NOT NULL DEFAULT \'1\'',
            ), '');

            $this->createTable('settings', array(
                'id'=>'pk',
                'attribute'=>'varchar(255) NOT NULL',
                'value'=>'varchar(600) NOT NULL',
                'visible'=>'int(11) NOT NULL DEFAULT \'1\'',
            ), '');

            $this->createTable('users', array(
                'id'=>'pk',
                'uname'=>'varchar(255) DEFAULT NULL',
                'pass'=>'varchar(45) DEFAULT NULL',
                'status'=>'int(10) unsigned NOT NULL DEFAULT \'1\'',
                'name'=>'varchar(45) DEFAULT NULL',
                'surname'=>'varchar(45) DEFAULT NULL',
                'email'=>'varchar(255) DEFAULT NULL',
                'phone'=>'varchar(255) DEFAULT NULL',
            ), '');

            $this->addForeignKey('fk_category_fieldset_relation_category_category_id', 'category_fieldset_relation', 'category_id', 'category', 'id', 'NO ACTION', 'NO ACTION');

            $this->addForeignKey('fk_category_fieldset_relation_category_fieldset_fieldset_id', 'category_fieldset_relation', 'fieldset_id', 'category_fieldset', 'id', 'NO ACTION', 'NO ACTION');

            $this->addForeignKey('fk_item_photos_items_item_id', 'item_photos', 'item_id', 'items', 'id', 'NO ACTION', 'NO ACTION');

            $this->addForeignKey('fk_items_category_category_id', 'items', 'category_id', 'category', 'id', 'NO ACTION', 'NO ACTION');

            $this->addForeignKey('fk_items_paramset_category_fieldset_fieldset_id', 'items_paramset', 'fieldset_id', 'category_fieldset', 'id', 'NO ACTION', 'NO ACTION');

            $this->addForeignKey('fk_items_paramset_items_items_id', 'items_paramset', 'items_id', 'items', 'id', 'NO ACTION', 'NO ACTION');

            $this->addForeignKey('fk_items_translate_items_parent_id', 'items_translate', 'parent_id', 'items', 'id', 'NO ACTION', 'NO ACTION');

        }


        public function down()
        {
            $this->dropForeignKey('fk_category_fieldset_relation_category_category_id', 'category_fieldset_relation');
            $this->dropForeignKey('fk_category_fieldset_relation_category_fieldset_fieldset_id', 'category_fieldset_relation');
            $this->dropForeignKey('fk_item_photos_items_item_id', 'item_photos');
            $this->dropForeignKey('fk_items_category_category_id', 'items');
            $this->dropForeignKey('fk_items_paramset_category_fieldset_fieldset_id', 'items_paramset');
            $this->dropForeignKey('fk_items_paramset_items_items_id', 'items_paramset');
            $this->dropForeignKey('fk_items_translate_items_parent_id', 'items_translate');
            $this->dropTable('Message');
            $this->dropTable('ShopOrder');
            $this->dropTable('ShopProductOrder');
            $this->dropTable('SourceMessage');
            $this->dropTable('album');
            $this->dropTable('articles');
            $this->dropTable('articles_translate');
            $this->dropTable('banners');
            $this->dropTable('banners_translate');
            $this->dropTable('brands');
            $this->dropTable('category');
            $this->dropTable('category_fieldset');
            $this->dropTable('category_fieldset_relation');
            $this->dropTable('colors');
            $this->dropTable('customers');
            $this->dropTable('gallery');
            $this->dropTable('item_photos');
            $this->dropTable('items');
            $this->dropTable('items_paramset');
            $this->dropTable('items_translate');
            $this->dropTable('languages');
            $this->dropTable('menus');
            $this->dropTable('menus_translate');
            $this->dropTable('modules');
            $this->dropTable('settings');
            $this->dropTable('users');
        }

                /*
                // Use safeUp/safeDown to do migration with transaction
                public function safeUp()
                {
                }

                public function safeDown()
                {
                }
                */
}