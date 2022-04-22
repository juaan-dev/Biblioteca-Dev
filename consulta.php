<html>
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="css/consultar/consultado.css">
        <style>
            

        </style>
    </head>
    <body>
    <div class="container">
        <?php
            include_once 'conexao.php';

            $id = $_POST["codigo"];
            $query = "SELECT codigo,titulo,autor,editora,a_conhecimento,ano,sinopse,imagem FROM livros WHERE  codigo='$id'";
            $dados = mysqli_query($conexao,$query) or die ('Ocorreu um erro na query: ' . $query);
            $cont = mysqli_num_rows($dados);
            if (is_numeric($id)) {
                if($cont<1){
                    echo ('<br><table style="border:5px solid white;background:white; border-radius:5px  "><th><strong style="color:red">Nenhum livro correspondente foi encontrado!!!</strong></th> </table><br>');
                }else{
                    echo '<p>';
                    echo '<table id="image-table" class="left" align="center" style="font-size: 15px;color: #FFF; border: 5px solid #000;box-shadow: 0px 0px 3px #000;background: #EF4D02;border-collapse: collapse;">';
                    echo '<thead>';
                    echo '<th>Capa</th>';
                    while($linha=mysqli_fetch_array($dados,MYSQLI_ASSOC)){
                        echo '</thead>';
                        echo '<tbody id="tbody-sinopse"></tbody>';
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #ED6125;"" > <img width="250" height="350" src="uploads/capas/'.$linha["imagem"].'"></a><td>';
                        echo '</table>';
                        echo '</p>';
                        echo '<p>';
                        echo '<table id="table-register" style="font-size: 15px;color: #FFF; border: 5px solid #F26522;box-shadow: 0px 0px 3px #000;background: #EF4D02;border-collapse: collapse;">';
                        echo '<thead>';
                        echo '<th style="padding: 5px 10px;font-weight: bold;width: 1000px;text-align: justify;border-right: 3px solid #000;">ISBN</th>';
                        echo '<th style="padding: 5px 10px;font-weight: bold;width: 1000px;text-align: justify;border-right: 3px solid #000;">Título</th>';
                        echo '<th style="padding: 5px 10px;font-weight: bold;width: 1000px;text-align: justify;border-right: 3px solid #000;">Autor(a)</th>';
                        echo '<th style="padding: 5px 10px;font-weight: bold;width: 1000px;text-align: justify;border-right: 3px solid #000;">Editora</th>';
                        echo '<th style="padding: 5px 10px;font-weight: bold;width: 1000px;text-align: justify;border-right: 3px solid #000;">Área de Conhecimento</th>';
                        echo '<th style="padding: 5px 10px;font-weight: bold;width: 1000px;text-align: justify;border-right: 3px solid #000;">Ano de publicação</th>';
                        echo '</thead>';
                        echo '<tbody id="tbody-register">';
                        echo '<tr style="tr:nth-of-type(odd) td{background: #ED6125;}">';
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #4169E1;"">'.$linha["codigo"]. '</td>';
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #4169E1;"">'.$linha["titulo"]. '</td>';
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #4169E1;"">'.$linha["autor"]. '</td>';
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #4169E1;"">'.$linha["editora"]. '</td>';
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #4169E1;"">'.$linha["a_conhecimento"]. '</td>';
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #4169E1;"">'.$linha["ano"]. '</td>';
                        echo '</tbody>';
                        echo '</table>';
                        echo '</p>';
                        echo '<table id="sinopse-table" class="left" style="font-size: 15px;color: #FFF; border: 5px solid #F26522;box-shadow: 0px 0px 3px #000;background: #EF4D02;border-collapse: collapse;">';
                        echo '<thead>';
                        echo '<th>Sinopse</th>';
                        echo '</thead>'; 
                        echo '<tbody id="tbody-sinopse">';
                        echo '<tr style="tr:nth-of-type(odd) td{background: #ED6125;}">';
                        $pasta="/wamp64/www/Biblioteca/uploads/sinopse/";   // para Software WAMP
                        //$pasta="/xampp/htdocs/Biblioteca/uploads/sinopse/"; // para Software XAMPP
                        $titulo_arquivo = $linha["titulo"];
                        $arquivo_sinopse = $linha["sinopse"];
                        $myfile = fopen($pasta.$titulo_arquivo.".txt","r") or die ("Não foi possível abrir o arquivo!");
                        echo '<td style="td:first-of-type{cursor: pointer;};background: #4169E1;text-align: justify;">';
                        while(!feof($myfile)){
                            echo fgets($myfile).'<br>';
                        }
                        echo '</td>';
                        echo '</tr>';  
                        echo '</tbody>';
                        fclose($myfile);
                    }   
                    echo '</table>';
                }
            }else{

            echo '<br><br>
                <table style="border:5px solid white;background:white ">
                    <tr>
                        <th><strong style="color:red">Por favor, insira um código númerico ISBN-10<strong></th>
                    </tr>
                </table>';	
        ?>
        <?php
        }
        ?>
            <div class="footer">
                    <div class="footer_button" id="home">
                            
                    <a href="pagina_inicial.html">
                        <img src="./assets/home.png" alt="">
                    </a>
                    </div>
                    <p class="title_home" style="font-weight: bold;">Menu Principal</p>
            </div>
    </div>
    </body>
</html>



