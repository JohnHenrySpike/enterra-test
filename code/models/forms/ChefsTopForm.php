<?php

namespace app\models\forms;

use Yii;

class ChefsTopForm extends \yii\db\ActiveRecord
{
    /**
     * @var string
     */
    public $from;

    /**
     * @var string
     */
    public $to;

    public function formName(){
        return "";
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'string', 'strict' => true],
            [['from', 'to'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['from', 'to'], 'required'],
            ['from', 'mustNotGreaterTo'],
        ];
    }

    public function mustNotGreaterTo($attribute): void
    {
        if (strtotime($this->{$attribute}) > strtotime($this->to)) {
            $this->addError($attribute, $this->getAttributeLabel($attribute) . ' must not be greater than to.');
        }
    }
}