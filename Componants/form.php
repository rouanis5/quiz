<div class="main">
    <div class="container box">
        <form action="./action.php" method="post">
            <?php foreach ($quest as $qst => $values): ?>
                <div class='qst' id='<?php echo $qst ?>'>
                    <!-- generate the index + question -->
                    <h3><span><?php echo (++$index ?? 1) ?></span><?php echo $values['question'] ?></h3>
                    <?php $name = is_array($values['réponse']) ? $qst . "[]" : $qst;?>
                    <?php for ($i = 0; $i < count($values['choix']); $i++): ?>
                        <?php $required = ($i == 0 and $values['type'] != "checkbox") ? "required" : "";?>
<?php
$id = $qst . "_" . $i;
$className = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (in_array($id, $true_reps) || $true_text[$id]) {
        $className = "true";
    } elseif (in_array($id, $false_reps) || $false_text[$id]) {
        $className = "false";
    }
}
?>
                        <?php if ($values['type'] != "text"): ?>
                            <div class='answer <?php echo $className ?>' id='<?php echo $id ?>'>
                                <input type='<?php echo $values['type'] ?>' id='<?php echo "a__$qst$i" ?>' name='<?php echo $name ?>' value='<?php echo $qst . "_" . $i ?>' <?php echo $required ?>>
                                <label for='<?php echo "a__$qst$i" ?>'><?php echo $values['choix'][$i] ?></label>
                            </div>
                        <?php else: ?>
                            <input class='answer <?php echo $className ?>' type='text' id='<?php echo $id ?>' value='<?php echo $true_text[$id] ?? $false_text[$id] ?? "" ?>' name='<?php echo $name ?>' placeholder='Taper la réponse ici ...'required striptag>
                        <?php endif?>
                    <?php endfor?>
                </div>
            <?php endforeach?>
            <input class="submit" type="submit" value="Submit">
        </form>
    </div>
</div>
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
<script>
    document.querySelector(".submit").style.display = "none";
    document.querySelectorAll("input").forEach(el => {
        el.disabled = true;
    });
</script>
<?php endif?>