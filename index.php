<?php 
include_once 'conexao.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];    
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAS</title>
    <style>
        #tabela{
            padding-top: 20px;
            padding-left: 50px;
            padding-right: 50px;
        }
        #areaNome{
            padding-bottom: 10px;
        }
        #areaIdade{
            padding-bottom: 10px;
        }
        #formulario{
            padding-top: 20px;
        }
        #titulo{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="formulario">
        <div class="form-div">
        <div id="titulo">
            <h1>CRUD basicão</h1>
        </div>    
            <form action="" method="post">
                <div id="areaNome" class="mb-6">
                    <input type="text" name="nome" placeholder="Nome" class="form-control">
                </div>
                <div id="areaIdade">
                <input type="text" name="dataNascimento" placeholder="Data de Nascimento" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        </div>
    </div>
    <?php 

    if(isset($_POST['nome'])){
        if(empty($_POST['nome']) || empty($_POST['dataNascimento'])){
            $erro = 'Preencha todos os campos';
        }else{
            $nome = $_POST['nome'];
            $dataNascimento = $_POST['dataNascimento'];
             $stmt = $pdo->prepare('INSERT INTO mytable (nome, dataNascimento) VALUES(:nome, :dataNascimento)');
             $stmt->execute(array(
               ':nome' => $nome,
               ':dataNascimento'=> $dataNascimento
             ));
            }
        }
        ?>
   
<div id="tabela">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Nascimento</th>
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
                <td><?=$busca['dataNascimento']?></td>
                <td>
                <a class="btn btn-warning btn-sm" href="update.php?id=<?=$busca['id']?>">Editar</a>
                    <form method="post" action="index.php?id=<?=$busca['id']?>" class="d-inline">
                        <button type="submit" class="btn btn-danger btn-sm" id="delete">Excluir</button>
                    </form>
                </td>
            </tr>
        </tbody>
    <?php }
        ?>
    </table>
    <?php
        $sql = "DELETE FROM mytable where id=:id";
        $del= $pdo->prepare($sql);
        $del->bindParam(
            ":id", $id
        );
        $del->execute();
    ?><!--
    <script>
        document.getElementById('delete').onclick 
        = function(){
            swal("Excluído com sucesso!", "success");
        }
    </script>
    -->
</div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>