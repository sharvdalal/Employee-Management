<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PayrollAdjustment Entity
 *
 * @property int $id
 * @property int $payroll_id
 * @property string $type
 * @property string $name
 * @property float|null $amount
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Payroll $payroll
 */
class PayrollAdjustment extends Entity
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
        'payroll_id' => true,
        'type' => true,
        'name' => true,
        'amount' => true,
        'created' => true,
        'modified' => true,
        'payroll' => true,
    ];
}
