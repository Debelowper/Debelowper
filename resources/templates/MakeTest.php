<?php
check_login();

?><br><br>
<html>
<body>

<form id="Form" action="http://localhost/public/RegTest.php" method="post">
<h2> Input text here: </h2>
<textarea rows=1 cols=30 maxlength=30 name="title" placeholder="title" required></textarea><br>
<textarea rows=30 cols=90 maxlength=6990 name="text" placeholder="write text here" required></textarea>


<script>
var Num_Questions=0;
function CreateQuestion(){
  if(Num_Questions>8){return false};
  Num_Questions++;
  var br=document.createElement("br");
  var container = document.createElement("div");
  container.setAttribute("name", "c"+Num_Questions);
  document.getElementById("Form").appendChild(container);
  var Question = document.createElement("textarea");
  Question.setAttribute("name", "q"+Num_Questions);
  Question.setAttribute("rows", 2);
  Question.setAttribute("cols", 80);
  Question.required=true;
  Question.setAttribute("placeholder", "Question"+Num_Questions);
  document.getElementsByName("c"+Num_Questions)[0].appendChild(Question);
  document.getElementsByName("c"+Num_Questions)[0].appendChild(br);
  var Answer = document.createElement("input");
  Answer.setAttribute("type", "number");
  Answer.setAttribute("name", "ans"+Num_Questions);
  Answer.setAttribute("min", 1);
  Answer.setAttribute("max", 4);
  Answer.required=true;
  var label = document.createElement("p");
  label.textContent="Right Answer:";
  document.getElementsByName("c"+Num_Questions)[0].appendChild(label);
  document.getElementsByName("c"+Num_Questions)[0].appendChild(Answer);
  document.getElementsByName("c"+Num_Questions)[0].appendChild(br);
  for(var x=1;x<5;x++){
    var br= document.createElement("br");
    br.setAttribute("name", "lineBreak"+Num_Questions)
    var Alt = document.createElement("textarea");
    var nome = 10*Num_Questions+x;
    Alt.setAttribute("name", nome);
    Alt.setAttribute("rows", 1);
    Alt.setAttribute("cols", 80);
    Alt.required=true;
    Alt.setAttribute("placeholder", "Question "+Num_Questions+" alternative"+ x);
    document.getElementsByName("c"+Num_Questions)[0].appendChild(Alt);
    document.getElementsByName("c"+Num_Questions)[0].appendChild(br);
  }
}

function DeleteQuestion(){
  if(Num_Questions<1){return false};
  var container=document.getElementsByName("c"+Num_Questions)[0];
  container.parentNode.removeChild(container);
  Num_Questions--;
}
</script>
<br>
<input type="submit" name="GameSubmit">
</form><br>
<input type="button" onclick=CreateQuestion() value="Add Question">
<input type="button" onclick=DeleteQuestion() value="Delete Question">
</body>
</html>
