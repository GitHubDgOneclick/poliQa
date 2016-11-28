<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $codigo
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $usuario
 * @property string $contrasena
 * @property integer $rol
 *
 * @property Entrada[] $entradas
 * @property EslabonAprobacion[] $eslabonAprobacions
 * @property Rol $rol0
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'email', 'usuario', 'contrasena', 'rol'], 'required'],
            [['rol'], 'integer'],
            [['nombre', 'apellido', 'email', 'usuario', 'contrasena'], 'string', 'max' => 45],
            [['rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'email' => 'Email',
            'usuario' => 'Usuario',
            'contrasena' => 'Contrasena',
            'rol' => 'Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradas()
    {
        return $this->hasMany(Entrada::className(), [ 'usuario' => 'codigo'  /*, 'estado' => Entrada::ESTADO_ACTIVO*/ ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEslabonAprobacions()
    {
        return $this->hasMany(EslabonAprobacion::className(), ['usuario' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol0()
    {
        return $this->hasOne(Rol::className(), ['codigo' => 'rol']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['usuario' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->codigo;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->contrasena;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->contrasena === base64_encode($password);
    }

    public function getNombre()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
