<?php
$host = "zollim_correios";
$dbname = "correioscpf";
$username = "user";
$password = "Zreel123!";

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Processar upload do arquivo
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $upload_dir = __DIR__ . '/uploads/';
    $filename = $upload_dir . basename($_FILES['file']['name']);
    
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Cria a pasta 'uploads' se não existir
    }
    
    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

    // Ler a primeira linha do CSV para exibir as colunas
    if (($handle = fopen($filename, "r")) !== false) {
        $columns = fgetcsv($handle, 1000, ",");
        fclose($handle);
        header("Location: index.php?columns=" . implode(",", $columns) . "&filename=" . $filename);
        exit();
    }
}

// Função para formatar CPF
function formatarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf); // Remove caracteres não numéricos
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT); // Adiciona zeros à esquerda se necessário
    
    if (strlen($cpf) == 11) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
    }
    
    return $cpf; // Retorna o CPF como está se não for possível formatá-lo
}

// Função para formatar CEP
function formatarCEP($cep) {
    $cep = preg_replace('/\D/', '', $cep); // Remove caracteres não numéricos
    $cep = str_pad($cep, 8, '0', STR_PAD_LEFT); // Adiciona zeros à esquerda se necessário
    return preg_replace("/(\d{5})(\d{3})/", "$1-$2", $cep);
}

// Função para formatar nomes próprios (primeira letra maiúscula de cada palavra)
function formatarNomeProprio($texto) {
    return ucwords(strtolower($texto));
}

// Função para converter formato de data
function formatarData($data) {
    $formatos = ['d/m/Y H:i:s', 'H:i:s d/m/Y', 'd/m/Y'];
    
    foreach ($formatos as $formato) {
        $dataObj = DateTime::createFromFormat($formato, $data);
        if ($dataObj !== false) {
            return $dataObj->format('Y-m-d');
        }
    }
    return null;
}

// Processar importação dos dados
if (isset($_POST['import']) && isset($_POST['filename'])) {
    $filename = $_POST['filename'];
    $mapping = $_POST['mapping'];
    
    $link_checkout = $_POST['link_checkout'];
    $categoria = $_POST['categoria'];
    $taxa_preco = $_POST['taxa_preco'];

    if (($handle = fopen($filename, "r")) !== false) {
        fgetcsv($handle, 1000, ",");

        $sql = "INSERT INTO lead_cadastro (cpf, nome, CEP, cidade, estado, rua, numero, data_compra, produto_preco, bairro, celular, produtos, link_checkout, categoria, taxa_preco)
                VALUES (:cpf, :nome, :CEP, :cidade, :estado, :rua, :numero, :data_compra, :produto_preco, :bairro, :celular, :produtos, :link_checkout, :categoria, :taxa_preco)";
        $stmt = $pdo->prepare($sql);

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $cpf = formatarCPF($data[$mapping['cpf']]);
            $produto_preco = str_replace(',', '.', $data[$mapping['produto_preco']]);
            $data_compra = formatarData($data[$mapping['data_compra']]);
            $cep = formatarCEP($data[$mapping['CEP']]);
            $nome = formatarNomeProprio($data[$mapping['nome']]);
            $cidade = formatarNomeProprio($data[$mapping['cidade']]);
            $rua = formatarNomeProprio($data[$mapping['rua']]);
            $bairro = formatarNomeProprio($data[$mapping['bairro']]);

            $stmt->execute([
                ':cpf' => $cpf,
                ':nome' => $nome,
                ':CEP' => $cep,
                ':cidade' => $cidade,
                ':estado' => $data[$mapping['estado']],
                ':rua' => $rua,
                ':numero' => $data[$mapping['numero']],
                ':data_compra' => $data_compra,
                ':produto_preco' => $produto_preco,
                ':bairro' => $bairro,
                ':celular' => $data[$mapping['celular']],
                ':produtos' => $data[$mapping['produtos']],
                ':link_checkout' => $link_checkout,
                ':categoria' => $categoria,
                ':taxa_preco' => $taxa_preco
            ]);
        }
        
        fclose($handle);
        echo "Dados importados com sucesso!";
    } else {
        echo "Erro ao processar o arquivo.";
    }
}
?>
