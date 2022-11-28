<?php

/**
 * This is the model class for table "ShopOrder".
 *
 * The followings are the available columns in table 'ShopOrder':
 * @property integer $order_id
 * @property integer $customer_id
 * @property string $ordering_date
 * @property integer $ordering_done
 * @property integer $ordering_confirmed
 * @property integer $shipped
 * @property integer $finished
 * @property integer $cancelled
 * @property string $transaction_id
 * @property double $shipping_fee
 * @property string $shipping_name
 * @property string $shipping_surname
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property string $payment_method
 * @property string $ip
 */
class ShopOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ShopOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ShopOrder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, shipping_fee, shipping_name, shipping_surname, address, email, phone, ip', 'required'),
			array('customer_id, ordering_done, ordering_confirmed, shipped, finished, cancelled', 'numerical', 'integerOnly'=>true),
			array('shipping_fee', 'numerical'),
			array('transaction_id, shipping_name, shipping_surname, address, email, phone, message, payment_method, ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('order_id, customer_id, ordering_date, ordering_done, ordering_confirmed, shipped, finished, cancelled, shipping_fee, shipping_name, shipping_surname, address, email, phone, message, payment_method, ip', 'safe', 'on'=>'search'),
                        array('transaction_id,transaction_result,ip','unsafe')
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer'=>array(self::BELONGS_TO, 'Customers', 'customer_id'),
			'products'=>array(self::HAS_MANY, 'ShopProductOrder', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_id' => 'Order',
			'customer_id' => 'Customer',
			'ordering_date' => 'Ordering Date',
			'ordering_done' => 'Ordering Done',
			'ordering_confirmed' => 'Ordering Confirmed',
			'shipped' => 'Shipped',
			'finished' => 'Finished',
			'cancelled' => 'Cancelled',
			'transaction_id' => 'Transaction',
			'shipping_fee' => 'Shipping Fee',
			'shipping_name' => 'Shipping Name',
			'shipping_surname' => 'Shipping Surname',
			'address' => 'Address',
			'email' => 'Email',
			'phone' => 'Phone',
			'message' => 'Message',
			'payment_method' => 'Payment Method',
			'ip' => 'Ip',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('ordering_date',$this->ordering_date,true);
		$criteria->compare('ordering_done',$this->ordering_done);
		$criteria->compare('ordering_confirmed',$this->ordering_confirmed);
		$criteria->compare('shipped',$this->shipped);
		$criteria->compare('finished',$this->finished);
		$criteria->compare('cancelled',$this->cancelled);
		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('shipping_fee',$this->shipping_fee);
		$criteria->compare('shipping_name',$this->shipping_name,true);
		$criteria->compare('shipping_surname',$this->shipping_surname,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}