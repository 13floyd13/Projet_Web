<link rel="stylesheet" href="../view/design/actus.css">
<link rel="stylesheet" href="../view/design/nouvelle.css">
<div id="actus">
    <?php
    foreach($nouvelles as $nouvelle) {
    require('../view/nouvelle.view.php');
    }
    ?>
</div>
