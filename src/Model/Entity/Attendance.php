<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Attendance extends Entity{

    protected $_accessible = [
        'employee_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'date' => true,
    ];
}