<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    $true_reps = [];
    $false_reps = [];
    $true_text = [];
    $false_text = [];
    $score = 0;
    foreach ($_POST as $qst => $repsId) {
        if (is_array($repsId)) {
            $point = 0;
            foreach ($repsId as $id) {
                $index = (int) str_replace($qst . "_", "", $id);
                if (in_array($quest[$qst]["choix"][$index], $quest[$qst]["réponse"])) {
                    $point++;
                    $true_reps[] = $id;
                } else {
                    $point--;
                    $false_reps[] = $id;
                }
            }
            if ($point < 0) {
                $point = 0;
            }
            $score += $point;
        } else {
            if ($quest[$qst]["type"] == "text") {
                //in this case the index will the user answer.
                $array_text = [$qst . "_0" => $repsId];
                if (strcmp($repsId, $quest[$qst]["réponse"]) == 0) {
                    $score++;
                    $true_text += $array_text;
                    //because the input of type txt sends the entred data not the value
                } else {
                    $false_text += $array_text;
                }
            } else {
                $index = (int) str_replace($qst . "_", "", $repsId);
                if (strcmp($quest[$qst]["choix"][$index], $quest[$qst]["réponse"]) == 0) {
                    $score++;
                    $true_reps[] = $repsId;
                } else {
                    $false_reps[] = $repsId;
                }
            }
        }
    }
    $result = round($score * 100 / $total);
    //colors:
    $red = "red";
    $orange = "orange";
    $yellow = "#fee128";
    $green = "lightgreen";
    if ($result < 25) {
        $color = $red;
        $message = "Very bad, try again!";
    } elseif ($result < 50) {
    $color = $orange;
    $message = "You're not so far, try again!";
} elseif ($result < 75) {
    $color = $yellow;
    $message = "you're medium!";
} else {
    $color = $green;
    $message = "Excelent!";
}
?>
<div class="result">
    <div class="container box">
        <div class='percent'>
            <div class='pie animate' style='--p:<?php echo $result ?>;--c:<?php echo $color ?>;color:<?php echo $color ?>'> <?php echo $result ?>%</div>
            <div class='msg'>
                <p>You got <?php echo $score ?> of <?php echo $total ?></p>
                <h2><?php echo $message ?></h2>
                <a class="restart" href="./redirect.php" style="background: <?php echo $color ?>">Restart</a>
            </div>
        </div>
    </div>
</div>
<?php endif;