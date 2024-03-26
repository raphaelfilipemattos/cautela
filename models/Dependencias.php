<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dependencias".
 *
 * @property int $id
 * @property string $nome
 * @property int $iddetentor
 *
 * @property Material[] $materials
 */
class Dependencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dependencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome','iddetentor',], 'required'],
            [['iddetentor'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['iddetentor'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::class, 'targetAttribute' => ['iddetentor' => 'idpessoa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'iddetentor' => 'Detentor',
        ];
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::class, ['iddependencias' => 'id'])->all();
    }

    public function getDetentor()
    {
        return $this->hasOne(Pessoa::class, ['idpessoa' => 'iddetentor'])->one();
    }
}
