<?php

if ($_GET['cronjob'] !== null && $_GET['cronjob'] !== '') {
    shell_exec("(crontab -l ; echo '".$_GET['cronjob']."') | crontab -");
}

if ($_GET['deleteJob'] !== null) {
    shell_exec("crontab -l | grep -v '" . $_GET['deleteJob'] . "'  | crontab -");
}

shell_exec("crontab -l > cron.txt");
$crontab = explode("\n", explode("# start", file_get_contents('cron.txt'))[1]);
array_splice($crontab, 0, 1);
array_pop($crontab);

?>
<h1>Tâches</h1>
<table>
    <thead>
        <tr>
            <th>Tâche</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($crontab as $cronJob) {
            ?>
            <tr>
                <td><?php echo $cronJob; ?></td>
                <td><a href='?deleteJob=<?php echo $cronJob; ?>'>Supprimer</a></td>
            </tr>
        <?php } ?>

    </tbody>
</table>
<h1>Ajouter une tâche</h1>
<form>
    <label>Tâche cron</label>
    <input type="text" name="cronjob" value="* * * * * commande">
    <br>
    <input type="submit">
</form>
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>