<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AttendancesTable extends Table{

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('attendances');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            // 'joinType' => 'INNER',
        ]);
    }

}