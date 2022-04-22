window.addEventListener('load', carregado);   
//CRIAR BANCO, SE NÃO EXISTIR
var db = openDatabase("bibliotecaDB", "1.0", "Biblioteca HTML", 2 * 1024 * 1024);
   // alert("Banco de Dados criado com sucesso!");


//CARREGAR BANCO AO PRESSIONAR BOTÃO DE CADASTRO DE USUÁRIOS!
function carregado(){
        //document.getElementById('btn_user_cadastrar').addEventListener('click',inserir);
        db.transaction(function (tx) {
            tx.executeSql("CREATE TABLE IF NOT EXISTS usuarios (cpf PRIMARY KEY, nome TEXT, senha TEXT)");
        });
        
};

function deletarUsuario(){
    db.transaction(function(tx){
        tx.executeSql('DELETE FROM usuarios');
    });
    alert("Usuários deletados!");
};

function inserir(){
    var cpf = document.getElementById('cpf').value;
    var nome = document.getElementById('nome').value;
    var senha = document.getElementById('senha').value;
    db.transaction(function(tx){
        tx.executeSql('INSERT INTO usuarios (cpf, nome, senha) VALUES(?,?,?)', [cpf,nome,senha]);
    });
    alert("Usuário cadastrado com sucesso!");
};

function Validar(){

    var chave = document.getElementById('cpf').value;
    var senha = document.getElementById('senha').value;

    db.transaction(function (tx) { 
        tx.executeSql(
            "SELECT cpf,senha,nome FROM usuarios WHERE cpf= '"+chave+"' AND senha = '"+senha+"' ", [], function(tx,results){
            // SE TAM FOR MAIOR QUE 0 ENTÃO ENCONTROU O USUÁRIO E A RESPECTIVA SENHA, O VALIDANDO. 
            //SE TAM IGUAL A 0, CPF OU SENHA NÃO ENCONTRADA NO BANCO.
            var tam = results.rows.length;	
            if (tam > 0) {
                for (var i=0; i<tam; i++){  
                    alert("Seja bem vindo, " + results.rows.item(i).nome + "!");
                }
                window.location.href = "pagina_inicial.html";

            }else{
                alert("CPF ou senha incorreta!!!!");

            };
        });
    });	
};

function validar_formulario (){
    if(document.getElementById("cpf").value == "" || document.getElementById("nome").value == "" || document.getElementById("senha").value == ""){
        alert('Por favor, preencha o campos!!');
        }
    else{
        inserir();
        }
    }        


// function Login(){	
// 	var logado = JSON.parse(name("userLogado"));
//     db.transaction(function (tx) { 
//         tx.executeSql(
//             "SELECT nome FROM usuarios WHERE nome= '"+chave+"' AND senha = '"+senha+"' ", [], function(tx,results){
//         });
//     });	
// };



//===========================================================================================================================//
//Funções de validar caracteres do LOGIN

// function validarCPF() {
//     const input = document.getElementById('cpf').value;
//     const regex = /[0-9]/;
//     if(regex.test(input) == false){
//             alert("Você está preenchendo o CPF com caracteres não-numéricos!");
//     }
// };
/*
function validarSenha() {
    const key = document.getElementById('senha').value;
    const text = document.getElementById('content');
    const regexx = /[0-9]/;
    if(regexx.test(key) == false){
        //alert("CPF com caracteres não-numéricos!");
        text.textContent= "Senha com caracteres não-numéricos!";
    }  
};

function validarLogin(){
    let cpf = document.getElementById('cpf').value;
    let password = document.getElementById('senha').value;
    const regExp = /[0-9]/;
    if(cpf.length < 11 || password.length < 6 || (regExp.test(password) == false)){
        alert("CPF ou Senha Inválida!!");
        if(password.length < 6){
            alert("Senha Inválida!!! Caracteres menores que 6!");
        }
        if(regExp.test(password) == false){
            alert("Senha Inválida!!! Foram inseridos caracteres não-numéricos!");
        }
    }
    else{
        alert("Logado com sucesso!!!");
    }
};
*/
function mostrarOcultarSenha() {
    var senha = document.getElementById('senha');
    if(senha.type == "password"){
        senha.type="text";
    }
    else{
        senha.type="password";
    }
};
