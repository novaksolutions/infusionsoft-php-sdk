<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property int Id
 * @property int ProductId
 * @property String Cycle
 * @property int Frequency
 * @property float PreAuthorizeAmount
 * @property boolean Prorate
 * @property boolean Active
 * @property float PlanPrice
 */
class SubscriptionPlan extends Generated_SubscriptionPlan{
    protected static $tableFields = array('Id', 'ProductId', 'Cycle', 'Frequency', 'PreAuthorizeAmount', 'Prorate', 'Active', 'PlanPrice');

    public static $CYCLE_WEEK  = 3;
    public static $CYCLE_MONTH = 2;
    public static $CYCLE_YEAR  = 1;
    public static $CYCLE_DAY   = 6;

    public function __construct($id = null, $app = null){
        parent::__construct('SubscriptionPlan', $id, $app);
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
}

