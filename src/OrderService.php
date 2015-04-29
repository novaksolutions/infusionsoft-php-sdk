<?php
namespace NovakSolutions\Infusionsoft;

class OrderService extends Service {
    /**
     * Copy an existing RecurringOrder to a new date and mark the old one as Inactive.
     * @param int $orderId The ID of the RecurringOrder to replicate
     * @param string $newStartDate String date of when to start the new RecurringOrder
     * @param string $nextBillDate Optional, string date of when to set the NextBillingDate on the new RecurringOrder
     * @return bool|RecurringOrder The newly created RecurringOrder object, or false if there was a problem.
     */
    public static function rescheduleRecurringOrder($orderId, $newStartDate, $nextBillDate = null) {
        // Attempt to load the order
        $order = DataService::query(new RecurringOrder(), array('Id' => $orderId));
        $order = array_shift($order);
        if (count($order) == 0) {
            return false;
        }
        // Create a new recurring order based on existing data
        $newOrder = new RecurringOrder();
        foreach ($order->getFields() as $field) {
            $newOrder->{$field} = $order->{$field};
        }
        $startDate = date('Ymd\TH:i:s', strtotime($newStartDate));
        $nextBillDate = date('Ymd\TH:i:s', strtotime(($nextBillDate == null) ? $newStartDate : $nextBillDate)); // Use an optional next bill date, otherwise use the start date
        $newOrder->Id = null;
        $newOrder->StartDate = $startDate;
        $newOrder->Status = 'Active';
        $newOrder->ReasonStopped = 'This order will stop billing on the billing end date.';
        $newOrder->LastBillDate = '';
        $newOrder->PaidThruDate = '';
        //NextBillDate is set farther down

        // We will look for properly named custom fields to automatically update references
        if (in_array('_OriginalSubscriptionId', $order->getFields())) {
            $newOrder->_OriginalSubscriptionId = strval($order->Id);
        }

        $newOrder->save(); // Wanted to limit to one save operation.  Id is required for next custom field.

        if (in_array('_NewSubscriptionId', $order->getFields())) {
            $order->_NewSubscriptionId = strval($newOrder->Id);
        }
        // The new subscription has been saved.  Make API call to change next bill date
        try {
            InvoiceService::updateJobRecurringNextBillDate($newOrder->Id, $nextBillDate);
        } catch (Exception $e) {
            CakeLog::write('error', "Problem updating next billing date on subscription.  Id: {$newOrder->Id}, Date: {$startDate}, Error: ".$e->getMessage());
        }
        // Attempt to create invoices for the subscription
        try {
            InvoiceService::createInvoiceForRecurring($newOrder->Id);
        } catch (Exception $e) {
            CakeLog::write('error', "Problem creating invoices for new subscription. Id: {$newOrder->Id}, Error: ".$e->getMessage());
        }
        // Mark original subscription as inactive
        $order->Status = 'Inactive';
        $order->ReasonStopped = "Subscription updated on ".date('m/d/Y')." to new subscription. ID: {$newOrder->Id}";
        $order->save();
        return new RecurringOrder($newOrder->Id);
    }

    /**
     * Copy an existing RecurringOrder to a new date and delete the existing recurring order AND ALL INVOICES/ORDERS ATTACHED
     * @param int $orderId The ID of the RecurringOrder to replicate
     * @param string $newStartDate String date of when to start the new RecurringOrder
     * @param string $nextBillDate Optional, string date of when to set the NextBillingDate on the new RecurringOrder
     * @return bool|RecurringOrder The newly created RecurringOrder object, or false if there was a problem.
     */
    public static function rescheduleRecurringOrderWithDelete($orderId, $newStartDate, $nextBillDate = null) {
        $newOrder = self::rescheduleRecurringOrder($orderId, $newStartDate, $nextBillDate);
        // Make API call to delete the old subscription, THIS REMOVES ALL INVOICES AND ORDERS AS WELL!
        try {
            InvoiceService::deleteSubscription($orderId);
        } catch (Exception $e) {
            CakeLog::write('error', "Problem deleting existing subscription.  Id: {$orderId}, Error: ".$e->getMessage());
        }
        return $newOrder;
    }

    public static function placeOrder($contactId, $creditCardId, $payPlanId, $productIds, $subscriptionPlanIds, $processSpecials, $promoCodes, $leadAffiliateId = 0, $affiliatedId = 0, App $app = null){
        $params = array(
            (int) $contactId,
            (int) $creditCardId,
            (int) $payPlanId,
            $productIds,
            $subscriptionPlanIds,
            (boolean) $processSpecials,
            $promoCodes,
            $leadAffiliateId,
            $affiliatedId
        );
        return parent::send($app, "OrderService.placeOrder", $params);
    }
}