<html>
    <?php
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $db = "biblioteca";
        $conexao=mysqli_connect($servidor, $usuario, $senha, $db);

        if(!$conexao){
    ?>
            <script>
                alert("Status Banco: Não Conectado!");
                window.location.hef = "index.html";
            </script>
        <?php    
            }else{
        ?>
            <script>
                //alert("Status Banco: Conectado!");
            </script>
        <?php
        }
        ?>
</html>
