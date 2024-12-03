<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PayrollsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('payrolls');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
        ]);
        $this->hasMany('PayrollAdjustments', [
            'foreignKey' => 'payroll_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('employee_id')
            ->requirePresence('employee_id', 'create')
            ->notEmptyString('employee_id');

        $validator
            ->scalar('month')
            ->maxLength('month', 9)
            ->requirePresence('month', 'create')
            ->notEmptyString('month');

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmptyString('year');

        $validator
            ->date('payment_date')
            ->requirePresence('payment_date', 'create')
            ->notEmptyDate('payment_date');

        return $validator;
    }
}
