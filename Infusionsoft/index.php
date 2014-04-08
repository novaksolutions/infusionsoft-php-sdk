<html>

<head>
    <title>Infusionsoft PHP SDK</title>
</head>

<body>
    <h1>Installation</h1>

    <p>Copy the <strong>config.sample.php</strong> file to <strong>config.php</strong> and set your API key and app hostname. This needs to be your complete app hostname, for example <strong>joey.infusionsoft.com</strong>.</p>

    <p>Test your settings by clicking on this link: <a href="tests/testConnectivity.php">Test Connectivity</a></p>

    <h1>WARNINGS</h1>
    <ul>
        <li>Saving a record when you didn't retrieve all the fields will erase data.</li>
    </ul>

    <h1>Example Scripts (These will work once you create your config.php file)</h1>
    <ul>
        <li><a href="examples/list_objects.php">List Objects</a></li>
        <li><a href="examples/object_editor.php">Object Editor</a></li>
        <li><a href="examples/contact_tree.php">View Contact Data Tree</a></li>
        <li><a href="examples/subscription_tree.php">View Subscription Order Tree</a></li>
        <li><a href="examples/create_order.php">Add Subscription To Contact</a></li>
        <li><a href="examples/exporter.php">Exporter</a></li>
        <li><a href="examples/leadscoring.php">Lead Scoring</a></li>
        <li><a href="examples/get_invoices_for_contact.php">List All Invoices For A Contact</a></li>
    </ul>

    <h1>Admin Utilities</h1>
    <ul>
        <li>Utilities
            <ul>
                <li><a href="tests/qa_tests.php" target="_blank">Set App Info For Tests</a></li>
                <li><a href="utilities/code_generator.php" target="_blank">Code Generator</a></li>
            </ul>
        </li>

        <li>Automatic Tests
            <ul>
                <li><a href="tests/testContactService.php">Test ContactService</a></li>
                <li><a href="tests/testDataService.php">Test DataService</a></li>
                <li><a href="tests/testWebFormService.php">Test WebFormService</a></li>
                <li><a href="tests/testConnectivity.php">Test Connectivity</a></li>
            </ul>
        </li>

        <li>Tests That Require User Input
            <ul>
                <li><a href="tests/notAuto_test_getEmailTemplate.php">Explore Templates</a></li>
                <li><a href="tests/notAuto_testCChargeAccess.php">Test CCharge Access</a></li>
            </ul>
        </li>

        <li>
            <a href="admin/generate_classes_from_API_Field_access_file.php">Generate DataServiceObjects from API_Field_Access.xml</a>
        </li>
    </ul>
</body>

</html>