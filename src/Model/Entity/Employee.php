<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $name
 * @property string $department
 * @property string $designation
 * @property float $salary
 * @property \Cake\I18n\FrozenDate $joining_date
 * @property string $email
 * @property string $mobile
 * @property string|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Attendance[] $attendances
 * @property \App\Model\Entity\Payroll[] $payrolls
 */
class Employee extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'department' => true,
        'designation' => true,
        'salary' => true,
        'joining_date' => true,
        'email' => true,
        'mobile' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'attendances' => true,
        'payrolls' => true,
    ];
}
