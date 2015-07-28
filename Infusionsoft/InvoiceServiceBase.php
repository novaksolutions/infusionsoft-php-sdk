<?php
class Infusionsoft_InvoiceServiceBase extends Infusionsoft_Service{

    public static function addManualPayment($invoiceId, $amt, $paymentDate, $paymentType, $paymentDescription, $bypassCommissions, Infusionsoft_App $app = null){
        $params = array(
            (int) $invoiceId, 
            (double) $amt,
            date('Ymd\TH:i:s', strtotime($paymentDate)),
            (string) $paymentType,
            (string) $paymentDescription,
            (boolean) $bypassCommissions
        );

        return parent::send($app, "InvoiceService.addManualPayment", $params);
    }
    
    public static function addOrderCommissionOverride($invoiceId, $affiliateId, $productId, $percentage, $amount, $payoutType, $description, $date, Infusionsoft_App $app = null){
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
    
    public static function addOrderItem($invoiceId, $productId, $type, $price, $quantity, $description, $notes, Infusionsoft_App $app = null){
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
    
    public static function addPaymentPlan($invoiceId, $autoCharge, $creditCardId, $merchantAccountId, $daysBetweenRetry, $maxRetry, $initialPmtAmt, $initialPmtDate, $planStartDate, $numPmts, $daysBetweenPmts, Infusionsoft_App $app = null){
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
    
    public static function addRecurringCommissionOverride($recurringinvoiceId, $affiliateId, $amount, $payoutType, $description, Infusionsoft_App $app = null){
        $params = array(
            (int) $recurringinvoiceId, 
            (int) $affiliateId, 
            (double) $amount, 
            (int) $payoutType, 
            $description
        );

        return parent::send($app, "InvoiceService.addRecurringCommissionOverride", $params);
    }
    
    public static function addRecurringOrder($contactId, $allowDuplicate, $cProgramId, $qty, $price, $allowTax, $merchantAccountId, $creditCardId, $affiliateId, $daysTillCharge, Infusionsoft_App $app = null){
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
    
    public static function calculateAmountOwed($invoiceId, Infusionsoft_App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.calculateAmountOwed", $params);
    }
    
    public static function recalculateTax($invoiceId, Infusionsoft_App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.recalculateTax", $params);
    }
    
    public static function chargeInvoice($invoiceId, $notes, $creditCardId, $merchantAccountId, $bypassCommissions, Infusionsoft_App $app = null){
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
    
    public static function createBlankOrder($contactId, $description, $orderDate, $leadAffiliateId = 0, $saleAffiliateId = 0, Infusionsoft_App $app = null){
        $params = array(
            (int) $contactId, 
            $description,
            date('Ymd\TH:i:s', strtotime($orderDate)),
            (int) $leadAffiliateId, 
            (int) $saleAffiliateId
        );

        return parent::send($app, "InvoiceService.createBlankOrder", $params);
    }
    
    public static function getInvoiceId($orderId, Infusionsoft_App $app = null){
        $params = array(
            (int) $orderId
        );

        return parent::send($app, "InvoiceService.getInvoiceId", $params);
    }
    
    public static function getOrderId($invoiceId, Infusionsoft_App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.getOrderId", $params);
    }
    
    public static function createInvoiceForRecurring($recurringOrderId, Infusionsoft_App $app = null){
        $params = array(
            (int) $recurringOrderId
        );

        return parent::send($app, "InvoiceService.createInvoiceForRecurring", $params);
    }
    
    public static function hello(Infusionsoft_App $app = null){
        $params = array(
        );

        return parent::send($app, "InvoiceService.hello", $params);
    }
    
    public static function locateExistingCard($contactId, $last4, Infusionsoft_App $app = null){
        $params = array(
            (int) $contactId, 
            $last4
        );

        return parent::send($app, "InvoiceService.locateExistingCard", $params);
    }
    
    public static function validateCreditCard($creditCardId, Infusionsoft_App $app = null){
        $params = array(
            (int) $creditCardId
        );

        return parent::send($app, "InvoiceService.validateCreditCard", $params);
    }

    public static function validateCreditCardData(array $creditCardData, Infusionsoft_App $app = null){
        $params = array(
            $creditCardData
        );

        return parent::send($app, "InvoiceService.validateCreditCard", $params);
    }

    public static function setInvoiceSyncStatus($id, $syncStatus, Infusionsoft_App $app = null){
        $params = array(
            (int) $id, 
            (boolean) $syncStatus
        );

        return parent::send($app, "InvoiceService.setInvoiceSyncStatus", $params);
    }
    
    public static function setPaymentSyncStatus($id, $syncStatus, Infusionsoft_App $app = null){
        $params = array(
            (int) $id, 
            (boolean) $syncStatus
        );

        return parent::send($app, "InvoiceService.setPaymentSyncStatus", $params);
    }
    
    public static function getPluginStatus($fullyQualifiedClassName, Infusionsoft_App $app = null){
        $params = array(
            $fullyQualifiedClassName
        );

        return parent::send($app, "InvoiceService.getPluginStatus", $params);
    }
    
    public static function getPayments($invoiceId, Infusionsoft_App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.getPayments", $params);
    }
    
    public static function getAllPaymentOptions(Infusionsoft_App $app = null){
        $params = array(
        );

        return parent::send($app, "InvoiceService.getAllPaymentOptions", $params);
    }
    
    public static function updateJobRecurringNextBillDate($jobRecurringId, $newNextBillDate, Infusionsoft_App $app = null){
        $params = array(
            (int) $jobRecurringId,
            date('Ymd\TH:i:s', strtotime($newNextBillDate))
        );

        return parent::send($app, "InvoiceService.updateJobRecurringNextBillDate", $params);
    }
    
    public static function getInvoiceQuickbooksIIF($invoiceId, Infusionsoft_App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.getInvoiceQuickbooksIIF", $params);
    }
    
    public static function deleteSubscription($subscriptionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $subscriptionId
        );

        return parent::send($app, "InvoiceService.deleteSubscription", $params);
    }
    
    public static function deleteInvoice($invoiceId, Infusionsoft_App $app = null){
        $params = array(
            (int) $invoiceId
        );

        return parent::send($app, "InvoiceService.deleteInvoice", $params);
    }
    
}
