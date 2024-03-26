<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property int $idmaterial
 * @property string $num_patrimonio
 * @property int|null $num_ficha
 * @property string|null $cod_material
 * @property string|null $contacontabil
 * @property string $descricao
 
 * @property int $iddependencias
 * @property float $valoruni
 * @property int $ativo
 *
 * @property Dependencias $iddependencias0
 * @property Pessoa $iddetentor0
 */
class Material extends \yii\db\ActiveRecord
{

    public $patrimonios;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_patrimonio', 'descricao',  'iddependencias', 'valoruni'], 'required'],
            [['num_ficha', 'iddependencias', 'ativo'], 'integer'],
            [['valoruni'], 'number'],
            [['patrimonios'], 'string','max' => 30000],
            [['patrimonios'], 'safe'],
            [['num_patrimonio'], 'string', 'max' => 50],
            [['cod_material'], 'string', 'max' => 20],
            [['contacontabil'], 'string', 'max' => 30],
            [['descricao'], 'string', 'max' => 200],
            [['num_patrimonio'], 'unique'],
            [['iddependencias'], 'exist', 'skipOnError' => true, 'targetClass' => Dependencias::class, 'targetAttribute' => ['iddependencias' => 'id']],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmaterial' => 'Idmaterial',
            'num_patrimonio' => 'Num. Patrimônio',
            'patrimonios' => 'Num. Patrimônio (para mais de 1 separar por virgula)',
            'num_ficha' => 'Num Ficha',
            'cod_material' => 'Cod Material',
            'contacontabil' => 'Conta contabil',
            'descricao' => 'Descrição',
            
            'iddependencias' => 'Iddependencias',
            'valoruni' => 'Valor uni.',

            'ativo' => 'Ativo',
        ];
    }

    /**
     * Gets query for [[Iddependencias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDependencias()
    {
        return $this->hasOne(Dependencias::class, ['id' => 'iddependencias'])->one();
    }

    public static function getMateriaisUsuario($idusuario){
        return Material::find()->where('iddependencias in (select id from dependencias where iddetentor = :iddetentor)', ["iddetentor" => $idusuario])->orderBy("descricao")->all();
    }

   
}
