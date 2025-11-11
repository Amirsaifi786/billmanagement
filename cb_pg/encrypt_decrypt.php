<?php

function encryptDataGCM($data, $keyWithIv) {
    if (!is_string($data)) {
        $data = json_encode($data); // Convert to JSON string if it's not a string
    }

    $key = hex2bin(substr($keyWithIv, 0, 64)); // First 64 hex chars (32 bytes) for key
    $iv = hex2bin(substr($keyWithIv, 64)); // Remaining 24 hex chars (12 bytes) for IV

    $cipher = openssl_encrypt(
        $data,
        'aes-256-gcm',
        $key,
        OPENSSL_RAW_DATA,
        $iv,
        $tag
    ); 
    // Return the encrypted data and the authentication tag
    return [
        'data' => base64_encode($cipher),
        'authTag' => base64_encode($tag),
    ];
}

// Example usage
// $data = [
//     "amount" => "amount",
//     "remark" => "test",
//     "refId" => "Client unique Ref ID" // Replace with an actual UUID if needed
// ];

// $keyWithIv = "encryption key";

// $result = encryptDataGCM($data, $keyWithIv);

// echo "Encrypted Data: " . $result['encryptedData'] . "
// ";
// echo "Auth Tag: " . $result['authTag'] . "
// ";


function decryptDataGCM($encryptedData, $keyWithIv, $authTag) {
    try {
        // Convert the key and IV from hexadecimal to binary
        $key = hex2bin(substr($keyWithIv, 0, 64)); // First 64 hex chars for key
        $iv = hex2bin(substr($keyWithIv, 64)); // Remaining 24 hex chars for IV
        $authTag = base64_decode($authTag);

        // Decrypt using AES-256-GCM
        $encryptedData = base64_decode($encryptedData);
        $decryptedData = openssl_decrypt($encryptedData, 'aes-256-gcm', $key, OPENSSL_RAW_DATA, $iv, $authTag);
        
        if ($decryptedData === false) {
            throw new Exception("Decryption failed");
        }

        // Return the decrypted data as an associative array
        return json_decode($decryptedData, true);
    } catch (Exception $e) {
        echo "Decryption failed: " . $e->getMessage();
        return null;
    }
}

// Example usage
// $encryptedData = "encrypted_data received in intent creation API";
// $keyWithIv = "encryption Key";zJt9dhJl1O3de2Nh1wOPaDrRfkFVJBX5sZF1jQTlf8szzmlHx3kPqsb3ieEeZ30c // Replace with actual key with IV
// $authTag = "auth tag received in intent Creation API"; // Replace with actual auth tag

// $decryptedData = decryptDataGCM($encryptedData, $keyWithIv, $authTag);
// print_r($decryptedData);


?>