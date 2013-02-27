<?php
class Infusionsoft_InvoiceService extends Infusionsoft_InvoiceServiceBase{
    public static function chargeInvoiceArbitraryAmount($invoiceId, $cardId, $amount, $merchantAccountId){
    //Go fetch the invoice and get the contact id...
        $invoice = new Infusionsoft_Invoice($invoiceId);

    //Create a new order (InvoiceService.blankOrder...
        $dummyInvoiceId = Infusionsoft_InvoiceService::createBlankOrder($invoice->ContactId, "API invoice :" . $amount, date('Ymd\TH:i:s'));

    //Add an order item that is the correct amount you want to charge...
        Infusionsoft_InvoiceService::addOrderItem($invoiceId, 0, 3, $amount, 1, "API order", "");
    //Set orders custom field "_ChargeStatus" to "Pending"
        $dummyOrder = new Infusionsoft_Job(Infusionsoft_InvoiceService::getOrderId($dummyInvoiceId));
        $dummyOrder->OrderStatus = "Pending";
        $dummyOrder->save();
    //Try to charge the invoice
        $result = Infusionsoft_InvoiceService::chargeInvoice($dummyInvoiceId, "API payment", $cardId, $merchantAccountId, false);
    //Update order status "_ChargeStatus" to "Failed", or "Succeeded"

        if($result) {
            //add a credit to the order
            Infusionsoft_InvoiceService::addManualPayment($invoiceId, -$amount, date('Ymd\TH:i:s'), "Credit Card", "API partial payment", false);
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