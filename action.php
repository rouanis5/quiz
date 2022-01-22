<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="./css/all.min.css">
</head>
<body>
    <?php
include "./header.php";
?>
    <div class="result">
        <div class="container box">
            <?php
include 'questions.php';
$true_reps = [];
$false_reps = [];
$true_text = [];
$false_text = [];
if (!empty($_POST)) {
    $score = 0;
    foreach ($_POST as $qst => $repsId) {
        if (is_array($repsId)) {
            $point = 0;
            foreach ($repsId as $id) {
                $index = (int) str_replace($qst . "_", "", $id);
                if (in_array($quest[$qst]["choix"][$index], $quest[$qst]["réponse"])) {
                    $point++;
                    array_push($true_reps, $id);
                } else {
                    $point--;
                    array_push($false_reps, $id);
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
                    array_push($true_reps, $repsId);
                } else {
                    array_push($false_reps, $repsId);
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
    echo "<div class='percent'>";
    echo "<div class='pie animate' style='--p:$result;--c:$color;color:$color'> $result%</div>";
    echo "<div class='msg'>";
    echo "<p>You got $score of $total</p>";
    echo "<h2>$message</h2>";
    echo "</div>";
    echo "</div>";
} else {
    echo "<h2 id='fillIt'>You didn't fill the quiz !</h2>";
}
?>
        </div>
    </div>
    <?php
include "./form.php";
include "./footer.php";
?>
    <script>
        <?php
function toJsArray($array, $name)
{
    echo "var $name = [";
    foreach ($array as $i => $v) {
        echo "'$v'";
        if ($i != count($array) - 1) {
            echo ",";
        }

    }
    echo "];";
}
function toJsMap($array, $name)
{
    echo "var $name = [";
    $i = 0;
    foreach ($array as $id => $v) {
        // $v = strip_tags($v);
        echo "['$id', '$v']";
        if ($i != count($array) - 1) {
            echo ",";
        }

        $i++;
    }
    echo "];";
}
toJsArray($true_reps, "trueReps");
toJsArray($false_reps, "falseReps");
toJsMap($true_text, "trueText");
toJsMap($false_text, "falseText");
?>
        if (!document.getElementById("fillIt")) {
            document.querySelector(".submit").style.display = "none";
            document.querySelectorAll("input").forEach(el => {
                el.disabled = true;
            });
        }
        trueReps.forEach((e) => {
            document.getElementById(e).classList.add("true");
            document.getElementById(e).firstElementChild.checked = true;
        });
        falseReps.forEach((e) => {
            document.getElementById(e).classList.add("false");
            document.getElementById(e).firstElementChild.checked = true;
        });
        trueText.forEach(e => {
            var el = document.getElementById(e[0]);
            el.classList.add("true");
            el.value = e[1];
        });
        falseText.forEach(e => {
            var el = document.getElementById(e[0]);
            el.classList.add("false");
            el.value = e[1];
        });
    </script>
</body>
</html>