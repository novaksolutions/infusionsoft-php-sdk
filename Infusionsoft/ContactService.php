<?php
class Infusionsoft_ContactService extends Infusionsoft_Service{
	
	/*
	 * Using This method will fire off the Contact API Add Action
	 */
	protected static function add(Infusionsoft_Contact &$contact, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);
		
		$params = array(
			$contact->toArray()
		);

		$contactId = $app->send('ContactService.add', $params);
		
		if($contactId > 0){
			$contact->Id = $contactId;
		}
		
		return $contactId;		
	}
	
	public static function addToCampaign(Infusionsoft_Contact &$contact, $campaignId, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);
		
		if(!($contact->Id > 0)){
			throw new Infusionsoft_Exception("Cannot add an unsaved contact to a group.");
		}
		
		$params = array(
			(int) $contact->Id,
			(int) $campaignId
		);

		$success = $app->send('ContactService.addToCampaign', $params);
		return $success;		
	}
	
	public static function addToGroup(Infusionsoft_Contact &$contact, $groupId, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);
		
		if(!($contact->Id > 0)){
			throw new Infusionsoft_Exception("Cannot add an unsaved contact to a group.");
		}
		
		$params = array(
			(int) $contact->Id,
			(int) $groupId
		);

		$success = $app->send('ContactService.add', $params);
		return $success;		
	}
	
	public static function findByEmail($emailAddress, $returnFields = false, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app);
		
		if(!$returnFields){	
			$contact = new Infusionsoft_Contact();
			$returnFields = $contact->getFields();
		}						
		
		$params = array(			
			$emailAddress,
			$returnFields
		);

		$records = $app->send('ContactService.findByEmail', $params);		
		return self::_returnResults('Infusionsoft_Contact', $app->getHostName(), $records);
	}
	
	/*
	public static function linkContact(Infusionsoft_Contact &$contact, $remoteApp, Infusionsoft_Contact &$remoteContact, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);
		
		if(!($contact->Id > 0)){
			throw new Infusionsoft_Exception("Cannot link an unsaved contact.");
		}
		
		$params = array(
			$remoteApp,
			(int) $contact->Id,
			(int) $remoteContact->Id
		);

		$success = $app->send('ContactService.linkContact', $params);
		return $success;		
	} 
	
	public static function locateContactLink($locateMapId, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app);
		
		
		
		$params = array(
			$remoteApp,
			(int) $contact->Id,
			(int) $locateMapId
		);

		$localContactId = $app->send('ContactService.markLinkUpdated', $params);
		return $localContactId;		
	}
	
	public static function markLinkUpdated($locateMapId, Infusionsoft_Contact &$remoteContact, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app, $remoteContact);		
		
		$params = array(			
			(int) $locateMapId
		);

		$success = $app->send('ContactService.markLinkUpdated', $params);
		return $success;		
	} 
	 */
	
	
	
	public static function getCampaigneeDetails(Infusionsoft_Contact &$contact, $campaignId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $campaignId
		);

		$detailsAsArray = $app->send('ContactService.getCampaigneeStepDetails', $params);		
		return $detailsAsArray;
	}
	
	public static function getCampaigneeStepDetails(Infusionsoft_Contact &$contact, $stepId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $stepId
		);

		$detailsAsArray = $app->send('ContactService.getCampaigneeStepDetails', $params);		
		return $detailsAsArray;
	}
	
	public static function getCampaignStepDetails($stepId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app);									
		
		$params = array(			
			(int) $stepId
		);

		$detailsAsArray = $app->send('ContactService.getCampaignStepDetails', $params);		
		return $detailsAsArray;
	}
	
	public static function getCampaignStepOrder($stepId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app);									
		
		$params = array(			
			(int) $stepId
		);

		$order = $app->send('ContactService.getCampaignStepOrder', $params);		
		return $order;
	}
	
	public static function getNextCampaignStep(Infusionsoft_Contact &$contact, $campaignId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $campaignId
		);

		$success = $app->send('ContactService.getNextCampaignStep', $params);		
		return $success;
	}
	
	/*
	 * This is identical to DataService.load, the ContactService actually calls the DataService at Infusionsoft. (See ContactService.java)
	 */
	public static function load(Infusionsoft_Contact &$object, $id, $returnFields = false, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);
		
		if(!$returnFields){	
			$returnFields = $object->getFields();
		}						
		
		$params = array(			
			(int) $id,
			$returnFields
		);

		$records = $app->send('ContactService.load', $params);		
		return self::_returnResults(get_class($object), $app->getHostName(), $records);
	}
	
	public static function pauseCampaign(Infusionsoft_Contact &$contact, $campaignId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $campaignId
		);

		$success = $app->send('ContactService.pauseCampaign', $params);		
		return $success;
	}
	
	public static function removeFromCampaign(Infusionsoft_Contact &$contact, $campaignId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $campaignId
		);

		$success = $app->send('ContactService.removeFromCampaign', $params);		
		return $success;
	}
	
	public static function rescheduleCampaignStep($contacts, $campaignStepId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$contactIds = array();
		foreach($contacts as $contact){
			$contactIds[] = (int) $contact->Id;	
		}
		
		
		$params = array(
			$contactIds,
			$campaignStepId
		);

		$success = $app->send('ContactService.rescheduleCampaignStep', $params);		
		return $success;
	}
	
	public static function resumeCampaignForContact(Infusionsoft_Contact &$contact, $campaignId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $campaignId
		);

		$success = $app->send('ContactService.resumeCampaignForContact', $params);		
		return $success;
	}
	
	public static function runActionSequence(Infusionsoft_Contact &$contact, $actionSequenceId, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $actionSequenceId
		);

		$success = $app->send('ContactService.runActionSequence', $params);		
		return $success;
	}
	
	public static function runActionSequenceWithParams(Infusionsoft_Contact &$contact, $actionSequenceId, $arrayOfParams, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			(int) $actionSequenceId,
			$arrayOfParams
		);

		$success = $app->send('ContactService.runActionSequence', $params);		
		return $success;
	}

	public static function submitSurveyAndApplyActionSets($surveyResultId, $arrayOfActionSetIds, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app);									
		
		$params = array(
			(int) $surveyResultId,
			$arrayOfActionSetIds
		);

		$success = $app->send('ContactService.submitSurveyAndApplyActionSets', $params);		
		return $success;
	}
	
	public static function update(Infusionsoft_Contact &$contact, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $contact);									
		
		$params = array(
			(int) $contact->Id,
			$contact->toArray()
		);

		$success = $app->send('ContactService.update', $params);		
		return $success;
	}
	
}