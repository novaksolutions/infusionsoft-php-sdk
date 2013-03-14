<?php
class Infusionsoft_InvoiceService extends Infusionsoft_InvoiceServiceBase{
    public static function chargeInvoiceArbitraryAmount($contactId, $invoiceId, $cardId, $amount, $merchantAccountId){

    //Create a new order (InvoiceService.blankOrder...
        $dummyInvoiceId = Infusionsoft_InvoiceService::createBlankOrder($contactId, "API Arbitrary Payment Invoice: " . $amount, date('Ymd\TH:i:s'));

        try {
            //Add an order item that is the correct amount you want to charge...
            Infusionsoft_InvoiceService::addOrderItem($dummyInvoiceId, 0, 3, $amount, 1, "API order", "");
            //Set orders custom field "_ChargeStatus" to "Pending"
            $invoice = new Infusionsoft_Invoice($dummyInvoiceId);
            $dummyOrder = new Infusionsoft_Job($invoice->JobId);
            $dummyOrder->OrderStatus = "Pending";
            $dummyOrder->save();
            //Try to charge the invoice
            $result = Infusionsoft_InvoiceService::chargeInvoice($dummyInvoiceId, "API payment", $cardId, $merchantAccountId, false);
        } catch(Exception $e) {
            Infusionsoft_InvoiceService::deleteInvoice($dummyInvoiceId);
            throw new Exception("Failed to charge partial payment. Infusionsoft says: " . $e->getMessage());
        }
    //Update order status "_ChargeStatus" to "Failed", or "Succeeded"

        if($result['Successful']) {
            //add a credit to the order
            Infusionsoft_InvoiceService::addManualPayment($invoiceId, $amount, date('Ymd\TH:i:s'), "Credit Card", "API partial payment", false);
            $dummyOrder->OrderStatus = "Successful";
            $dummyOrder->save();

        } else {
            //erase the invoice
            Infusionsoft_InvoiceService::deleteInvoice($dummyInvoiceId);

        }
        return $result;
        //Update order status to "Applied"
}

}