<!DOCTYPE html>
<html lang="<?=$config['website']['lang-doc']?>">
<head>
    <?php include TEMPLATE.LAYOUT."head.php"; ?>
    <?php include TEMPLATE.LAYOUT."css.php"; ?>
</head>
<body>
    <?php
    include TEMPLATE.LAYOUT."seo.php";
    //include TEMPLATE.LAYOUT."header.php";
    include TEMPLATE.$template."_tpl.php"; 
    include TEMPLATE.LAYOUT."modal.php";
    include TEMPLATE.LAYOUT."js.php";
    ?>
</body>
</html>