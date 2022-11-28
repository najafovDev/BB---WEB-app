<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
	
		$connection=Yii::app()->db;	
		$sql= 'select * from users u where `uname` = :username and pass = :pass limit 0,1';
		$command=$connection->createCommand($sql);
                $command->bindParam(":username",$this->username,PDO::PARAM_STR);
                $command->bindParam(":pass",$this->password,PDO::PARAM_STR);

		$rows=$command->queryAll();
		if (isset($rows[0])) 
			{
				$this->errorCode=self::ERROR_NONE;
			}
		else $this->errorCode=self::ERROR_PASSWORD_INVALID;

		return $this->errorCode==self::ERROR_NONE;
		
	}
}
