<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

class EntityRequestUtility {
    private $command = 'java -jar EntityRequestUtility.jar 2> error.log';
    private $output;
    private $return_var;

    public function executeCommand() {
        exec($this->command, $this->output, $this->return_var);
    }

    public function processOutput() {
        $outputString = implode("\n", $this->output);

        if ($this->return_var === 0) {
            $this->extractValues($outputString);
        } else {
            echo "Execution failed with status {$this->return_var}\n";
            echo "Error log:\n";
            $errorLog = file_get_contents('error.log');
            echo nl2br($errorLog);
        }
    }

    private function extractValues($outputString) {
        preg_match("/TransactionId: ([\w:-]+)/", $outputString, $transactionIdMatches);
        $transactionId = $transactionIdMatches[1] ?? null;

        preg_match("/AuthKey: (\w+)/", $outputString, $authKeyMatches);
        $authKey = $authKeyMatches[1] ?? null;

        preg_match("/signature: ([\w\/+\-=:]+)/", $outputString, $signatureMatches);
        $signature = $signatureMatches[1] ?? null;

        preg_match("/Encryption output: ([\w\/+\-=:]+)\s/", $outputString, $encryptionOutputMatches);
        $encryptedRequest = $encryptionOutputMatches[1] ?? null;

        preg_match("/json string: (\{.*?\})/", $outputString, $jsonStringMatches);
        $jsonString = $jsonStringMatches[1] ?? '{}';
        $jsonData = json_decode($jsonString, true);
        $entityCode = $jsonData['entityCode'] ?? null;

        if ($transactionId && $authKey && $signature && $encryptedRequest && $entityCode) {
            $this->callApi($transactionId, $authKey, $signature, $encryptedRequest, $entityCode);
        } else {
            echo "Required values not found in JAR output.\n";
        }
    }

    private function callApi($transactionId, $authKey, $signature, $encryptedRequest, $entityCode) {
        $redirect = $_SERVER['HTTP_USER_AGENT'];

        $url = 'https://test1.tin-nsdl.com/paam/redirectToFullFormApp.html';
        $headers = [
            "Content-Type: application/json",
            "EntityCode: $entityCode",
            "TransactionId: $transactionId",
            "AuthKey: $authKey",
            "User-Agent: $redirect"
        ];

        $data = [
            "encryptedRequest" => $encryptedRequest,
            "Signature" => $signature
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_SLASHES));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        try {
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception('Request Error: ' . curl_error($ch));
            } else {
                $info = curl_getinfo($ch);
//echo '<pre>';print_r($info);die;
                $requestHeaders = curl_getinfo($ch, CURLINFO_HEADER_OUT);
//echo $respondeURL = $info['url'];die;
                $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);//die;
                header("Location: $finalUrl");
            }
        } catch (Exception $e) {
            echo 'cURL Error: ' . $e->getMessage();
            error_log($e->getMessage());
        }

        curl_close($ch);
    }
}

// Example usage:
$request = new EntityRequestUtility();
$request->executeCommand();
$request->processOutput();
?>
