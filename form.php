<div class="main">
    <div class="container box">
        <form action="./action.php" method="post">
            <?php
include './questions.php';
$z = 0; //index of question
$total = 0;
foreach ($quest as $qst => $values) {
    echo "<div class='qst' id='$qst'>";
    echo "<h3><span>" . ($z + 1) . "</span>" . $values['question'] . "</h3>";
    $name = is_array($values['réponse']) ? $qst . "[]" : $qst;
    for ($i = 0; $i < count($values['choix']); $i++) {
        $required = ($i == 0 and $values['type'] != "checkbox") ? "required" : "";
        if ($values['type'] != "text") {
            echo "<div class='answer' id='" . $qst . "_" . $i . "'>";
            echo "<input type='" . $values['type'] . "' id='a__$qst$i' name='$name' value='" . $qst . "_" . $i . "'$required>";
            echo "<label for='a__$qst$i'>" . $values['choix'][$i] . "</label>";
            echo "</div>";
        } else {
            echo "<input class='answer' type='text' id='" . $qst . "_" . $i . "' name='$name' placeholder='Taper la réponse ici ...'required striptag>";
        }
        $total++;
    }
    $z++;
    echo "</div>";
}
;
?>
            <input class="submit" type="submit" value="Submit">
        </form>
    </div>
</div>
<script>
    var answers = document.querySelectorAll("div.answer");
    answers.forEach((answer) => {
        window.addEventListener("click",(e)=>{
            if (e.target == answer && !(e.taget in answer.childNodes))
                answer.firstElementChild.click()
            checkInputs();
        })
    });
    function checkInputs(){
        answers.forEach((el) => {
            if (el.firstElementChild.checked) {
                el.classList.add("checked");
            } else {
                el.classList.remove("checked");
            }
        });
    }
    window.onload = ()=>{
        checkInputs();
    }
</script>