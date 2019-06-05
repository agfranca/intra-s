
//Scrollable area
var element = document.getElementById("boards"); // Count Boards
var numberOfBoards = element.getElementsByClassName('board').length;
var boardsWidth = numberOfBoards*316 // Width of all Boards
console.log(boardsWidth);
element.style.width = boardsWidth+"px"; // set Width

//disable text-selection
function disableselect(e) {return false;}
document.onselectstart = new Function ()
document.onmousedown = disableselect

//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


dragula([
	document.getElementById('b1'),
	document.getElementById('b2'),
	document.getElementById('b3'),
	document.getElementById('b4')
],{
  accepts: function(el, target, source, sibling) {
	if ((target.id == 'b4')&&(el.querySelector('#criador').value !== el.querySelector('#destino').value)){
	return false;
	}
	return true;
      
    }
}).on("drop", (el, target, source)=> {
   // get the item's unique identifier
   var item = el.id
   
   // get the item's old column name
   var oldColumn = source.id
   
   // get the item's new column name
   var newColumn = target.id
   
   //get criador
   var criador = el.querySelector('#criador').value
   
   //get destino
   var destino = el.querySelector('#destino').value

   
	if (newColumn == 'b4') {
	//console.log(`VC tentou colocar em Concluido`)
	if (criador !== destino) {
		//return false
		//revertOnSpill :  true 
		//console.log(`Deveria Voltar`)
	}
	
	}
  
   console.log(`Item, ${item}, foi removido de ${oldColumn}.`)
   console.log(`Item, ${item}, foi adicionado em ${newColumn}.`)
   console.log(`Criador, ${criador}, destino ${destino}.`)	
   //console.log(window.location.hostname+`/painel/tarefas/kanban/recebidas/${item}/${newColumn}`)
   
   //Atualizar o Status no Banco de Dados
   window.location.replace(`/update-status/${item}/${newColumn}`);
   
})




