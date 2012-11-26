<?php
include('../infusionsoft.php');
include('object_editor_all_tables.php');
include('../tests/testUtils.php');

if(isset($_POST['contactid'])){
    $recurring_order_id = Infusionsoft_InvoiceService::addRecurringOrder($_POST['contactid'], true, $_POST['subscriptionplanid'], 0, .01, false, 0, 0, 0, 0);
    $recurringOrder = new Infusionsoft_RecurringOrder($recurring_order_id);
    $recurringOrder->StartDate = date('Y-m-d H:i:s', strtotime("-1 month"));
    $recurringOrder->PaidThruDate = date('Y-m-d H:i:s', strtotime("-1 month"));
    $recurringOrder->save();
    echo "<h1>Subscription Created: $recurring_order_id</h1>";
}

?>
<h1>Create Subscription</h1>
<form method="post">
        Contact Id: <input type="text" name="contactid" value="1459" placeholder="Contact Id"/><br/>
        SubscriptionPlanId: <input type="text" name="subscriptionplanid" value="33" placeholder="Subscription Plan / CProgram Id"/><br/>
        <input type="submit">
</form>
