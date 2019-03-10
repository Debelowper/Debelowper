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

  var link = document.createElement("a");
  link.href = "http:"+ path.detailUrl;
  document.getElementById(id).appendChild(link);

  var img = document.createElement("img");
  img.src = "http:" + path.imageName;
  document.getElementById(id).appendChild(img);

  var name = document.createElement("p");
  name.innerHTML = path.name;
  document.getElementById(id).appendChild(name);

  var oldPrice = document.createElement("p");
  oldPrice.innerHTML = path.oldPrice;
  if(oldPrice.innerHTML != ""){
  oldPrice.innerHTML= "De: " + oldPrice.innerHTML;
  }
  oldPrice.className = "oldPrice";
  document.getElementById(id).appendChild(oldPrice);

  var price = document.createElement("strong");
  price.innerHTML = path.price;
  price.className = "price";
  price.innerHTML= "Por: " + price.innerHTML;
  document.getElementById(id).appendChild(price);

  var paymentConditions = document.createElement("p");
  paymentConditions.innerHTML = path.productInfo.paymentConditions;
  paymentConditions.style.color = "red";
  document.getElementById(id).appendChild(paymentConditions);

  var semJuros = document.createElement("p");
  semJuros.innerHTML = "Sem Juros";
  semJuros.style.color = "red";
  document.getElementById(id).appendChild(semJuros);
}
//funções para scroll da paginação
function goLeft(){
  document.getElementById("recom").scrollBy({top: 0,left: -340, behavior:"smooth"});
}
function goRight(){
  document.getElementById("recom").scrollBy({top: 0,left: 340, behavior:"smooth"});
}
