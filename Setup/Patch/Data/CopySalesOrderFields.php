<?php

namespace VictorKon\OrdersGridExtraFields\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

/**
 * Copies coupon_code and discount_amount fields from sales_order to sales_order_grid table
 */
class CopySalesOrderFields
	implements DataPatchInterface, PatchRevertableInterface
{
	/**
	 * @var \Magento\Framework\Setup\ModuleDataSetupInterface
	 */
	private $moduleDataSetup;

	/**
	 * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
	 */
	public function __construct(
		\Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
	) {
		$this->moduleDataSetup = $moduleDataSetup;
	}

	/**
	 * {@inheritdoc}
	 */
	public function apply()
	{
		$this->moduleDataSetup->getConnection()->startSetup();
		$this->copyCouponCodeAndDiscountAmountFieldsFromSalesOrderToSalesOrderGridTable();
		$this->moduleDataSetup->getConnection()->endSetup();
	}

	/**
	 * {@inheritdoc}
	 */
	public static function getDependencies()
	{
		return [];
	}

	public function revert()
	{
		$this->moduleDataSetup->getConnection()->startSetup();

		// we don't actually need to revert anything because the copied columns will be removed automatically

		$this->moduleDataSetup->getConnection()->endSetup();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAliases()
	{
		return [];
	}

	/**
	 * Copies coupon_code and discount_amount fields from sales_order to sales_order_grid table
	 *
	 * @return void
	 */
	private function copyCouponCodeAndDiscountAmountFieldsFromSalesOrderToSalesOrderGridTable()
	{
		$connection = $this->moduleDataSetup->getConnection();
		$ordersTable = $this->moduleDataSetup->getTable('sales_order');
		$gridTable = $this->moduleDataSetup->getTable('sales_order_grid');

		$connection->query(
			$connection->updateFromSelect(
				$connection->select()
					->join(
						$ordersTable,
						sprintf('%s.entity_id = %s.entity_id', $gridTable, $ordersTable),
						['coupon_code', 'discount_amount']
					),
				$gridTable
			)
		);
	}
}