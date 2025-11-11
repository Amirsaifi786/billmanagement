<?php


function decrypt($encryptedText, $key, $iv) {
 $decryptedText = null;
 try {
 // Check key length
 $keyLength = strlen($key);
 if (!in_array($keyLength, [16, 24, 32])) {
 throw new Exception("Key length must be 16, 24, or 32 bytes for AES.");
 }
 // Decryption
 $cipher = "aes-".($keyLength * 8)."-gcm";
 // Decode from Base64
 $encryptedBytesWithTag = base64_decode($encryptedText);
 // Split the encrypted bytes and the tag
 $tagLength = 16;
 $encryptedBytes = substr($encryptedBytesWithTag, 0, -$tagLength);
 $tag = substr($encryptedBytesWithTag, -$tagLength);
 // Decrypt the ciphertext
 $decryptedBytes = openssl_decrypt(
 $encryptedBytes,
 $cipher,
 $key,
 OPENSSL_RAW_DATA,
 $iv,
 $tag,
 ""
 );
 if ($decryptedBytes === false) {
 throw new Exception("Decryption failed: " . openssl_error_string());
 }
 $decryptedText = $decryptedBytes;
 } catch (Exception $e) {
 error_log("Decrypt error: " . $e->getMessage());
  }
 return $decryptedText;
}

// The encrypted text (replace with your actual encrypted string)
// $encrypted_text = 'Enter your encrypted string here';
// Decrypt the provided text
// $decrypted_text = decrypt($encrypted_text, $key, $iv);
// echo "Decrypted text:\n";
// echo $decrypted_text;
?>