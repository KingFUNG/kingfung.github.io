<html>
<head><title>some title</title></head>
<body>
<form method="post" action="">
<input type="text" name="something" value="<?= isset($_POST['something']) ? htmlspecialchars($_POST['something']) : '' ?>" />
<input type="submit" name="submit" />
</form>

<?php
    if(isset($_POST['submit']) && $_POST['something'] == "group6") {
        echo '<a href="https://docs.google.com/spreadsheets/d/1U9gte6gmJ-c3fPrD1OqnhEuZTpNZJW3XO68UsPL1ZiA/edit?usp=sharing">free time slots</a><br><a href="https://docs.google.com/spreadsheets/d/1ajX6rl6xmUuV34sf9tdrEsrnOU4t7dBrQr21d0fNlJg/edit?usp=sharing">duty</a><br><br><a href="https://docs.google.com/spreadsheets/d/11LHsn1LEpisv-8uk3MS-5lzX56YFhFPMwXnLy_SuDX8/edit?usp=sharing">timesheet</a><br><a href="https://docs.google.com/spreadsheets/d/1Hpc6BhW4NGdsLoQkhq7X_XA5RVKqBTRnjJmIGvIHKPk/edit?usp=sharing">risk register</a><br><a href="https://docs.google.com/spreadsheets/d/1edARj-hVBHVAuY7sWDHGgBtGb2r97R_9jUSq0X100Ik/edit?usp=sharing">issue register</a><br><a href="https://docs.google.com/spreadsheets/d/1gx3bDdroHDfvXmj_bH-B-krq-qv0O8bYFazYjK_0G5k/edit?usp=sharing">quality register</a>';
    }
    ?>
</body>
<html>


