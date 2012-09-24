<?php

common_include('plugins/campaignMonitor/newsletter/csrest_subscribers.php');

class plugin_campaignMonitor
{

	function runFromCustomForm($fields,$formData)
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
		$wrap = new CS_REST_Subscribers('API KEY', 'API KEY');
		$result = $wrap->add(array(
			'EmailAddress' => $email,
			'Name' => $name,
			'Resubscribe' => true
		));
		
		return $result;
	}
}
?>