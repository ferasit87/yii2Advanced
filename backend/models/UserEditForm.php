<?php
namespace backend\models;

use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class UserEditForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;


   
    public function __construct($id, $config=[])
    {
        if (empty($id) ) {
            throw new InvalidParamException('Id user cannot be blank.');
        }
        $this->_user = User::findIdentity($id);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong id user.');
        }
        
         $this->username = $this->_user->username;
         $this->email = $this->_user->email;
        parent::__construct($config);
    }
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
             ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string','min' => 2, 'max' => 255],
 
            ['password', 'string', 'min' => 6],
        ];
    }

     
    public function edit()
    {
        if (!$this->validate()) {
            return null;
        }
   
         $this->_user->username = $this->username;
         $this->_user->email = $this->email;
         if ($this->password != '' ) $this->_user->setPassword($this->password);
 
        return  $this->_user->update() ? $this->_user : null;
    }
}
