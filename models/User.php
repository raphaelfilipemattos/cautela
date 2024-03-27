<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $pessoa;
    public $sigla_posto_grad;
       

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::getUsuario(' idpessoa = :idpessoa ', ['idpessoa' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::getUsuario(' md5(idusuario||identidade||senha) = :token ', ['token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       return self::getUsuario('identidade = :username', ['username' => $username]);
    }
    
    public static function getUsuario(string $criterio, Array $valores){
       $pessoa = Pessoa::find()->where($criterio, $valores)->one();
      
       if ( empty($pessoa) ) return false;       

       $user = new User();
       $user->id = $pessoa->idpessoa;
       $user->password = $pessoa->senha;
       $user->username = $pessoa->identidade;
       $user->authKey = md5($pessoa->identidade);
       $user->accessToken = md5($pessoa->idpessoa.$pessoa->identidade.$pessoa->senha);
       $user->pessoa = $pessoa;       
       $user->sigla_posto_grad = $pessoa->postograd;
       
       return $user;  
    }
    
    public function nomeApresentacao(){
       return  $this->pessoa->postograd.' - '.$this->pessoa->nome_guerra;
    }
    
    public static function login($login)
    {
      $resposta = self::getUsuario(" ( identidade = :login", ['login' => $login]);
     
      return $resposta;
    }

    
    public static function getUsuarioLogado(){
        if (\Yii::$app->user->isGuest ){              
              return false;
        }
        return \Yii::$app->user->identity;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $resposta = $this->password === md5($password);  
        
        return $resposta;
    }

 


}
