<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PayrollAdjustmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PayrollAdjustmentsTable Test Case
 */
class PayrollAdjustmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PayrollAdjustmentsTable
     */
    public $PayrollAdjustments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PayrollAdjustments',
        'app.Payrolls',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PayrollAdjustments') ? [] : ['className' => PayrollAdjustmentsTable::class];
        $this->PayrollAdjustments = TableRegistry::getTableLocator()->get('PayrollAdjustments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PayrollAdjustments);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
