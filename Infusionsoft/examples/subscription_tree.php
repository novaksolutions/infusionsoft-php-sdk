<?php
include('../infusionsoft.php');
include('object_editor_all_tables.php');
include('../tests/testUtils.php');

?><br/><?

renderLoadForm();

if (!empty($_GET['OrderItemId'])) {
    $order_item = new Infusionsoft_OrderItem($_GET['OrderItemId']);
    $order = new Infusionsoft_Job($order_item->OrderId);
    $subscription = new Infusionsoft_RecurringOrder($order->JobRecurringId);

    $orders = Infusionsoft_DataService::queryWithOrderBy(new Infusionsoft_Job(), array('JobRecurringId' => $subscription->Id), 'StartDate');

    $order_items = array();
    $invoices = array();
    foreach ($orders as $order) {
        $order_items[$order->Id] = Infusionsoft_DataService::query(new Infusionsoft_OrderItem(), array('OrderId' => $order->Id));
        $invoices[$order->Id] = Infusionsoft_DataService::query(new Infusionsoft_Invoice(), array('JobId' => $order->Id));
        if (is_array($invoices[$order->Id]) && count($invoices[$order->Id]) > 0) {
            $invoice_items[$order->Id] = Infusionsoft_DataService::query(new Infusionsoft_InvoiceItem(), array('InvoiceId' => $invoices[$order->Id][0]->Id));
            $invoice_payments[$order->Id] = Infusionsoft_DataService::query(new Infusionsoft_InvoicePayment(), array('InvoiceId' => $invoices[$order->Id][0]->Id));
            if(count($invoice_payments[$order->Id] > 0)){
                foreach ($invoice_payments[$order->Id] as $invoice_payment) {
                    $invoice_payment_payments[$invoice_payment->Id] = new Infusionsoft_Payment($invoice_payment->PaymentId);
                }
            }
        }
    }

    $contact = new Infusionsoft_Contact($order->ContactId);

    ?><h1>Contact</h1><?
    dumpObject($contact);
    foreach ($orders as $order) {
        ?><h1>Order</h1><?
        dumpObject($order, 1);
        ?><h1>Order Items</h1><?
        foreach($order_items[$order->Id] as $order_item){
            dumpObject($order_item, 2);
        }
        if(isset($invoices[$order->Id][0])){
            ?><h1>Invoice</h1><?
            dumpObject($invoices[$order->Id][0], 2);
            ?><h1>Invoice Items</h1><?
            foreach($invoice_items[$order->Id] as $invoice_item){
                dumpObject($invoice_item, 3);
            }
            foreach ($invoice_payments[$order->Id] as $invoice_payment) {
                dumpObject($invoice_payment, 3);
                dumpObject($invoice_payment_payments[$invoice_payment->Id], 4);
            }
        }
    }
}


function dumpObject($object, $indent = 0)
{
    if(!is_object($object)){
        die();
    }
    $data = $object->toArray();

    ?>
        <div style="padding-left: <?=$indent * 20?>px;">


    <table>
        <thead>
        <tr><?
            foreach ($object->getFields() as $field) {
                ?>
                <th><?=$field?></th>
                <?
            }
            ?></tr>
        </thead>
        <tbody>
        <tr><?
            foreach ($object->getFields() as $field) {
                ?>
                <td><?=htmlentities($data[$field])?></td><?
            }
            ?></tr>
        </tbody>
    </table>
        </div><?
}

function renderLoadForm()
{
    ?>
    <form>
        OrderItem Id: <input type="text" name="OrderItemId"/>
        <input type="submit"/>
    </form>
    <?php
}
