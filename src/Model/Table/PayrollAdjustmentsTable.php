<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PayrollAdjustmentsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('payroll_adjustments');
        $this->setPrimaryKey('id');

        $this->belongsTo('Payrolls', [
            'foreignKey' => 'payroll_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('payroll_id')
            ->requirePresence('payroll_id', 'create')
            ->notEmptyString('payroll_id');

        $validator
            ->scalar('type')
            ->maxLength('type', 7)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->decimal('amount')
            ->allowEmptyString('amount');

        return $validator;
    }
}
