<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ContactId
 * @property String OriginatingOrderId
 * @property String ProgramId
 * @property String SubscriptionPlanId
 * @property String ProductId
 * @property String StartDate
 * @property String EndDate
 * @property String LastBillDate
 * @property String NextBillDate
 * @property String PaidThruDate
 * @property String BillingCycle
 * @property String Frequency
 * @property String BillingAmt
 * @property String Status
 * @property String ReasonStopped
 * @property String AutoCharge
 * @property String CC1
 * @property String CC2
 * @property String NumDaysBetweenRetry
 * @property String MaxRetry
 * @property String MerchantAccountId
 * @property String AffiliateId
 * @property String PromoCode
 * @property String LeadAffiliateId
 * @property String Qty
 */
class RecurringOrder extends BaseWithCustomFields{
    protected static $tableFields = array('Id', 'ContactId', 'OriginatingOrderId', 'ProgramId', 'SubscriptionPlanId', 'ProductId', 'StartDate', 'EndDate', 'LastBillDate', 'NextBillDate', 'PaidThruDate', 'BillingCycle', 'Frequency', 'BillingAmt', 'Status', 'ReasonStopped', 'AutoCharge', 'CC1', 'CC2', 'NumDaysBetweenRetry', 'MaxRetry', 'MerchantAccountId', 'AffiliateId', 'PromoCode', 'LeadAffiliateId', 'Qty');
    const CUSTOM_FIELD_FORM_ID = -10;

    public function __construct($id = null, $app = null){
        parent::__construct('RecurringOrder', $id, $app);
    }

    //Find the Id first order charged for this subscription
    public static function getFirstOrderId ($recurringOrderId) {
        //load recurringOrder
        $recurringOrder = new RecurringOrder($recurringOrderId);

        //If there was an originating shopping cart or order form order, that is the first order
        if ($recurringOrder->OriginatingOrderId != 0) {
            return $recurringOrder->OriginatingOrderId;
        } else {
            //find all Orders with a matching JobRecurringId and put them in this array, sorted by date.
            $matchingOrders = DataService::queryWithOrderBy(new Job(), array('JobRecurringId' => $recurringOrderId),'DateCreated');

            if (!empty($matchingOrders)){
                $earliestMatchingOrder = array_shift($matchingOrders);
                return $earliestMatchingOrder->Id;
            } else {
                return false;
            }

        }
    }

    public static function getLastOrderId ($recurringOrderId) {
        //find all Orders with a matching JobRecurringId and put them in this array, sorted by date.
        $matchingOrders = DataService::queryWithOrderBy(new Job(), array('JobRecurringId' => $recurringOrderId),'DateCreated', false);

        if (empty($matchingOrders)){
            $subscription = new RecurringOrder($recurringOrderId);
            if ($subscription->OriginatingOrderId != null){
                $matchingOrders[] = new Job($subscription->OriginatingOrderId);
            }
        }
        if (!empty($matchingOrders)){
            $latestMatchingOrder = array_shift($matchingOrders);
            return $latestMatchingOrder->Id;
        } else {
            return false;
        }
    }

    public static function getSubscriptionFromOrder($orderId){
        try{
            $order = new Job($orderId);
            if (!empty($order->JobRecurringId)){
                return new RecurringOrder($order->JobRecurringId);
            } else {
                $subscription = DataService::query(new RecurringOrder(), array('OriginatingOrderId' => $orderId));
                if (!empty($subscription)){
                    return $subscription[0];
                } else {
                    return false;
                }
            }
        } catch (Exception $e){
            CakeLog::write('error', 'getSusbscriptionIdForOrder failed to get the Order! orderId: ' . $orderId);
            return false;
        }
    }
}