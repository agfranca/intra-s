@extends('painel.layout')
@section('header')
<section class="content-header">
      <h1>
        Tarefas
        <small> - Tarefas do Usuário</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> Painel</a></li>
        <li class="active">Tarefas</li>
      </ol>


<link rel="stylesheet" href="/jkanban/dist/jkanban.min.css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<style>
        body {
            font-family: "Lato";
            margin: 0;
            padding: 0;
        }

        #myKanban {
            overflow-x: auto;
            padding: 20px 0;
        }

        .success {
            background: #00B961;
        }

        .info {
            background: #2A92BF;
        }

        .warning {
            background: #F4CE46;
        }

        .error {
            background: #FB7D44;
        }

    </style>
</section>
@stop

@section('content')
  @include('painel.partes.mensagens-usuarios')

  <div class="box box-info">
    @include('painel.tarefas.partes.menuHorizontal')
    <!-- /.box-header -->
    <div class="box-body">

      <div id="myKanban">
          
      </div>
      <button id="addDefault">Add "Default" board</button>
      <br>
      <button id="addToDo">Add element in "To Do" Board</button>
      <br>
      <button id="removeBoard">Remove "Done" Board</button>
      <br>
      <button id="removeElement">Remove "My Task Test"</button>



      <div id="myKanban2">
          
      </div>








    </div>

  </div>


<script src="/jkanban/dist/jkanban.min.js"></script>
<script>

    var kanban = new jKanban({
    element         : '#myKanban2',                                           // selector of the kanban container
    gutter          : '15px',                                       // gutter of the board
    widthBoard      : '250px',                                      // width of the board
    responsivePercentage: false,                                    // if it is true I use percentage in the width of the boards and it is not necessary gutter and widthBoard
    dragItems       : true,                                         // if false, all items are not draggable
    boards          : [
            {
                "id": "_todo",
                "title": "A Fazer",
                "class": "info,good",
                "dragTo": ['_working'],
                "item": [
                    {
                        "id": "_test_delete",
                        "title": "Try drag this (Look the console)",
                        "drag": function (el, source) {
                            console.log("START DRAG: " + el.dataset.eid);
                        },
                        "dragend": function (el) {
                            console.log("END DRAG: " + el.dataset.eid);
                        },
                        "drop": function(el){
                            console.log('DROPPED: ' + el.dataset.eid )
                        }
                    },
                    {
                        "title": "Try Click This!",
                        "click": function (el) {
                            alert("click");
                        },
                    }
                ]
            },
            {
                "id": "_working",
                "title": "Em Andamento",
                "class": "warning",
                "item": [
                    {
                        "id":"1",
                        "title": "Alexandre",
                        "conteudo":"Olhar eu aqui!!!!",
                    },
                    {
                        "id":"2",
                        "title": "Run?",
                    }
                ]
            },
            {
                "id": "_done",
                "title": "Para Aprovação",
                "class": "success",
                "dragTo": ['_working'],
                "item": [
                    {
                        "title": "All right",
                    },
                    {
                        "title": "Ok!",
                    }
                ]
            },
            {
                "id": "_finish",
                "title": "Concluído",
                "class": "error",
                "dragTo": ['_working'],
                "item": [
                    {
                        "title": "All right",
                    },
                    {
                        "title": "Ok!",
                    }
                ]
            }
        ],                                           // json of boards
    dragBoards      : true,                                         // the boards are draggable, if false only item can be dragged
    addItemButton   : false,                                        // add a button to board for easy item creation
    buttonContent   : '+',                                          // text or html content of the board button
    click           : function (el) {},                             // callback when any board's item are clicked
    dragEl          : function (el, source) {},                     // callback when any board's item are dragged
    dragendEl       : function (el) {},                             // callback when any board's item stop drag
    dropEl          : function (el, target, source, sibling) {},    // callback when any board's item drop in a board
    dragBoard       : function (el, source) {},                     // callback when any board stop drag
    dragendBoard    : function (el) {},                             // callback when any board stop drag
    buttonClick     : function(el, boardId) {}                      // callback when the board's button is clicked
});






    var KanbanTest = new jKanban({
        element: '#myKanban',
        gutter: '10px',
        widthBoard: '245px',
        click: function (el) {
            console.log("Trigger on all items click!");
        },
        buttonClick: function (el, boardId) {
            console.log(el);
            console.log(boardId);
            // create a form to enter element 
            var formItem = document.createElement('form');
            formItem.setAttribute("class", "itemform");
            formItem.innerHTML = '<div class="form-group"><textarea class="form-control" rows="2" autofocus></textarea></div><div class="form-group"><button type="submit" class="btn btn-primary btn-xs pull-right">Submit</button><button type="button" id="CancelBtn" class="btn btn-default btn-xs pull-right">Cancel</button></div>'

            KanbanTest.addForm(boardId, formItem);
            formItem.addEventListener("submit", function (e) {
                e.preventDefault();
                var text = e.target[0].value
                KanbanTest.addElement(boardId, {
                    "title": text,
                })
                formItem.parentNode.removeChild(formItem);
            });
            document.getElementById('CancelBtn').onclick = function () {
                formItem.parentNode.removeChild(formItem)
            }
        },
        addItemButton: false,
        boards: [
            {
                "id": "_todo",
                "title": "A Fazer",
                "class": "info,good",
                "dragTo": ['_working'],
                "item": [
                    {
                        "id": "_test_delete",
                        "title": "Try drag this (Look the console)",
                        "drag": function (el, source) {
                            console.log("START DRAG: " + el.dataset.eid);
                        },
                        "dragend": function (el) {
                            console.log("END DRAG: " + el.dataset.eid);
                        },
                        "drop": function(el){
                            console.log('DROPPED: ' + el.dataset.eid )
                        }
                    },
                    {
                        "title": "Try Click This!",
                        "click": function (el) {
                            alert("click");
                        },
                    }
                ]
            },
            {
                "id": "_working",
                "title": "Em Andamento",
                "class": "warning",
                "item": [
                    {
                        "id":"1",
                        "title": "Alexandre",
                        "conteudo":"Olhar eu aqui!!!!",
                    },
                    {
                        "id":"2",
                        "title": "Run?",
                    }
                ]
            },
            {
                "id": "_done",
                "title": "Para Aprovação",
                "class": "success",
                "dragTo": ['_working'],
                "item": [
                    {
                        "title": "All right",
                    },
                    {
                        "title": "Ok!",
                    }
                ]
            },
            {
                "id": "_finish",
                "title": "Concluído",
                "class": "error",
                "dragTo": ['_working'],
                "item": [
                    {
                        "title": "All right",
                    },
                    {
                        "title": "Ok!",
                    }
                ]
            }
        ]
    });

    var toDoButton = document.getElementById('addToDo');
    toDoButton.addEventListener('click', function () {
        KanbanTest.addElement(
            "_todo",
            {
                "title": "Test Add",
            }
        );
    });

    var addBoardDefault = document.getElementById('addDefault');
    addBoardDefault.addEventListener('click', function () {
        KanbanTest.addBoards(
            [{
                "id": "_default",
                "title": "Kanban Default",
                "item": [
                    {
                        "title": "Default Item",
                    },
                    {
                        "title": "Default Item 2",
                    },
                    {
                        "title": "Default Item 3",
                    }
                ]
            }]
        )
    });

    var removeBoard = document.getElementById('removeBoard');
    removeBoard.addEventListener('click', function () {
        KanbanTest.removeBoard('_done');
    });

    var removeElement = document.getElementById('removeElement');
    removeElement.addEventListener('click', function () {
        KanbanTest.removeElement('_test_delete');
    });

    var allEle = KanbanTest.getBoardElements('_todo');
    allEle.forEach(function (item, index) {
        //console.log(item);
    })
</script>
@stop