<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Command to execute the JAR file
    $command = 'java -jar EntityRequestUtility.jar 2> error.log';
    
    // Execute the command and capture the output in $output array
    exec($command, $output, $return_var);

    // Convert the output array to a string
    $outputString = implode("\n", $output);

    // Check if the execution was successful
    if ($return_var === 0) {
        // Extract TransactionId
        preg_match("/TransactionId: ([\w:-]+)/", $outputString, $transactionIdMatches);
        $transactionId = $transactionIdMatches[1] ?? 'Not found';

        // Extract AuthKey
        preg_match("/AuthKey: (\w+)/", $outputString, $authKeyMatches);
        $authKey = $authKeyMatches[1] ?? 'Not found';

        // Extract signature
        preg_match("/signature: ([\w\/+\-=:]+)/", $outputString, $signatureMatches);
        $signature = $signatureMatches[1] ?? 'Not found';

        // Extract Encryption output
        preg_match("/Encryption output: ([\w\/+\-=:]+)\s/", $outputString, $encryptionOutputMatches);
        $encryptedRequest = $encryptionOutputMatches[1] ?? 'Not found';

        // Extract JSON string and parse it
        preg_match("/json string: (\{.*?\})/", $outputString, $jsonStringMatches);
        $jsonString = $jsonStringMatches[1] ?? '{}';
        $jsonData = json_decode($jsonString, true);
        $entityCode = $jsonData['entityCode'] ?? 'Not found';

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        try {
            /* API call started */

            // Define API URL and headers
            $url = 'https://test1.tin-nsdl.com/paam/redirectToFullFormApp.html';
            $headers = [
                "Content-Type: application/json",
                "EntityCode: $entityCode",
                "TransactionId: $transactionId",
                "AuthKey: $authKey",
                "User-Agent: $userAgent"
            ];

            // Define the request body
            $data = [
                "encryptedRequest" => $encryptedRequest,
                "Signature" => $signature
            ];

            // Initialize cURL session
            $ch = curl_init($url);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Ensure POST method
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_SLASHES));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true); // Ensure this is set to true
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);  // Timeout in seconds

            // Execute the request and capture the response
          echo  $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                throw new Exception('Request Error: ' . curl_error($ch));
            } else {
                // Get the information about the request
                $info = curl_getinfo($ch);

                // Debugging: Print the information about the request
                echo '<pre>';
                print_r($info);
                echo '</pre>';

                // Extract the final URL
                $finalUrl = $info['url'];

                // Debugging: Print the final URL
                echo "Final URL: $finalUrl<br>";

                // Close the cURL session
                curl_close($ch);

                // Redirect to the final URL if it is set
                if (!empty($finalUrl)) {
                    //header("Location: $finalUrl");
                    exit();
                } else {
                    echo "Final URL is not set.";
                }
            }
        } catch (Exception $e) {
            echo 'cURL Error: ' . $e->getMessage();
            error_log($e->getMessage());
        }

    } else {
        echo "Execution failed with status $return_var\n";
        echo "Error log:\n";
        // Read and print the error log
        $errorLog = file_get_contents('error.log');
        echo nl2br($errorLog);
    }
} catch (Exception $e) {
    // Handle exceptions by displaying or logging the error message
    echo 'Error: ' . $e->getMessage();
    // Optionally log the error details somewhere
    error_log($e->getMessage());
}
?>
