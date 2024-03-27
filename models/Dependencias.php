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
            [['nome','iddetentor_direto','iddetentor_indireto',], 'required'],
            [['iddetentor_direto','iddetentor_indireto'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['iddetentor_direto'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::class, 'targetAttribute' => ['iddetentor_direto' => 'idpessoa']],
            [['iddetentor_indireto'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::class, 'targetAttribute' => ['iddetentor_indireto' => 'idpessoa']],
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
            'iddetentor_direto' => 'Detentor direto',
            'iddetentor_indireto' => 'Detentor indireto',
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

    public function getDetentorDireto()
    {
        return $this->hasOne(Pessoa::class, ['idpessoa' => 'iddetentor_direto'])->one();
    }

    public function getDetentorIndireto()
    {
        return $this->hasOne(Pessoa::class, ['idpessoa' => 'iddetentor_indireto'])->one();
    }
}
