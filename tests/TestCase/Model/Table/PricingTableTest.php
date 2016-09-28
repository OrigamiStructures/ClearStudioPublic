<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PricingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PricingTable Test Case
 */
class PricingTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PricingTable
     */
    public $Pricing;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pricing'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pricing') ? [] : ['className' => 'App\Model\Table\PricingTable'];
        $this->Pricing = TableRegistry::get('Pricing', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pricing);

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
