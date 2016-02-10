<?php
class Infusionsoft_ContactGroupAssign extends Infusionsoft_Generated_ContactGroupAssign{

    public function __construct($id = null, $app = null){
        parent::__construct(null, $app);
        if($id != null) {
            $results = Infusionsoft_ContactGroupAssignDataService::query(new Infusionsoft_ContactGroupAssign(), array('GroupId' => $id % 10000000, 'ContactId' => floor($id / 10000000)), 1, 0, array('ContactId', 'GroupId', 'DateCreated', 'ContactGroup'), $app);
            if (count($results) == 0) {
                throw new Infusionsoft_Exception("Could not load " . $this->table . " with id " . $id);
            }
            $object = $results[0];



            $this->GroupId = $object->GroupId;
            $this->ContactId = $object->ContactId;
            $this->ContactGroup = $object->ContactGroup;
            $this->DateCreated = $object->DateCreated;
            $this->data['Id'] = $this->ContactId * 10000000 + $this->GroupId;
        }

    }
}

