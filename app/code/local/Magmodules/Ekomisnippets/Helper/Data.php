<?php
/**
 * Magmodules.eu
 * http://www.magmodules.eu
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magmodules.eu so we can send you a copy immediately.
 *
 * @category    Magmodules
 * @package     Magmodules_Ekomisnippets
 * @author      Magmodules <info@magmodules.eu)
 * @copyright   Copyright (c) 2013 (http://www.magmodules.eu)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Magmodules_Ekomisnippets_Helper_Data extends Mage_Core_Helper_Abstract
{

	function getSnapshopRequest() 
	{
		$ekomi_api_id			= Mage::getStoreConfig('ekomisnippets/api/api_id');
		$ekomi_api_key			= Mage::getStoreConfig('ekomisnippets/api/api_key');
		$ekomi_version			= 'cust-1.0.0';		
		
		if($ekomi_api_id && $ekomi_api_key) {
			$api					= 'http://api.ekomi.de/v2/wsdl';
			$client					= new SoapClient($api, array('exceptions' => 0));
			$send_snapshot_request  = $client->getSnapshot($ekomi_api_id.'|'.$ekomi_api_key, $ekomi_version);
			$ret					= unserialize(utf8_decode($send_snapshot_request));
			return $ret; 
		} else {
			return false;
		}		
	}
	
	function getEkomiLink() 
	{			
		if(Mage::getStoreConfig('ekomisnippets/api/show_link')) {
			$ekomi_link = Mage::getStoreConfig('ekomisnippets/api/ekomi_link');
			return Mage::helper('ekomisnippets')->__('customer reviews on') . '<a href="' . $ekomi_link . '"> Ekomi</a>';
		} else {
			return false; 
		}		
	}

	function getEkomiStars($rating) 
	{	
		$perc  = round(($rating * 20), 0);
		$html .= '<div class="rating-box">';
		$html .= '	<div class="rating" style="width:' . $perc . '%"></div>';
		$html .= '</div>';
		return $html;
	}

}
