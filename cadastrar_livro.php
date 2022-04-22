<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
    <link rel="stylesheet" href="css/cadastrar_livro/cadastrar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="/js/main.js"></script>
    <style>
        .title_home{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 12px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="content">
        <div id="cadastro">
            <h1>Cadastrar Livro</h1>
        <div class="resultadoCadastrar">
            <?php
                // Conexão com o banco de dados
                if(isset($_POST["btn_cadastrar"])){
                    include_once 'conexao.php';
                    $codigo = $_POST["codigo"];
                    $titulo = $_POST['titulo'];
                    $autor = $_POST['autor'];
                    $editora = $_POST['editora'];
                    $a_conhecimento = $_POST['a_conhecimento'];
                    $ano = $_POST['ano'];
                // Verifica os campos de forms pra checar se código é númerico e se os demais campos estão vazios ou não
                        $target_dir = "uploads/capas/";
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            // Verifica imagem
                            // Se o usuário clicou no botão cadastrar efetua as ações
                        if(isset($_POST["btn_cadastrar"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                                //echo "O arquivo é uma imagem - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo ('<br><table style="border:5px solid white;background:white; border-radius:5px  "><th><strong style="color:red">Imagem não foi carregada, cadê?!</strong></th> </table><br>');
                                $uploadOk = 0;
                        }
                        }
                            // Verifica o tamanho do arquivo
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo nl2br("<center><strong>Desculpe, seu arquivo é muito grande.</strong></center>\n");
                            $uploadOk = 0;
                        }
                            // Permite certos formatos de arquivos
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                            echo nl2br("<center><strong>Somente JPG, JPEG, PNG & GIF arquivos são permitidos.</strong></center>\n");
                            $uploadOk = 0;
                        }
                            // Verifica se $uploadOk está em 0 por um erro
                        if ($uploadOk == 0) {
                            echo nl2br("<center><strong>A imagem não foi enviada!</strong></center>\n");
                            
                            // Se tudo estiver certo tente enviar o arquivo
                        } else {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                    //echo "O arquivo ". basename( $_FILES["fileToUpload"]["name"]). " foi enviado.";
                            } else {
                                echo "Desculpe ocorreu um erro ao enviar seu arquivo.";
                            }
                        }
                
                        $imagem = basename($_FILES["fileToUpload"]["name"]);
                            //echo "".$imagem;
                            
                            
                        $path="/wamp64/www/Biblioteca/uploads/sinopse/"; // Caminho para Windows, software WAMP
                        //$path="/xampp/htdocs/Biblioteca/uploads/sinopse/"; Caminho para Windows, software  XAMPP
                        $titulo_arquivo = $_POST["titulo"];
                        $sinopse = $_POST["sinopse"];
                        $myfile = fopen($path.$titulo_arquivo.".txt","w");//Abre arquivo .txt
                        fwrite($myfile,$sinopse); //Escreve sinopse no arquivo .txt
                        fclose($myfile); //Fecha arquivo .txt
                        if (is_numeric($codigo) && (!empty($codigo)) && (!empty($titulo)) && (!empty($autor)) && (!empty($editora)) && (!empty($a_conhecimento)) && (!empty($ano)) && (!empty($_FILES["fileToUpload"]["tmp_name"])) ) {
                
                        $sql = "INSERT INTO livros (codigo, titulo, autor, editora, a_conhecimento, ano, sinopse, imagem) VALUES ('$codigo', '$titulo', '$autor' , '$editora', '$a_conhecimento', '$ano', '$titulo', '$imagem')";
                        if(mysqli_query($conexao,$sql)){
                            echo '<br><br>
                            <table style="border:5px solid white;background:white; border-radius:5px  ">
                                <tr>
                                    <th><strong style="color:green">Novo livro inserido com sucesso!<strong></th>
                                </tr>
                            </table>';	
                            }else{
                                echo '<br><br>
                                <table style="border:5px solid white;background:white; border-radius:5px  ">
                                    <tr>
                                        <th><strong style="color:green">Erro ao inserir novo livro!<strong></th>
                                    </tr>
                                </table>';	
                            }
                    }
                    else if(!is_numeric($codigo)){

                        echo '<br><br>
                        <table style="border:5px solid white;background:white; border-radius:5px  ">
                            <tr>
                                <th><strong style="color:red">Por favor, insira um código númerico ISBN-10<strong></th>
                            </tr>
                        </table>';	
                    }
                }
            ?>
        </div>
            <form method="post" enctype="multipart/form-data"> 

                <label for="codigo">
                    <span>Codigo ISBN-10</span>
                    <input type="text" id="codigo" name="codigo" required="required"> 
                </label>

                <label for="titulo">
                    <span>Titulo</span>
                    <input type="text" id="titulo" name="titulo" required="required"> 
                </label>
            
                <label for="autor">
                    <span>Autor(a)</span>
                    <input type="text" id="autor" name="autor" required="required"> 
                </label>

                <label for="editor">
                    <span>Editora</span>
                    <input type="text" id="editor" name="editora" required="required"> 
                </label>

                <label for="a_conhecimento">
                    <span>Área de Conhecimento</span>
                    <input type="text" id="a_conhecimento" name="a_conhecimento" required="required"> 
                </label>

                <label for="ano">
                    <span>Ano</span>
                    <input type="number" id="ano" name="ano" required="required"> 
                </label>


                <label for="sinopse">
                    <span>Sinopse</span><br>
                    <textarea name="sinopse" id="sinopse" cols="54" rows="8" required="required" class="sinopse"></textarea>
                </label><br>

                
                    <span>Capa da obra</span>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="capa" style="width: 500px; height: 25px;"/>
            
                <input type="submit" id="btn_cadastrar" name="btn_cadastrar" value="Cadastrar" required="required">
            </form>
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