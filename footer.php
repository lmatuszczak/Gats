<?php

echo '<div class="text-light"  id="footer">
<p class="text-center"> Super Forum 2022 | Wszelkie prawa zastrzeżone </p>
</div>'
?>

<?php
if(isset($_SESSION['userLog'])) echo $_SESSION['userLog'];
?>