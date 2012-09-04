<?php

common_include('plugins/campaignMonitor/newsletter/csrest_subscribers.php');

class plugin_campaignMonitor
{

	function runFromCustomForm($data,$db,$fields,$formData)
	{
		foreach($fields as $fieldItem)
		{
			// if no mapping, skip.
			if(!isset($fieldItem['apiFieldToMapTo']{1}) || $fieldItem['apiFieldToMapTo'] == NULL)
			{
				continue;
			}
					
			$apiFields[$fieldItem['apiFieldToMapTo']] = $formData[':'.$fieldItem['id']];
		}	
		
		$this->pushToServer($apiFields['email'],$apiFields['name']);
	}
	
	function pushToServer($email,$name)
	{
		$wrap = new CS_REST_Subscribers('c92ba413fde76b3823c1cc9726a72f15', 'bd0fce03de47562ece19f1b2b1106ebd');
		$result = $wrap->add(array(
			'EmailAddress' => $email,
			'Name' => $name,
			'Resubscribe' => true
		));
		
		return $result;
	}
}
?>