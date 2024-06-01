<?php 
session_start();

echo "<script>
alert('anda telah di logout');
document.location.href = 'login.php';
</script>";
session_destroy();

?>