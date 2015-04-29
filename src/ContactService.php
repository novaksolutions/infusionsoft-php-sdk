<?php
namespace NovakSolutions\Infusionsoft;

class ContactService extends Service{
    public static function getContactListWhoHaveATagInCategory($categoryName){
        $categories = DataService::query(new ContactGroupCategory(), array('CategoryName' => $categoryName));
        if(count($categories) > 0){
            $category = array_shift($categories);
        } else {
            throw new Exception("Tag Category: " . $categoryName . " doesn't exist.");
        }

        $tags = DataService::query(new ContactGroup(), array('GroupCategoryId' => $category->Id));
        $contactList = array();
        foreach($tags as $tag){
            /** @var ContactGroup $tag */
            ContactGroupAssign::addCustomField("Contact.FirstName");
            ContactGroupAssign::addCustomField("Contact.LastName");
            $contacts = DataService::query(new ContactGroupAssign(), array('GroupId' => $tag->Id));
            foreach($contacts as $contact){
                /** @var ContactGroupAssign $contact */
                if(!isset($contactList[$contact->ContactId])){
                    $contactList[$contact->ContactId] = $contact->__get('Contact.FirstName') . ' ' . $contact->__get('Contact.LastName');
                }
            }
        }

        return $contactList;
    }

    public static function add($data, App $app = null){
        $params = array(
            $data
        );

        return parent::send($app, "ContactService.add", $params);
    }

    public static function load($id, $selectedFields, App $app = null){
        $params = array(
            (int) $id,
            $selectedFields
        );

        return parent::send($app, "ContactService.load", $params);
    }

    public static function merge($contactId, $duplicateContactId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $duplicateContactId
        );

        return parent::send($app, "ContactService.merge", $params);
    }

    public static function update($contactId, $data, App $app = null){
        $params = array(
            (int) $contactId,
            $data
        );

        return parent::send($app, "ContactService.update", $params);
    }

    public static function addWithDupCheck($data, $dupCheckType, App $app = null){
        $params = array(
            $data,
            $dupCheckType
        );

        return parent::send($app, "ContactService.addWithDupCheck", $params);
    }

    public static function addToCampaign($contactId, $campaignId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $campaignId
        );

        return parent::send($app, "ContactService.addToCampaign", $params);
    }

    public static function addToGroup($contactId, $groupId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $groupId
        );

        return parent::send($app, "ContactService.addToGroup", $params, null, true);
    }

    public static function getAppSetting($hash, $module, $param, App $app = null){
        $params = array(
            (int) $hash,
            $module,
            $param
        );

        return parent::send($app, "ContactService.getAppSetting", $params);
    }

    public static function getAppSettingInt($hash, $module, $param, App $app = null){
        $params = array(
            (int) $hash,
            $module,
            $param
        );

        return parent::send($app, "ContactService.getAppSettingInt", $params);
    }

    public static function linkContact($remoteApp, $remoteId, $localId, App $app = null){
        $params = array(
            $remoteApp,
            (int) $remoteId,
            (int) $localId
        );

        return parent::send($app, "ContactService.linkContact", $params);
    }

    public static function locateContactLink($locateMapId, App $app = null){
        $params = array(
            (int) $locateMapId
        );

        return parent::send($app, "ContactService.locateContactLink", $params);
    }

    public static function markLinkUpdated($locateMapId, App $app = null){
        $params = array(
            (int) $locateMapId
        );

        return parent::send($app, "ContactService.markLinkUpdated", $params);
    }

    public static function pauseCampaign($contactId, $campaignId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $campaignId
        );

        return parent::send($app, "ContactService.pauseCampaign", $params);
    }

    public static function refreshApp($hash, App $app = null){
        $params = array(
            (int) $hash
        );

        return parent::send($app, "ContactService.refreshApp", $params);
    }

    public static function removeFromCampaign($contactId, $campaignId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $campaignId
        );

        return parent::send($app, "ContactService.removeFromCampaign", $params);
    }

    public static function removeFromGroup($contactId, $groupId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $groupId
        );

        return parent::send($app, "ContactService.removeFromGroup", $params);
    }

    public static function resumeCampaignForContact($contactId, $campaignId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $campaignId
        );

        return parent::send($app, "ContactService.resumeCampaignForContact", $params);
    }

    public static function runActionSequence($contactId, $actionSequenceId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $actionSequenceId
        );

        return parent::send($app, "ContactService.runActionSequence", $params);
    }

    public static function rescheduleCampaignStep($contactId, $campaignStepId, App $app = null){
        $params = array(
            $contactId,
            (int) $campaignStepId
        );

        return parent::send($app, "ContactService.rescheduleCampaignStep", $params);
    }

    public static function getNextCampaignStep($contactId, $campaignId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $campaignId
        );

        return parent::send($app, "ContactService.getNextCampaignStep", $params);
    }

    public static function findByEmail($email, $selectedFields, App $app = null){
        $params = array(
            $email,
            $selectedFields
        );

        return parent::send($app, "ContactService.findByEmail", $params);
    }

    public static function submitSurveyAndApplyActionSets($surveyResultId, $actionSetIds, App $app = null){
        $params = array(
            (int) $surveyResultId,
            $actionSetIds
        );

        return parent::send($app, "ContactService.submitSurveyAndApplyActionSets", $params);
    }

    public static function getCampaigneeDetails($contactId, $campaignId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $campaignId
        );

        return parent::send($app, "ContactService.getCampaigneeDetails", $params);
    }

    public static function getCampaigneeStepDetails($contactId, $stepId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $stepId
        );

        return parent::send($app, "ContactService.getCampaigneeStepDetails", $params);
    }

    public static function getCampaignStepDetails($stepId, App $app = null){
        $params = array(
            (int) $stepId
        );

        return parent::send($app, "ContactService.getCampaignStepDetails", $params);
    }

    public static function getCampaignStepOrder($campaignId, App $app = null){
        $params = array(
            (int) $campaignId
        );

        return parent::send($app, "ContactService.getCampaignStepOrder", $params);
    }

    public static function getActivityHistoryTemplateMap(App $app = null){
        $params = array(
        );

        return parent::send($app, "ContactService.getActivityHistoryTemplateMap", $params);
    }

    public static function applyActivityHistoryTemplate($contactId, $historyId, $userId, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $historyId,
            (int) $userId
        );

        return parent::send($app, "ContactService.applyActivityHistoryTemplate", $params);
    }
}