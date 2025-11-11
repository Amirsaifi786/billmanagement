<?php


// ---------- Encryption --------------------
function encrypt($plainText, $key, $iv) {
 $encryptedText = null;
 try {
 // Check key length
 $keyLength = strlen($key);
 if (!in_array($keyLength, [16, 24, 32])) {
 throw new Exception("Key length must be 16, 24, or 32 bytes for AES.");
 }
 // Encryption
 $cipher = "aes-".($keyLength * 8)."-gcm";
 // Encrypt the plaintext
 $tag = '';
 $encryptedBytes = openssl_encrypt(
 $plainText,
 $cipher,
 $key,
 OPENSSL_RAW_DATA,
 $iv,
 $tag,
 "",
 16 // Tag length
 );
 if ($encryptedBytes === false) {
 throw new Exception("Encryption failed: " . openssl_error_string());
 }
 // Concatenate the encrypted bytes and the tag
 $encryptedBytesWithTag = $encryptedBytes . $tag;
 // Encode to Base64 to get a string representation
 $encryptedText = base64_encode($encryptedBytesWithTag);
 } catch (Exception $e) {
 error_log("Encrypt errorr: " . $e->getMessage());
 }
 return $encryptedText;
}
// Example --
// The text you provided
// $plaintext = '
// {
//  "successStatus": true,
//  "message": "Success",
//  "responseCode": "000",
//  "data": [
//  {
//  "description": "Andra Pradesh",
//  "code": "AP "
//  },
//  {
//  "description": "Assam",
//  "code": "AS "
//  }
//  ]
// }
// ';
// Encrypt the provided text
// $encrypted_text = encrypt($plaintext, $key, $iv);
// echo "Encrypted text:\n";
// echo $encrypted_text;
// Optionally, decrypt to verify
//$decrypted_text = decrypt($encrypted_text, $key, $iv);
//echo "\n\nDecrypted text:\n";
//echo $decrypted_text;
?>