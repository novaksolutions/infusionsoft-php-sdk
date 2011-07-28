<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.js"></script>
    <script stype="text/javascript">
        /*
            Retrieved from
            http://remysharp.com/2007/03/19/a-few-more-jquery-plugins-crop-labelover-and-pluck/#labelOver
         */
        jQuery.fn.labelOver = function(overClass) {
            return this.each(function(){
                var label = jQuery(this);
                var f = label.attr('for');
                if (f) {
                    var input = jQuery('#' + f);

                    this.hide = function() {
                      label.css({ display: 'none' })
                    }

                    this.show = function() {
                      if (input.val() == '') label.css({ display: '' })
                    }

                    // handlers
                    input.focus(this.hide);
                    input.blur(this.show);
                  label.addClass(overClass).click(function(){ input.focus() });

                    if (input.val() != '') this.hide();
                }
            })
        }

        jQuery(function(){
            jQuery('label').labelOver();
            jQuery('[name=startDate]').datepicker({dateFormat: 'yy-mm-dd'});
        });
    </script>

    <style>
        label.over-apply {
            color: #ccc;
            position: absolute;
            top: 3px;
            left: 5px;
        }
    </style>
</head>
<body>
<form>
    Field to filter by: <input type="text" name="dateField" value="<?=isset($_GET['dateField']) ? $_GET['dateField'] : 'DateCreated'?>"> </br>
    Start Date: <input type="text" name="startDate" value="<?=isset($_GET['startDate']) ? $_GET['startDate'] : date("Y-m-d")?>"></br>
    Plus Minus Days:
    <select name="dayDelta">
        <option <?=isset($_GET['dayDelta']) && $_GET['dayDelta'] == -5 ? 'selcted' : ''?>>-5</option>
        <option>-4</option>
        <option>-3</option>
        <option>-2</option>
        <option>-1</option>
        <option>0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>


    </select><br/>
    <input type="submit">
    <input type="hidden" name="go">
</form>

<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
    $dayDelta = $_GET['dayDelta'];
    if($dayDelta < 0){
        $start = $dayDelta;
        $end = 0;
    } else {
        $start = 0;
        $end = $dayDelta;
    }

    $startDate = $_GET['startDate'];
    $dateField = $_GET['dateField'];
    
    $contacts = array();
    for($i=$start;$i<=$end;$i++){
        $date = date('Y-m-d', strtotime($startDate) + $i * 24 * 60 * 60);
        $newContacts = Infusionsoft_DataService::queryWithOrderBy(new Infusionsoft_Contact(), array($dateField=>$date . '%'), $dateField, false);
        echo 'Found ' . count($newContacts) . ' where ' . $dateField . ' is ' . $date . '<br/>';
        $contacts = array_merge($contacts, $newContacts);
    }

	var_dump($contacts);
}
?>
</body>
</html>
