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
        $orderItem->PPU = $price;
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

        return true;
    }

    public function createBlankOrder($args){
        //Remove Api Key
        array_shift($args);
        list($contactId, $description, $orderDate, $leadAffiliateId, $saleAffiliateId) = $args;
        $order = new Infusionsoft_Job();
        $order->OrderType = 1;
        $order->ContactId = $contactId;
        $app = Infusionsoft_AppPool::getApp('');
        $order->Id = $app->data->add(array($order->getTable(), $order->toArray()));


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

    public function chargeInvoice($args) {
        //Remove Api Key
        array_shift($args);
        list($invoiceId, $notes, $creditCardId, $merchantAccountId, $bypassCommissions) = $args;

        $invoice = new Infusionsoft_Invoice($invoiceId);
        $contactId = $invoice->ContactId;

        $payment = new Infusionsoft_Payment();
        $payment->PayAmt  = $invoice->TotalDue;
        $payment->PayType = 'Credit Card';
        $payment->PayDate = date('YmdTH:i:s', strtotime('now'));
        $payment->PayNote = $notes;
        $payment->ContactId = $contactId;
        $payment->InvoiceId = $invoiceId;
        $payment->save();

        $cCharge = new Infusionsoft_CCharge();
        $cCharge->Amt = $invoice->TotalDue;
        $cCharge->ApprCode = 123456;
        $cCharge->CCId = $creditCardId;
        $cCharge->MerchantId = $merchantAccountId;
        $cCharge->OrderNum = $invoice->JobId;
        $cCharge->PaymentId = $payment->Id;
        $cCharge->save();

        $invoicePayment = new Infusionsoft_InvoicePayment();
        $invoicePayment->InvoiceId = $invoiceId;
        $invoicePayment->PaymentId = $payment->Id;
        $invoicePayment->Amt = $invoice->TotalDue;
        $invoicePayment->PayDate = date('YmdTH:i:s', strtotime('now'));
        $invoicePayment->save();

        $invoice->TotalPaid = floatval($invoice->TotalPaid);
        $invoice->save();

        return $payment->Id;
    }


    public function updateJobRecurringNextBillDate($args){
        array_shift($args);
        list($subscriptionId, $nextBillDate) = $args;
        $subscription = new Infusionsoft_RecurringOrder($subscriptionId);
        $subscription->NextBillDate = $nextBillDate;
        $subscription->save();
        return true;
    }

    public function createInvoiceForRecurring($args){

    }

    public function addRecurringOrder($args){
        array_shift($args);
        list(
            $contactId,
            $allowDuplicate,
            $cProgramId,
            $qty,
            $price,
            $allowTax,
            $merchantAccountId,
            $creditCardId,
            $affiliateId,
            $daysTillCharge
        ) = $args;

        $recurringOrder = new Infusionsoft_RecurringOrder();
        $recurringOrder->ContactId = $contactId;
        $recurringOrder->ProgramId = $cProgramId;
        $recurringOrder->Qty = $qty;
        $recurringOrder->BillingAmt = $price;
        $recurringOrder->MerchantAccountId = $merchantAccountId;
        $recurringOrder->CC1 = $creditCardId;
        $recurringOrder->NextBillDate = date('Y-m-d H:i:s', strtotime("-$daysTillCharge days"));
        $recurringOrder->AffiliateId = $affiliateId;
        $recurringOrder->save();
    }

    public function deleteInvoice($args){
        array_shift($args);
        list($invoiceId) = $args;

        $invoice = new Infusionsoft_Invoice($invoiceId);
        $invoice->delete();

        $order = new Infusionsoft_Job($invoice->JobId);
        $order->delete();

        $orderItems = Infusionsoft_DataService::query(new Infusionsoft_OrderItem(), array('OrderId' => $order->Id));
        foreach($orderItems as $orderItem){
            $orderItem->delete();
        }

        $invoiceItems = Infusionsoft_DataService::query(new Infusionsoft_InvoiceItem(), array('InvoiceId' => $invoiceId));
        foreach($invoiceItems as $invoiceItem){
            $invoiceItem->delete();
        }
    }
}