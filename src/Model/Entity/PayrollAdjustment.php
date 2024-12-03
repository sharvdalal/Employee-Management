<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class PayrollAdjustment extends Entity
{
    protected $_accessible = [
        'payroll_id' => true,
        'type' => true,
        'name' => true,
        'amount' => true,
        'payroll' => true,
    ];
}
