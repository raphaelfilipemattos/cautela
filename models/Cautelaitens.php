<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cautelaitens".
 *
 * @property int $idcautelaitens
 * @property int $idcautela
 * @property int $idmaterial
 *
 * @property Cautela $idcautela0
 * @property Cautela $idmaterial0
 */
class Cautelaitens extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cautelaitens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcautela', 'idmaterial',"descricaoitem"], 'required'],
            [['idcautela', 'idmaterial'], 'integer'],            
            [['descricaoitem'], 'string', 'max' => 200],
            [['idcautela'], 'exist', 'skipOnError' => true, 'targetClass' => Cautela::class, 'targetAttribute' => ['idcautela' => 'idcautela']],
            [['idmaterial'], 'exist', 'skipOnError' => true, 'targetClass' => Material::class, 'targetAttribute' => ['idmaterial' => 'idmaterial']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcautelaitens' => 'Idcautelaitens',
            'idcautela' => 'Idcautela',
            'idmaterial' => 'Idmaterial',
        ];
    }

    /**
     * Gets query for [[Idcautela0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCautela()
    {
        return $this->hasOne(Cautela::class, ['idcautela' => 'idcautela'])->one();
    }

    /**
     * Gets query for [[Idmaterial0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Material::class, ['idmaterial' => 'idmaterial'])->one();
    }
}
