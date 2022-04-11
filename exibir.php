<?php
   include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Exibir</title>
    <style>
        #tabela{
            padding-top: 20px;
            padding-left: 50px;
            padding-right: 50px;
        }
        #title{
            text-align: center;
            font-family: Georgia, Times, 'Times New Roman', serif;
        }
    </style>
</head>
<body>
<div id="tabela">
    <div id="title">
        <h1>Tabela de cadastro</h1>
    </div>
<table class="table table-striped">
    <thead class="thead">
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">idade</th>
            <th scope="col">Ação</th>
        </tr>
    </thead>
    <?php
    $consulta = $pdo->prepare("SELECT * FROM mytable");
    $consulta->execute();
    while ($busca = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <tbody>
        <tr>
            <td><?=$busca['id']?></td>
            <td><?=$busca['nome']?></td>
            <td><?=$busca['idade']?></td>
            <td>
            <a class="btn btn-warning btn-sm">Editar</a>
                <form method="post" action="delete.php">
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </td>
        </tr>
    </tbody>
   <?php }
    ?>
</table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>