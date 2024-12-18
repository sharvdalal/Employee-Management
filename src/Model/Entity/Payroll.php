<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Payroll extends Entity
{
    protected $_accessible = [
        'employee_id' => true,
        'month' => true,
        'year' => true,
        'payment_date' => true,
        'base_salary' => true,
        'employee' => true,
        'payroll_adjustments' => true,
    ];
}
