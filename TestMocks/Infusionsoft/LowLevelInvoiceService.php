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

        $app = Infusionsoft_AppPool::getApp('');
        $orderItem->Id = $app->data->add(array($orderItem->getTable(), $orderItem->toArray()));
        Infusionsoft_SdkEventManager::dispatch(new Infusionsoft_SdkEvent($orderItem, array('result' => $orderItem)), 'DataObject.Saved');

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
        $invoice->TotalPaid = 0;
        $invoice->save();

        return $invoice->Id;
    }

    public function addManualPayment($args) {
        //Remove Api Key
        array_shift($args);
        list($invoiceId, $payAmt, $payDate, $payType, $payNote) = $args;

        $invoice = new Infusionsoft_Invoice($invoiceId);
        $contactId = $invoice->ContactId;

        //Must set an ID on the Payment to avoid the SDK class from calling addManualPayment recursively when Payment is saved.
        $payment = new Infusionsoft_Payment();
        $payment->Id = rand(10000, 100000);
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

        self::updatePaymentPlanForPayment($invoiceId, $payment->PayAmt);

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

        self::updatePaymentPlanForPayment($invoiceId, $payment->PayAmt);
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

    public function addPaymentPlan($args) {
        array_shift($args);
        list($invoiceId, $autoCharge, $creditCardId, $merchantAccountId, $daysBetweenRetry,
            $maxRetry, $initialPmtAmt, $initialPmtDate, $planStartDate, $numberOfPmts, $daysBetweenPmts) = $args;
        $invoice = new Infusionsoft_Invoice($invoiceId);
        $payPlan = new Infusionsoft_PayPlan();
        $payPlan->AmtDue = $invoice->InvoiceTotal;
        $payPlan->DateDue = $initialPmtDate;
        $payPlan->FirstPayAmt = $initialPmtAmt;
        $payPlan->InitDate = $initialPmtDate;
        $payPlan->InvoiceId = $invoiceId;
        $payPlan->StartDate = $planStartDate;
        $payPlan->save();

        $totalPayments = $numberOfPmts + 1;
        $monthlyPaymentAmount = round(($invoice->InvoiceTotal - $initialPmtAmt) / $numberOfPmts, 2);
        for ($i = 0; $i < $totalPayments; $i++) {
            $payPlanItem = new Infusionsoft_PayPlanItem();
            $payPlanItem->PayPlanId = $payPlan->Id;
            $payPlanItem->AmtDue = $i == 0 ? $initialPmtAmt : ($i == ($totalPayments - 1) ? ($invoice->InvoiceTotal - ($initialPmtAmt + ($monthlyPaymentAmount * ($i - 1)))) : $monthlyPaymentAmount);
            $payPlanItem->DateDue = $i == 0 ? $initialPmtDate : ($i == 1 ? $planStartDate : date('Y-m-d', strtotime($planStartDate . ' + ' . $daysBetweenPmts * ($i - 1) . ' days')));
            $payPlanItem->Status = 1;
            $payPlanItem->save();
        }
    }

    private function updatePaymentPlanForPayment($invoiceId, $payAmt)
    {
        $invoice = new Infusionsoft_Invoice($invoiceId);
        $payPlan = Infusionsoft_DataService::query(new Infusionsoft_PayPlan(), ['InvoiceId' => $invoiceId]);
        $payPlan = reset($payPlan);

        $payPlanItems = Infusionsoft_DataService::query(new Infusionsoft_PayPlanItem(), ['PayPlanId' => $payPlan->Id]);

        $totalDue = 0;
        $totalPaid = 0;
        $amountAttributedToPayPlanItem = 0;
        /**
         * @var Infusionsoft_PayPlanItem $payPlanItem
         */
        foreach ($payPlanItems as $payPlanItem) {
            if ($payPlanItem->AmtPaid < $payPlanItem->AmtDue) {
                if ($payPlanItem->AmtDue - $payPlanItem->AmtPaid <= $payAmt - $amountAttributedToPayPlanItem) {
                    $amountAttributedToPayPlanItem += $payPlanItem->AmtDue - $payPlanItem->AmtPaid;
                    $payPlanItem->AmtPaid = $payPlanItem->AmtDue;
                    $payPlanItem->save();
                } elseif ($payAmt - $amountAttributedToPayPlanItem > 0) {
                    $payPlanItem->AmtPaid += $payAmt - $amountAttributedToPayPlanItem;
                    $payPlanItem->save();
                    $amountAttributedToPayPlanItem += $payAmt - $amountAttributedToPayPlanItem;
                }
            }
            if (date('Y-m-d', strtotime($payPlanItem->DateDue)) <= date('Y-m-d')) {
                $totalDue += $payPlanItem->AmtDue;
            }
            if ($payPlanItem->AmtPaid > 0) {
                $totalPaid += $payPlanItem->AmtPaid;
            }
        }
        $invoice->TotalDue = $totalDue;
        $invoice->TotalPaid = $totalPaid;
        $invoice->save();
    }

    public function validateCreditCard($creditCardId)
    {
        return [
            'Valid' => true,
            'Message' => '',
        ];
    }
}