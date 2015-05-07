<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Tax\Test\TestCase;

use Magento\Mtf\TestCase\Scenario;
use Magento\Mtf\ObjectManager;

/**
 * Steps:
 * 1. Log in as default admin user.
 * 2. Go to Stores > Taxes > Tax Rules.
 * 3. Click 'Add New Tax Rule' button.
 * 4. Assign default rates to rule.
 * 5. Save Tax Rate.
 * 6. Go to Products > Catalog.
 * 7. Add new product.
 * 8. Fill data according to dataset.
 * 9. Save product.
 * 10. Go to Stores > Configuration.
 * 11. Fill Tax configuration according to data set.
 * 12. Save tax configuration.
 * 13. Perform all assertions.
 *
 * @group Tax_(CS)
 * @ZephyrId MAGETWO-27809
 */
class TaxCalculationTest extends Scenario
{
    /* tags */
    const MVP = 'yes';
    const DOMAIN = 'CS';
    /* end tags */

    /**
     * Skip failed tests.
     *
     * @return void
     */
    public static function setUpBeforeClass()
    {
        self::markTestIncomplete("Epic: MAGETWO-30073");
    }

    /**
     * Runs tax calculation test.
     *
     * @return void
     */
    public function test()
    {
        $this->executeScenario();
    }

    /**
     * Tear down after each test.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->objectManager->create('\Magento\Tax\Test\TestStep\DeleteAllTaxRulesStep')->run();
        $this->objectManager->create('\Magento\SalesRule\Test\TestStep\DeleteAllSalesRuleStep')->run();
        $this->objectManager->create('\Magento\CatalogRule\Test\TestStep\DeleteAllCatalogRulesStep')->run();

        // TODO: Move set default configuration to "tearDownAfterClass" method after fix bug MAGETWO-29331
        $this->objectManager->create(
            'Magento\Config\Test\TestStep\SetupConfigurationStep',
            ['configData' => 'default_tax_configuration']
        )->run();
    }
}