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
        // Display the output
        //echo $outputString;

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

        // Display extracted values
        //echo '<br>';
        echo "TransactionId------- : $transactionId<br>";
        echo "AuthKey----------- : $authKey<br>";
        echo "Signature--------- : $signature<br>";
        echo "encryptionOutput------- : $encryptedRequest<br>";
        echo "entityCode-------- : $entityCode<br>";
//die;
        // Retrieve User-Agent header from client
        $redirect = $_SERVER['HTTP_USER_AGENT'];


        try {
            /* API call started */

            // Define API URL and headers
            $url = 'https://test1.tin-nsdl.com/paam/redirectToFullFormApp.html';
            $headers = [
                "Content-Type: application/json",
                "EntityCode: $entityCode",
                "TransactionId: $transactionId",
                "AuthKey: $authKey",
                "User-Agent: $redirect"
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
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_SLASHES));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For testing only; use true in production
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For testing only; use 2 for strict checking
            curl_setopt($ch, CURLINFO_HEADER_OUT, true); // Capture request headers
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
            curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout in seconds

            // Execute the request and capture the response
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                throw new Exception('Request Error: ' . curl_error($ch));
            } else {
                // Output the response from the server
              //  echo $response;

                // Get additional information
                $info = curl_getinfo($ch);
                //echo '<pre>' . print_r($info, true) . '</pre>';

                // Get the request headers from CURLINFO_HEADER_OUT
                $requestHeaders = curl_getinfo($ch, CURLINFO_HEADER_OUT);
                //echo '<br>Request Headers: <pre>' . $requestHeaders . '</pre>';

                // Get the final redirected URL
                $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
               // echo '<br>Final Redirected URL: ' . $finalUrl;

                // Optionally redirect the user to the final URL
                header("Location: $finalUrl");
            }

            // Close the cURL session
            curl_close($ch);

            /* API call end */
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
