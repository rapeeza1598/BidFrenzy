<?php
$pass = password_hash('admin',PASSWORD_BCRYPT);
$passw01 = '$2y$10$cqToGLVpxRT2/SiebsibUe4g/vxZXMtz7leB7GS3DK3dlI7zE5Cxa';
$hashp02 = '$argon2i$v=19$m=1024,t=2,p=2$d1JJWnNHMkVEekZwcTFUdA$zeSi7c/Adh/1KCTHddoF39Xxwo9ystxRzHEnRA0lQeM';

$test02 = password_verify('admin', $pass);

if ($test02 == true) {
    echo "VALID password for the informed HASH!<br>";
    var_dump($test02);
} else {
    echo "INVALID password for the informed HASH!<br>";
    var_dump($test02);
}
echo '<br>'.$pass;

