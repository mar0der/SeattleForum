<!doctype html>
<html>
    <head>
        <title><?= (isset($this->title)) ? $this->title : 'MVC'; ?></title>
        <link rel="stylesheet" href="<?php echo $this->url; ?>css/default.css" />    
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
        <?php
        if (isset($this->js)) 
	{
            foreach ($this->js as $js) 
	    {
                echo "<script type=\"text/javascript\" src=\"/js/" . $js . "\"></script>\n";
            }
        }
        ?>
    </head>
    <body>
        <header>
            <?php Menu::renderMainMenu(); ?>
	    <div class="logged-user"> Hello, <?php Menu::renderLoggedUser(); ?>!</div>
        </header>
        <main class="clearfix">