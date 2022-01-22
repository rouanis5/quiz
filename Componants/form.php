<!-- if the forum is submited, the from will be disabled-->
<?php
$is_submited = $_SERVER['REQUEST_METHOD'] == 'POST';
$disabled = $is_submited ? "disabled" : ""
?>
<div class="main">
    <div class="container box">
        <form action="" method="post">
            <?php foreach ($quest as $qst => $values): ?>
                <div class='qst' id='<?php echo $qst ?>'>
                    <!-- generate the index + question -->
                    <h3><span><?php echo (++$index ?? 1) ?></span><?php echo $values['question'] ?></h3>
                    <?php $name = is_array($values['réponse']) ? $qst . "[]" : $qst;?>
                    <?php for ($i = 0; $i < count($values['choix']); $i++): ?>
<?php
//add required attribute
$required = ($i == 0 and $values['type'] != "checkbox") ? "required" : "";
$id = $qst . "_" . $i;
//if the form is submited, the this will help generate the correction (colors, user choises)
$className = "";
if ($is_submited) {
    if (in_array($id, $true_reps) || $true_text[$id]) {
        $className = "true";
    } elseif (in_array($id, $false_reps) || $false_text[$id]) {
        $className = "false";
    }
}
?>
                        <?php if ($values['type'] != "text"): ?>
                            <div class='answer <?php echo $className ?>' id='<?php echo $id ?>'>
                                <input type='<?php echo $values['type'] ?>' id='<?php echo "a__$qst$i" ?>' name='<?php echo $name ?>' value='<?php echo $qst . "_" . $i ?>' <?php echo $required ?> <?php echo $disabled ?>>
                                <label for='<?php echo "a__$qst$i" ?>'><?php echo $values['choix'][$i] ?></label>
                            </div>
                        <?php else: ?>
                            <input class='answer <?php echo $className ?>' type='text' id='<?php echo $id ?>' value='<?php echo $true_text[$id] ?? $false_text[$id] ?? "" ?>' name='<?php echo $name ?>' placeholder='Taper la réponse ici ...'required striptag <?php echo $disabled ?>>
                        <?php endif?>
                    <?php endfor?>
                </div>
            <?php endforeach?>
        <?php if (!$is_submited): ?>
            <input class="submit" type="submit" value="Submit">
        <?php endif?>
        </form>
    </div>
</div>