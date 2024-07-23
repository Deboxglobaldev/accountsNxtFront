<?php
// Enable error reporting
//echo 'jjjjjjjjjjjjjjjj';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Command to execute the JAR file
$command = 'java -jar EntityRequestUtility.jar 2> error.log';

// Try block for general exception handling
try {
    // Execute the command and capture the output in $output array
    exec($command, $output, $return_var);

    // Convert the output array to a string
    $jarOutput = implode("\n", $output);

    // Check if the execution was successful
    if ($return_var === 0) {
        // Output the results from the JAR file
        echo $jarOutput;
    } else {
        // Handle the error situation
        echo "Execution failed with status $return_var\n";
        echo "Error log:\n";

        // Optionally read and print the error log contents
        $errorLog = file_get_contents('error.log');
        echo $errorLog;
    }

    // Example of potential other operations that might throw exceptions
    // SomeOtherFunction(); // Uncomment if you have other functions that might throw an exception

} catch (Exception $e) {
    // Catch and handle any thrown exceptions here
    echo "Caught exception: " . $e->getMessage();
}
