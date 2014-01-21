<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $id;

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
        $record = AdminUser::model()->find(
            'email = :email',
            array(
                ':email' => $this->username,
            )
        );

        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($record->password !== crypt($this->password, $record->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->id = $record->admin_user_id;

            $attributes = $record->attributes;
            unset($attributes['password']);

            foreach ($attributes as $name => $value) {
                $this->setState($name, $value);
            }

            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
	}

    public function getId()
    {
        return $this->id;
    }
}
