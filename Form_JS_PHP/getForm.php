<?php
$notesDic = array(
    "do" => "C",
    "ré" => "D",
    "mi" => "E",
    "fa" => "F",
    "sol" => "G",
    "la" => "A",
    "si" => "B"
);
?>

<form id="notes-form" action="note.php" method="GET">
    <select name="notesList" id="notesList">
        <option></option>
        <?php
        foreach($notesDic as $note => $letter) {
            echo '<option value="' . $note . '">' . $note . '</option>';
        }
        ?>
    </select>
</form>