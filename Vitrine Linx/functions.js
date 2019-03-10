//função que faz a conexão JSON callback
function loadVitrine() {
  var s = document.createElement("script");
  s.src = "http://roberval.chaordicsystems.com/challenge/challenge.json?callback=X";
  document.body.appendChild(s);
}

//callback do JSON chama esta função. Ela dá a ordem de chamada dos itens.
function X (myObj){
  addItem(myObj, "reference");

  for(var i=0; i<10; i++){
    addItem(myObj, "recommendation", i);
  }
}
//Aqui todos os itens são manipulados e colocados na tela
function addItem (myObj, target, index){
  var pathRef = myObj.data.reference.item;
  var pathRec = myObj.data.recommendation[index];
  var path = null;

//define se está trabalhando com a referência ou com as recomendações e cria o wrapper do item
  if(target == "reference"){
     var id="reference";
     path = pathRef;
     var container = document.createElement("div");
     container.id="reference";
     container.className = "item";
     document.getElementById("ref").appendChild(container);
  }else if(target == "recommendation"){
    var id="recommendation"+index;
     path = pathRec;
     container = document.createElement("div");
     container.id = id;
     container.className = "item";
     document.getElementById("recom").appendChild(container);
  };
//
  document.getElementById(id).onclick = function(){
    window.location.href = "http:"+path.detailUrl;
  }

  var img = document.createElement("img");
  img.src = "http:" + path.imageName;
  document.getElementById(id).appendChild(img);

  var name = document.createElement("p");
  name.innerHTML = path.name;
  name.className = "name"
  document.getElementById(id).appendChild(name);

  var oldPrice = document.createElement("p");
  oldPrice.innerHTML = path.oldPrice;
  if(oldPrice.innerHTML != ""){
  oldPrice.innerHTML= "De: " + oldPrice.innerHTML;
  }
  oldPrice.className = "oldPrice";
  document.getElementById(id).appendChild(oldPrice);

  var por = document.createElement("p");
  por.innerHTML = "Por:"
  por.style.display ="inline-block";
  por.style.color = "rgb(204,0,0)";
  document.getElementById(id).appendChild(por);

  var price = document.createElement("strong");
  price.innerHTML = path.price;
  price.className = "price";
  document.getElementById(id).appendChild(price);

  var paymentConditions = document.createElement("strong");
  paymentConditions.className = "paymentConditions";
  paymentConditions.innerHTML = path.productInfo.paymentConditions;
  paymentConditions.innerHTML = paymentConditions.innerHTML.replace("de ", "de R$");
  document.getElementById(id).appendChild(paymentConditions);

  var semJuros = document.createElement("p");
  semJuros.innerHTML = "Sem Juros";
  semJuros.style.color = "rgb(204,0,0)";
  document.getElementById(id).appendChild(semJuros);

}
//funções para scroll da paginação -- por alguma razão não funciona no atom, só no browser
function goLeft(){
  document.getElementById("recom").scrollBy({top: 0,left: -340, behavior:"smooth"});
}
function goRight(){
  document.getElementById("recom").scrollBy({top: 0,left: 340, behavior:"smooth"});
}
//troca a cor das setas quando o scroll chega ao fim
function scrollFunc(){
  var x = document.getElementById("recom").scrollLeft;
  if(x==0){
    document.getElementById("goLeft").src="setaEsquerdaA.png"
  }else if(x!=0){
    document.getElementById("goLeft").src="setaEsquerdaB.png";
  }
  x = scrolledToBottom(document.getElementById("recom"))
  if(x== 1){
    document.getElementById("goRight").src="setaDireitaA.png"
  }else if(x!=1){
    document.getElementById("goRight").src="setaDireitaB.png";
  }
}

//função para descobrir se o elemento deu scroll até o fim
function scrolledToBottom(div){
  if(div.offsetWidth + div.scrollLeft >= div.scrollWidth){
    return 1;
  }
}
