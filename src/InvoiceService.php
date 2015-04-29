<?php
namespace NovakSolutions\Infusionsoft;

class InvoiceService extends Service{
    public static function chargeInvoiceArbitraryAmount($contactId, $invoiceId, $cardId, $amount, $merchantAccountId){

    //Create a new order (InvoiceService.blankOrder...
        $dummyInvoiceId = InvoiceService::createBlankOrder($contactId, "API Arbitrary Payment Invoice: " . $amount, date('Ymd\TH:i:s'));

        try {
            //Add an order item that is the correct amount you want to charge...
            InvoiceService::addOrderItem($dummyInvoiceId, 0, 3, $amount, 1, "API order", "");
            //Set orders custom field "_ChargeStatus" to "Pending"
            $invoice = new Invoice($dummyInvoiceId);
            $dummyOrder = new Job($invoice->JobId);
            $dummyOrder->OrderStatus = "Pending";
            $dummyOrder->save();
            //Try to charge the invoice
            $result = InvoiceService::chargeInvoice($dummyInvoiceId, "API payment", $cardId, $merchantAccountId, false);
        } catch(Exception $e) {
            InvoiceService::deleteInvoice($dummyInvoiceId);
            throw new Exception("Failed to charge partial payment. Infusionsoft says: " . $e->getMessage());
        }
    //Update order status "_ChargeStatus" to "Failed", or "Succeeded"

        if($result['Successful']) {
            //add a credit to the order
            InvoiceService::addManualPayment($invoiceId, $amount, date('Ymd\TH:i:s'), "Credit Card", "API partial payment", false);
            $dummyOrder->OrderStatus = "Successful";
            $dummyOrder->save();

        } else {
            //erase the invoice
            InvoiceService::deleteInvoice($dummyInvoiceId);

        }
        return $result;
        //Update order status to "Applied"
    }

    public static function addManualPayment($invoiceId, $amt, $paymentDate, $paymentType, $paymentDescription, $bypassCommissions, App $app = null){
        $params = array(
            (int) $invoiceId,
            (double) $amt,
            $paymentDate,
            $paymentType,
            $paymentDescription,
            (boolean) $bypassCommissions
        );

        return parent::send($app, "InvoiceService.addManualPayment", $params);
    }

    public static function addOrderCommissionOverride($invoiceId, $affiliateId, $productId, $percentage, $amount, $payoutType, $description, $date, App $app = null){
        $params = array(
            (int) $invoiceId,
            (int) $affiliateId,
            (int) $productId,
            (int) $percentage,
            (double) $amount,
            (int) $payoutType,
            $description,
            $date
        );

        return parent::send($app, "InvoiceService.addOrderCommissionOverride", $params);
    }

    public static function addOrderItem($invoiceId, $productId, $type, $price, $quantity, $description, $notes, App $app = null){
        $params = array(
            (int) $invoiceId,
            (int) $productId,
            (int) $type,
            (double) $price,
            (int) $quantity,
            $description,
            $notes
        );

        return parent::send($app, "InvoiceService.addOrderItem", $params);
    }

    public static function addPaymentPlan($invoiceId, $autoCharge, $creditCardId, $merchantAccountId, $daysBetweenRetry, $maxRetry, $initialPmtAmt, $initialPmtDate, $planStartDate, $numPmts, $daysBetweenPmts, App $app = null){
        $params = array(
            (int) $invoiceId,
            (boolean) $autoCharge,
            (int) $creditCardId,
            (int) $merchantAccountId,
            (int) $daysBetweenRetry,
            (int) $maxRetry,
            (double) $initialPmtAmt,
            $initialPmtDate,
            $planStartDate,
            (int) $numPmts,
            (int) $daysBetweenPmts
        );

        return parent::send($app, "InvoiceService.addPaymentPlan", $params);
    }

    public static function addRecurringCommissionOverride($recurringinvoiceId, $affiliateId, $amount, $payoutType, $description, App $app = null){
        $params = array(
            (int) $recurringinvoiceId,
            (int) $affiliateId,
            (double) $amount,
            (int) $payoutType,
            $description
        );

        return parent::send($app, "InvoiceService.addRecurringCommissionOverride", $params);
    }

    public static function addRecurringOrder($contactId, $allowDuplicate, $cProgramId, $qty, $price, $allowTax, $merchantAccountId, $creditCardId, $affiliateId, $daysTillCharge, App $app = null){
        $params = array(
            (int) $contactId,
            (boolean) $allowDuplicate,
            (int) $cProgramId,
            (int) $qty,
            (double) $price,
            (boolean) $allowTax,
            (int) $merchantAccountId,
            (int) $creditCardId,
            (int) $affiliateId,
            (int) $daysTillCharge
        );

        return parent::send($app, "InvoiceService.addRecurringOrder", $params);
    }

    public static function calculateAmountOwed($invoiceId, App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.calculateAmountOwed", $params);
    }

    public static function recalculateTax($invoiceId, App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.recalculateTax", $params);
    }

    public static function chargeInvoice($invoiceId, $notes, $creditCardId, $merchantAccountId, $bypassCommissions, App $app = null){
        $params = array(
            (int) $invoiceId,
            $notes,
            (int) $creditCardId,
            (int) $merchantAccountId,
            (boolean) $bypassCommissions
        );

        try{
            $result = parent::send($app, "InvoiceService.chargeInvoice", $params);
        } catch(Exception $e){
            if($e->getMessage()=='Error process card.'){
                throw new Exception("Error while charging card, most likely something wrong with the merchant account.  Please try placing a test charge through merchant account id: " . $merchantAccountId);
            } else{
                throw $e;
            }
        }

        return $result;
    }

    public static function createBlankOrder($contactId, $description, $orderDate, $leadAffiliateId = 0, $saleAffiliateId = 0, App $app = null){
        $params = array(
            (int) $contactId,
            $description,
            $orderDate,
            (int) $leadAffiliateId,
            (int) $saleAffiliateId
        );

        return parent::send($app, "InvoiceService.createBlankOrder", $params);
    }

    public static function getInvoiceId($orderId, App $app = null){
        $params = array(
            (int) $orderId
        );

        return parent::send($app, "InvoiceService.getInvoiceId", $params);
    }

    public static function getOrderId($invoiceId, App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.getOrderId", $params);
    }

    public static function createInvoiceForRecurring($recurringOrderId, App $app = null){
        $params = array(
            (int) $recurringOrderId
        );

        return parent::send($app, "InvoiceService.createInvoiceForRecurring", $params);
    }

    public static function hello(App $app = null){
        $params = array(
        );

        return parent::send($app, "InvoiceService.hello", $params);
    }

    public static function locateExistingCard($contactId, $last4, App $app = null){
        $params = array(
            (int) $contactId,
            $last4
        );

        return parent::send($app, "InvoiceService.locateExistingCard", $params);
    }

    public static function validateCreditCard($creditCardId, App $app = null){
        $params = array(
            (int) $creditCardId
        );

        return parent::send($app, "InvoiceService.validateCreditCard", $params);
    }

    public static function validateCreditCardData(array $creditCardData, App $app = null){
        $params = array(
            $creditCardData
        );

        return parent::send($app, "InvoiceService.validateCreditCard", $params);
    }

    public static function setInvoiceSyncStatus($id, $syncStatus, App $app = null){
        $params = array(
            (int) $id,
            (boolean) $syncStatus
        );

        return parent::send($app, "InvoiceService.setInvoiceSyncStatus", $params);
    }

    public static function setPaymentSyncStatus($id, $syncStatus, App $app = null){
        $params = array(
            (int) $id,
            (boolean) $syncStatus
        );

        return parent::send($app, "InvoiceService.setPaymentSyncStatus", $params);
    }

    public static function getPluginStatus($fullyQualifiedClassName, App $app = null){
        $params = array(
            $fullyQualifiedClassName
        );

        return parent::send($app, "InvoiceService.getPluginStatus", $params);
    }

    public static function getPayments($invoiceId, App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.getPayments", $params);
    }

    public static function getAllPaymentOptions(App $app = null){
        $params = array(
        );

        return parent::send($app, "InvoiceService.getAllPaymentOptions", $params);
    }

    public static function updateJobRecurringNextBillDate($jobRecurringId, $newNextBillDate, App $app = null){
        $params = array(
            (int) $jobRecurringId,
            $newNextBillDate
        );

        return parent::send($app, "InvoiceService.updateJobRecurringNextBillDate", $params);
    }

    public static function getInvoiceQuickbooksIIF($invoiceId, App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.getInvoiceQuickbooksIIF", $params);
    }

    public static function deleteSubscription($subscriptionId, App $app = null){
        $params = array(
            (int) $subscriptionId
        );

        return parent::send($app, "InvoiceService.deleteSubscription", $params);
    }

    public static function deleteInvoice($invoiceId, App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.deleteInvoice", $params);
    }

}