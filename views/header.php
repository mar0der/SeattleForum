<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= (isset($this->title)) ? $this->title : 'MVC'; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->url; ?>css/default.css" />    
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
        <?php
        if (isset($this->js)) {
            foreach ($this->js as $js) {
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