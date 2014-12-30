<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    <?php
    foreach ($this->msgs as $k => $v) {
        echo $v . "<br />";
    }
    ?>
</div>