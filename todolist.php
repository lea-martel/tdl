<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/5a25ce672a.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <title> TO DO LIST</title>
</head>
<body>
<?php include 'header.php';
$todoList = new Base\actionTodolist();
$dataTime = new DateTime();

?>
<main>
    <div class="container-list">
   <form action="action.php" method="post" class="ajax-submit" autocomplete="off">
       <div class="flex">
         <input type="text" name="tache" placeholder="Entrez votre tâche" class="tache">
           <input type="hidden" name="type" value="tache">
       <button type="submit" class="add"> Ajouter</button>
       </div>
     </form>
    <div class="list">
        <h6 class="top">Ma liste de tâche</h6>
        <div class="list-content-other">
            <?php foreach ($todoList->selectList() as $list) { ?>
                <div class="list-content">
                    <div class="list_item">
                    <span id="<?= $list['id'] ?>"
                          class="remove" data-entity-id="<?= $list['id'] ?>">x</span>
                        <?php if ($list['checked']) { ?>
                            <input type="checkbox" style="width: 20px" class="check-box"
                                   data-todo-id="<?= $list['id'] ?>" checked/>
                            <h5 class="h5-list checked"><?= $list['nom'] ?></h5>
                        <?php } else { ?>
                            <input type="checkbox" style="width: 20px" class="check-box"
                                   data-todo-id="<?= $list['id'] ?>"/>
                            <h5 class="h5-list"><?= $list['nom'] ?></h5>
                        <?php } ?>
                        <div class="list-item-info">
                            <div class="txt">Crée le
                                <?= $dataTime->setTimestamp($list['date_creation'])->format('d/m/Y H:i') ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>
<script>
    function appendEntity(entity)
    {
        console.log(entity.nom)
        let html = '<div class="list-content">'
        html += '<div class="list_item">';
        html += ' <span id="' + entity.id + '"\n'+
'                          class="remove" data-entity-id="' + entity.id + '">x</span>'
        html += "<input type=\"checkbox\" style=\"width: 20px\" class='check-box' data-todo-id=\"" + entity.id + "\">";
        html += '<h5 class="h5-list">'
        html += entity.nom + ' ';
        html += '</h5>';
        html += '<div class="list-item-info">';
        html += '<div class="txt">';
        html += entity.date;
        html += '</div>';
        html += '</div>';
        return html + '</div>' + '</div>';
    }

    $(document).ready(function(){
        callback();
    });
    function callback()
    {
        $('.remove').click(function(){
            let id = $(this).data('entity-id');
            console.log(id)
            var self = this;
            $.ajax({
                url : "action.php",
                method : 'post',
                data : {
                    id: id,
                    type : 'deleteList'
                },
                dataType : 'json',
                success : (data) => {
                    $(self).closest('.list-content').hide(600);
                    console.log(data)
                },
                error : (error) => {
                    console.log(error.responseText)
                }
            })

        });

        $(".check-box").click(function(e) {
            const id = $(this).attr('data-todo-id')
            let parent = $(this).closest('.list-content');

            $.ajax({
                url : "action.php",
                method : 'post',
                data : {
                    id: id,
                    type : 'checkedList'
                },
                dataType : 'json',
                success : (data) => {
                    let h5 = parent.find('.h5-list');
                    if(!data[1].checked) {
                        h5.removeClass('checked');console.log(id, parent)
                    } else {
                        h5.addClass('checked');
                    }
                },
                error : (error) => {
                    console.log(error.responseText)
                }
            })
        })
    }
    $('.ajax-submit').submit(function (e) {
        e.preventDefault();
        var self = this;
        $.ajax({
            url : $(this).attr('action'),
            method : $(this).attr('method'),
            data : $(this).serialize(),
            dataType : 'json',
            success : (data) => {
                console.log(data);
                $('.list-content-other').prepend(appendEntity(data.list));
                $('.tache').val('');
            },
            error : (error) => {
                console.log(error.responseText)
            }
        })
    });
</script>