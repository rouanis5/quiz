<div class="main">
    <div class="container box">
        <form action="./action.php" method="post">
            <?php foreach ($quest as $qst => $values): ?>
                <div class='qst' id='<?php echo $qst ?>'>
                    <!-- generate the index + question -->
                    <h3><span><?php echo (++$index ?? 1) ?></span><?php echo $values['question'] ?></h3>
                    <?php $name = is_array($values['réponse']) ? $qst . "[]" : $qst;?>
                    <?php for ($i = 0; $i < count($values['choix']); $i++): ?>
                        <?php $required = ($i == 0 and $values['type'] != "checkbox") ? "required" : ""?>
                        <?php if ($values['type'] != "text"): ?>
                            <div class='answer' id='<?php echo $qst . "_" . $i ?>'>
                                <input type='<?php echo $values['type'] ?>' id='<?php echo "a__$qst$i" ?>' name='<?php echo $name ?>' value='<?php echo $qst . "_" . $i ?>' <?php echo $required ?>>
                                <label for='<?php echo "a__$qst$i" ?>'><?php echo $values['choix'][$i] ?></label>
                            </div>
                        <?php else: ?>
                            <input class='answer' type='text' id='<?php echo $qst . "_" . $i ?>' name='<?php echo $name ?>' placeholder='Taper la réponse ici ...'required striptag>
                        <?php endif?>
                    <?php endfor?>
                </div>
            <?php endforeach?>
            <input class="submit" type="submit" value="Submit">
        </form>
    </div>
</div>