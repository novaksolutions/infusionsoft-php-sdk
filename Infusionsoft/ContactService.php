<?php
class Infusionsoft_ContactService extends Infusionsoft_ContactServiceBase{
    public static function getContactListWhoHaveATagInCategory($categoryName){
        $categories = Infusionsoft_DataService::query(new Infusionsoft_ContactGroupCategory(), array('CategoryName' => $categoryName));
        if(count($categories) > 0){
            $category = array_shift($categories);
        } else {
            throw new Exception("Tag Category: " . $categoryName . " doesn't exist.");
        }

        $tags = Infusionsoft_DataService::query(new Infusionsoft_ContactGroup(), array('GroupCategoryId' => $category->Id));
        $contactList = array();
        foreach($tags as $tag){
            /** @var Infusionsoft_ContactGroup $tag */
            Infusionsoft_ContactGroupAssign::addCustomField("Contact.FirstName");
            Infusionsoft_ContactGroupAssign::addCustomField("Contact.LastName");
            $contacts = Infusionsoft_DataService::query(new Infusionsoft_ContactGroupAssign(), array('GroupId' => $tag->Id));
            foreach($contacts as $contact){
                /** @var Infusionsoft_ContactGroupAssign $contact */
                if(!isset($contactList[$contact->ContactId])){
                    $contactList[$contact->ContactId] = $contact->__get('Contact.FirstName') . ' ' . $contact->__get('Contact.LastName');
                }
            }
        }

        return $contactList;
    }
}