<?php

function simple_encrypt(array $data, string $key): string {

    $encodedData = base64_encode(json_encode($data));

    $encodedKey = base64_encode($key);

    $firstPartEncodedData = substr($encodedData, 0, 3);
    $secondPartEncodedData = substr($encodedData, 3);

    return $firstPartEncodedData . $encodedKey . $secondPartEncodedData;
}

function simple_decrypt(string $encryptedData, string $key): array {

    $encodedKey = base64_encode($key);

    $firstPartEncodedData = substr($encryptedData, 0, 3);
    $encodedKey = substr($encryptedData, 3, strlen($encodedKey));
    $secondPartEncodedData = substr($encryptedData, 3 + strlen($encodedKey));

    $encodedData = $firstPartEncodedData . $secondPartEncodedData;
    return json_decode(base64_decode($encodedData), true);
}



function checkEmail(string $email): bool {
    if (empty($email)){
        return false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
