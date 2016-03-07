<?php
class Infusionsoft_SubscriptionPlan extends Infusionsoft_Generated_SubscriptionPlan{
    public function __construct($id = null, $app = null){
    	parent::__construct($id, $app);    	    	
    }

    public function getHumanizedPrice(){
        return $this->getSimplePrice() . ' / ' . $this->getHumanizedCycle();
    }

    public function getSimplePrice(){
        if(round($this->PlanPrice) == $this->PlanPrice){
            return "\${$this->PlanPrice}";
        } else {
            return "$" . number_format($this->PlanPrice, 2);
        }
    }

    public function getHumanizedCycle(){
        $cycle = '';
        switch($this->Cycle){
            case 3:
                $cycle = "Week";
                break;
            case 2:
                $cycle = "Month";
                break;
            case 1:
                $cycle = "Year";
                break;
            case 6:
                $cycle = "Day";
                break;
            default:
                $cycle = "Ack! Unknown!";
                break;
        }

        if($this->Frequency > 1){
            $cycle = $this->Frequency . ' ' . $cycle . 's';
        }

        return $cycle;
    }

    public function __set($name, $value)
    {
        if(in_array($name, array('Frequency', 'Cycle', 'ProductId'))) {
            $value = (int) $value;
        }

        parent::__set($name, $value);
    }
}

