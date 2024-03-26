<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cautela".
 *
 * @property int $idcautela 
 * @property string $data
 * @property string $hora
 * @property string $nome_cautelador
 * @property string $nome_guerra_cautelador
 * @property string $cpf_cautelador
 * @property string $om_cautelador
 * @property string|null $datahora_retorno
 * @property int $flagbaixa
 * @property int|null $idpessoa_recebeu
 * @property string|null $obs
 *
 * @property Material $idmaterial0
 * @property Pessoa $idpessoaRecebeu
 */
class Cautela extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cautela';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'hora', 'nome_cautelador', 'nome_guerra_cautelador', 'cpf_cautelador', 'om_cautelador','hash'], 'required'],
            [['idpessoa_recebeu'], 'integer'],
            [['flagbaixa'], 'boolean'],
            [['data', 'hora', 'datahora_retorno'], 'safe'],
            [['obs'], 'string'],
            [['excluido'], 'boolean'],
            [['nome_cautelador'], 'string', 'max' => 200],
            [['nome_guerra_cautelador'], 'string', 'max' => 50],
            [['hash'], 'string', 'max' => 40],
            [['cpf_cautelador'], 'string', 'max' => 14],
            [['om_cautelador'], 'string', 'max' => 100],            
            [['idpessoa_recebeu'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::class, 'targetAttribute' => ['idpessoa_recebeu' => 'idpessoa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcautela' => 'Nº Cautela',            
            'data' => 'Data',
            'hora' => 'Hora',
            'nome_cautelador' => 'Nome',
            'nome_guerra_cautelador' => 'Nome de Guerra',
            'cpf_cautelador' => 'CPF',
            'om_cautelador' => 'OM',
            'datahora_retorno' => 'Data/hora Retorno',
            'flagbaixa' => 'Recebido',
            'idpessoa_recebeu' => 'Pessoa que Recebeu',
            'obs' => 'Obs',
        ];
    }

    /**
     * Gets query for [[Idmaterial0]].
     *
     * @return \yii\db\ActiveQuery
     */
   

    /**
     * Gets query for [[IdpessoaRecebeu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPessoaRecebeu()
    {
        return $this->hasOne(Pessoa::class, ['idpessoa' => 'idpessoa_recebeu'])->one();
    }

    public function getPessoaCriou()
    {
        return $this->hasOne(Pessoa::class, ['idpessoa' => 'idpessoacriou'])->one();
    }

    public function getItens()
    {
        return $this->hasMany(Cautelaitens::class, ['idcautela' => 'idcautela'])->all();
    }

    public function beforeSave($insert){
        $this->cpf_cautelador = str_replace(".","",$this->cpf_cautelador);
        $this->cpf_cautelador = str_replace("-","",$this->cpf_cautelador);
        return parent::beforeSave($insert);
    }
}
