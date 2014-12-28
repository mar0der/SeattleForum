<div id="paginator-container">
    <?php
    if ($this->_hasFirstBtn) { //first button design. change the html and css only
        ?>
        <a href="<?= $this->_linkPrefix . "1" ?>" class="page first-page">&lt;&lt;</a>
        <?php
    }
    for ($i = $this->_firstVisiblePage; $i <= $this->_lastVisiblePage; $i++) {
        if ($i == $this->_currentPage) {
            $active = " active"; //active is the name of the class for the active page
        } else {
            $active = "";
        }
        //regular button desing + curren page design
        ?>
        <a href="<?= $this->_linkPrefix . $i ?>" class="page<?= $active ?>"><?= $i ?></a>
        <?php
    }
    if ($this->_hasLastBtn) { //last button design 
        ?>
        <a href="<?= $this->_linkPrefix . $this->_totalPages; ?>" class="page last-page">&gt;&gt;</a>
    <?php } ?>
</div>
