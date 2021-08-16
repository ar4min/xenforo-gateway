<?php

namespace ParsForo\ZarinPal;

use XF\AddOn\AbstractSetup;

class Setup extends AbstractSetup
{
	public function install(array $stepParams = [])
	{
		$entity = \XF::em()->create('XF:PaymentProvider');
		$entity->bulkSet(
			[
				'provider_id'    => "ZarinPal",
				'provider_class' => "ParsForo\\ZarinPal\\XF\\Payment\\ZarinPal",
				'addon_id'       => "ParsForo/ZarinPal"
			]
		);
		$entity->save();
	}

	public function upgrade(array $stepParams = [])
	{
		$this->uninstall();
		$this->install();
	}

	public function uninstall(array $stepParams = [])
	{
		$entity = \XF::em()->find('XF:PaymentProvider', 'ZarinPal');
		if(!empty($entity))
		{
			$entity->delete();
		}
	}
}