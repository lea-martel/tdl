<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
   <form action="action.php" method="post" class="ajax-submit">
       <div class="flex">
         <input type="text" name="tache" placeholder="Entrez votre tâche" class="tache">
           <input type="hidden" name="type" value="tache">
       <button type="submit" class="add"> Ajouter</button>
       </div>
     </form>
    <div class="list">
        <?php foreach ($todoList->selectList() as $list) { ?>
            <div class="list-content">
                <div class="list_item">
                    <div class="list-item-inner">
                        <input type="checkbox" style="width: 20px" class="check">
                    </div>
                    <div class="list-item-info">
                        <?= $list['nom'] ?>
                        <?= $dataTime->setTimestamp($list['date_creation'])->format('d/m/Y H:i') ?>
                    </div>
                </div>
            </div>
        <?php } ?>
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
        html += '<div class="list-item-inner">';
        html += "<input type=\"checkbox\" style=\"width: 20px\">";
        html += '</div>';
        html += '<div class="list-item-info">';
        html += entity.nom + ' ';
        html += entity.date;
        html += '</div>';
        return html + '</div>' + '</div>';
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
                $('.list').prepend(appendEntity(data.list));
                $('.tache').val('')
            },
            error : (error) => {
                console.log(error.responseText)
            }
        })
    });
</script>