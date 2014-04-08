<?php
class Infusionsoft_LowLevelInvoiceService extends Infusionsoft_LowLevelMockService{

    public function addOrderItem($args){
        //Remove Api Key
        array_shift($args);
        list($invoiceId, $productId, $type, $price, $quantity, $description, $notes) = $args;

        $invoice = new Infusionsoft_Invoice($invoiceId);
        $product = new Infusionsoft_Product($productId);

        $orderItem = new Infusionsoft_OrderItem();
        $orderItem->CPU = $product->ProductPrice;
        $orderItem->PPU = $product->ProductPrice;
        $orderItem->Qty = $quantity;
        $orderItem->ItemDescription = $description;
        $orderItem->Notes = $notes;
        $orderItem->ProductId = $productId;
        $orderItem->ItemType = $type;
        $orderItem->OrderId = $invoice->JobId;
        $orderItem->save();

        $total = $orderItem->PPU * $orderItem->Qty;

        $invoiceItem = new Infusionsoft_InvoiceItem();
        $invoiceItem->OrderItemId = $orderItem->Id;
        $invoiceItem->InvoiceId = $invoice->Id;
        $invoiceItem->InvoiceAmt = $total;
        $invoiceItem->save();


        $invoice->InvoiceTotal = floatval($invoice->InvoiceTotal) + $total;
        $invoice->TotalDue = floatval($invoice->TotalDue) + $total;
        $invoice->save();

        return $orderItem->Id;
    }

    public function createBlankOrder($args){
        //Remove Api Key
        array_shift($args);
        list($contactId, $description, $orderDate, $leadAffiliateId, $saleAffiliateId) = $args;
        $order = new Infusionsoft_Job();
        $order->OrderType = 1;
        $order->ContactId = $contactId;
        $order->save();

        $invoice = new Infusionsoft_Invoice();
        $invoice->ContactId = $contactId;
        $invoice->DateCreated = date('Y-m-d H:i:s');
        $invoice->JobId = $order->Id;
        $invoice->save();

        return $invoice->Id;
    }

    public function addManualPayment($args) {
        //Remove Api Key
        array_shift($args);
        list($invoiceId, $payAmt, $payDate, $payType, $payNote) = $args;

        $invoice = new Infusionsoft_Invoice($invoiceId);
        $contactId = $invoice->ContactId;

        $payment = new Infusionsoft_Payment();
        $payment->PayAmt  = $payAmt;
        $payment->PayType = $payType;
        $payment->PayDate = $payDate;
        $payment->PayNote = $payNote;
        $payment->ContactId = $contactId;
        $payment->InvoiceId = $invoiceId;
        $payment->save();

        $invoicePayment = new Infusionsoft_InvoicePayment();
        $invoicePayment->InvoiceId = $invoiceId;
        $invoicePayment->PaymentId = $payment->Id;
        $invoicePayment->Amt = $payAmt;
        $invoicePayment->PayDate = $payDate;
        $invoicePayment->save();

        $invoice->TotalPaid = floatval($invoice->TotalPaid) + $payAmt;
        $invoice->save();

        return $payment->Id;
    }
}