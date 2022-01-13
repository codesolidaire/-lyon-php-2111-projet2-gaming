// Global variables
var question_counter        = 0;
var MAX_QUESTIONS           = 5;
var TIMEOUT_IN_SECONDS      = 10;
var correct_ans_counter     = 0;
var incorrect_ans_counter   = 0;
var startDate               = new Date().getTime();
var myTimeout               = null;

// Messages
const MSG_CORRECT_ANSWER    = "Well Done!!!";
const MSG_INCORRECT_ANSWER  = "Incorrect answer";
const MSG_TIMEOUT           = "Timeout";
const MSG_END_GAME          = "Game Completed";

const ID_OP1 = "op1";
const ID_OP2 = "op2";
const ID_OPERATOR = "operator";
const ID_ANSWER = "answer";
const ID_SCORE = "answer";


//Timer
var seconds = TIMEOUT_IN_SECONDS;
var timer = document.querySelector(".timer");
timer.innerHTML = "Timer : 10 secs";
var interval;

let closeicon = document.querySelector(".close");

// declare modal
let modal = document.getElementById("popup1")

function get_random_number(){
    return Math.floor(Math.random() * 100);
}

function get_random_operator(){
    var temp = Math.floor(Math.random() * 3);
    if( temp == 0 ) {return "+";}
    if( temp == 1 ) {return "-";}
    if( temp == 2 ) {return "*";}
    //if( temp == 3 ) {return "+";}
}

function startTimer(){
    interval = setInterval(function(){
        console.log("Seconds:"+seconds);
        timer.innerHTML ="Timer : " +seconds+" secs";
        seconds--;
        if(seconds < 0){
            timeout();
        }
        //timer.innerHTML = seconds;
    },1000);
}

function start_game(){
    question_counter = 0;
    correct_ans_counter = 0;
    incorrect_ans_counter = 0;
    $("#op1").show();
    $("#op2").show();
    $("#operator").show();
    $("submit").show();
    $('#ans').show();
    $('#msg').show();
    $('#submit').show();
    $('#quit').show();
    $("#start").hide();
    timer = document.querySelector(".timer");
    timer.innerHTML ="Timer : "+ TIMEOUT_IN_SECONDS + " secs";
    clearInterval(interval);
    myTimeout_wait = setTimeout(populate_next_question, 2 * 1000);
}

function closeModal(){
    closeicon.addEventListener("click", function(e){
        modal.classList.remove("show");
        start_game();
    });
}

function playAgain(){
    modal.classList.remove("show");

    $("#op1").hide();
    $("#op2").hide();
    $("#operator").hide();
    $("#submit").hide();
    $('#ans').hide();
    $('#msg').hide();
    $('#submit').hide();
    $('#score').hide();
    $('#quit').hide();
    clearInterval(interval);
    timer.innerHTML = "Timer : 10 secs";

    $("#op1").val("");
    $("#op2").val("");
    $("#operator").val("");
    $('#msg').val("");
    $('#score').val("");

    $('#start').show();
}



function get_result(op1, op2, operator){
    console.log("Inside get_result: op1:"+op1+" op2:"+ op2+" operator: "+operator)
    if(operator == "+") {return op1 + op2;}
    if(operator == "-") {return op1 - op2;}
    if(operator == "*") {return op1 * op2;}
}

function end_game(){
    congratulations();
    $("#message").val(MSG_END_GAME);
    $("#op1").hide();
    $("#op2").hide();
    $("#operator").hide();
    $("#submit").hide();
    $('#ans').hide();
    $('#msg').hide();
    $('#submit').hide();
    $('#score').hide();
    $('#quit').hide();
    clearInterval(interval);
    timer.innerHTML = "Timer : 10 secs";

    //window.location.replace("/wildMathGame_Submit_Score?score="+correct_ans_counter);
    congratulations();
    //congTime = setTimeout(congratulations, 1 * 1000);
}
function congratulations(){
        //alert(correct_ans_counter);
        //clearTimeout(congTime);
        clearInterval(interval);
        modal.classList.add("show");
        document.getElementById("finalScore").innerHTML = correct_ans_counter;
        closeModal();
}
function populate_next_question()
{
    clearTimeout(myTimeout_wait);
    interval2 = setInterval(function() {clearInterval(interval2);},1000);
    //Erase message
    $("#message").val("");
    //Erase Answer
    $("#"+ID_ANSWER).val("");
    if (question_counter >= MAX_QUESTIONS){ end_game(); return;}
    op1 = get_random_number();
    op2 = get_random_number();
    operator = get_random_operator();
    $("#"+ID_OP1).val(op1.toString());
    $("#"+ID_OP2).val(op2.toString());
    $("#"+ID_OPERATOR).val(operator);
    question_counter += 1;
    seconds = TIMEOUT_IN_SECONDS;
    timer.innerHTML ="Timer : " +seconds+ " secs";
    startTimer();
    $("#"+ID_ANSWER).focus();

}

function submit_answer(){
    clearInterval(interval);
    isAnswerSubmitted = true;
    var res = check_answer();
    if(res == true){
        $("#message").val(MSG_CORRECT_ANSWER);
        correct_ans_counter += 1;
    }
    else{
        if($("#message").val() != MSG_TIMEOUT){
            $("#message").val(MSG_INCORRECT_ANSWER);
            incorrect_ans_counter += 1;
        }
    }
    // Display score
    //$("#score").val(correct_ans_counter.toString());
    //$('#score').show();
    // Wait for 2 seconds before populating next question
    myTimeout_wait = setTimeout(populate_next_question, 1 * 1000);
}

function check_answer(){
    op1 = parseInt($("#"+ID_OP1).val());
    op2 = parseInt($("#"+ID_OP2).val());
    operator = $("#"+ID_OPERATOR).val();
    correct_answer = get_result(op1,op2,operator)
    input_answer = $("#answer").val();
    // If answer not rivided
    if(input_answer == ''){return false;}
    // Check answer is correct
    if(correct_answer == parseInt(input_answer)){return true;}
    // Answer in wrong
    return false;
}

function timeout( current_question){
    console.log("Timeout reached");
    $("#message").val(MSG_TIMEOUT);
    clearInterval(interval);
    //myTimeout2 = setTimeout(submit_answer(true), 2 * 1000);
    setTimeout(submit_answer,1000)
    //submit_answer();
}
