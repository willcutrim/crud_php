<?php
include_once 'conexao.php';
$id = $_GET["id"]
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>atualizar</title>
    <style>
        #title{
            text-align: center;
        }
        #areaNome{
            padding-bottom: 10px;
        }  
    </style>
</head>
<body>
<div class="container">
        <div id="formulario">
        <div class="form-div">
        
        <h1 id="title">Atualizar dados</h1>
            <form action="" method="post">
                <div id="area" class="mb-2">
                    <?php
                    $consulta = $pdo->prepare("SELECT nome, dataNascimento FROM mytable where id = $id");
                    $consulta->execute();
                    while ($busca = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div id="areaNome">
                            <input type="text" name="nome" value="<?=$busca['nome']?>" placeholder="Nome" class="form-control">
                        </div>
                        <div id="areaIdade">
                            <input type="text" name="dataNascimento" value="<?=$busca['dataNascimento']?>" placeholder="Nata de Nascimento" class="form-control">
                        </div>
                    <?php }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="index.php" class="btn btn-light">Voltar</a>
            </form>
        </div>
    </div>
</div>
    <?php
        if(isset($_POST['nome'])){
            if(empty($_POST['nome']) || empty($_POST['dataNascimento'])){
                $erro = 'Preencha os campos';
            }else{
                
                $nome = $_POST['nome'];
                $dataNascimento = $_POST['dataNascimento'];
                if ($id > 0) {
                    $up = $pdo->prepare("UPDATE mytable SET nome = :nome, dataNascimento = :dataNascimento WHERE id = $id");
                    $up->execute(array(
                        ':nome' => $nome, 
                        ':dataNascimento' => $dataNascimento
                    ));
                    header("Location: index.php");
                    exit();
                }
            }
        }
    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>