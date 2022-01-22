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