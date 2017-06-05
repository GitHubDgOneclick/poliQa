<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\models\UsersSearch;
use app\assets\AppHandlingErrors;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de usuario',
            'password' => 'Contraseña',
            'rememberMe' => 'Recordarme',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $usuarioLdap = Yii::$app->ldap->search()->findBy( Yii::$app->params['codigo'] , $this->username );
        if ( $usuarioLdap != null ) {
            //echo "username:".$this->username;
            //echo "password:".$this->password;
            //echo "*-----------------*";
            //print_r($usuarioLdap);

            if ( Yii::$app->ldap->connect( 'cn='.$this->username.',dc=poli,dc=edu,dc=co' , $this->password ) ) {
                
                $usuario = Usuario::findByUsername($this->username);
                if ($usuario == null) {
                    $usuario = new Usuario; 
                    $usuario->rol = Rol::ROL_USUARIO;
                }
                print_r($usuarioLdap);
                echo "<br\>";
                echo "--------------";
                echo "<br\>";
                $usuario->nombre = $usuarioLdap[ Yii::$app->params['nombre'] ][0];
                $usuario->apellido = $usuarioLdap[ Yii::$app->params['apellido'] ][0];
                $usuario->email = $usuarioLdap[ Yii::$app->params['email'] ][0];
                $usuario->usuario = $this->username;
                $usuario->contrasena = $this->password;
                print_r($usuario);
                if ( $usuario->save() ) {
                    
                } else {
                    print_r($usuario->errors);
                    AppHandlingErrors::setFlash( 'danger' , 'Error guardando dato' );
                }
                $this->_user = $usuario;
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            } else {
                AppHandlingErrors::setFlash( 'danger' , 'Contraseña no valida' );
                return false;
            }
        } else {
            AppHandlingErrors::setFlash( 'danger' , 'El usuario no existe' );
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::findByUsername($this->username);
        }

        return $this->_user;
    }
}
