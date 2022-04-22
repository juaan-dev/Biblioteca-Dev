<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Livros</title>
    <link rel="stylesheet" href="css/exclusão/exclusão.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
    <div class="content">
        <div>
            <form method="post" >
                <h1>Exclusão de Livro</h1>
            
                <label for="Exclusão">
                    <h2>Para exclusão de qualquer livro, insira o "Código"
                    do livro na aba abaixo</h2>
                    <span>Código ISBN-10</span>
                    <input type="text" name="codigo" id="codigo_livro" required="required">
                </label>

                <input type="submit" name="excluir" value="Deletar" required="required">
            </form>
        </div>
        <div>
            <?php
            if(isset($_POST["excluir"])){
                include_once 'conexao.php';
                $id = $_POST["codigo"];
                $query_sel = "SELECT * FROM livros WHERE codigo='$id'";
                $query_del = "DELETE FROM livros WHERE codigo='$id'";
                $dados = mysqli_query($conexao, $query_sel) or die('<script type="text/javascript">alert("Erro na query!");</script>');;
                $cont = mysqli_num_rows($dados);
                if(is_numeric($id)){    
                    if($cont<1){
                        echo '<br><br>
                        <table style="border:5px solid white;background:white; border-radius:5px ">
                            <tr>
                                <th ><strong style="color:red">Livro não encontrado!<strong></th>
                            </tr>
                        </table>';	
                    }
                    else{
                        mysqli_query($conexao, $query_del) or die('<script type="text/javascript">alert("Erro na query!");</script>');
                        echo '<br><br>
                        <table style="border:5px solid white;background:white; border-radius:5px ">
                            <tr>
                                <th ><strong style="color:green">Livro excluído com sucesso!<strong></th>
                            </tr>
                        </table>';	
                    }
                }
                else{
                    echo '<br><br>
                    <table style="border:5px solid white;background:white; border-radius:5px">
                        <tr>
                            <th><strong style="color:red">Por favor, insira um código númerico ISBN-10<strong></th>
                        </tr>
                    </table>';	
                }
                }
            ?>


        </div>
        <div class="footer">
             <div class="footer_button" id="home">
                     <a href="pagina_inicial.html">
                        <img src="./assets/home.png" alt="">
                     </a>
             </div>
            </div>
    </div>
</body>
</html>