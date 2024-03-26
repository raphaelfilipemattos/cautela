<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $idpessoa
 * @property string $nome
 * @property string $nome_guerra
 * @property string $postograd
 * @property string $identidade
 * @property string $senha
 * @property int $ativo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Material[] $materials
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nome_guerra', 'identidade','postograd'], 'required'],
            [['ativo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nome'], 'string', 'max' => 200],
            [['nome_guerra'], 'string', 'max' => 50],
            [['postograd'], 'string', 'max' => 10],
            [['identidade'], 'string', 'max' => 10],
            [['senha'], 'string', 'max' => 100],
            [['identidade'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpessoa' => 'Idpessoa',
            'nome' => 'Nome',
            'nome_guerra' => 'Nome de Guerra',
            'identidade' => 'Identidade',
            'senha' => 'Senha',
            'ativo' => 'Ativo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'postograd' => "Posto/graduação"
        ];
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::class, ['iddetentor' => 'idpessoa']);
    }

    public function beforeSave($insert){
        $this->updated_at = date("Y-m-d H:i:s");
        if ($insert){
            $this->created_at = date("Y-m-d H:i:s");
            $this->ativo = true;
            $this->senha = md5('senha');
        }
        return parent::beforeSave($insert);
    }


}
