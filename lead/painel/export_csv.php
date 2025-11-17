<?php
// export_csv.php
$host = 'localhost';
$dbname = 'correioscpf';
$username = 'user';
$password = 'Zreel123!';

// Conectar ao banco de dados
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}

// Função para exportar CSV sem aspas adicionais
function exportCSV($data, $headers, $filename) {
    if (!empty($data)) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');

        // Escreve o cabeçalho manualmente sem usar fputcsv
        echo implode(',', $headers) . "\n";

        // Escreve cada linha de dados manualmente
        foreach ($data as $row) {
            // Remove aspas e vírgulas indesejadas e imprime a linha
            $line = array_map(function($value) {
                return str_replace(["\"", ","], ["", ""], $value);
            }, $row);
            echo implode(',', $line) . "\n";
        }

        fclose($output);
        exit; // Finaliza o script após exportar
    } else {
        echo "Nenhum dado encontrado para exportação.";
    }
}

// Exportação por categoria e contatos com condições específicas para cada botão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['export_categoria']) && isset($_POST['categoria'])) {
        $categoria = $_POST['categoria'];
        $stmt = $pdo->prepare("SELECT celular, nome, cep, produtos FROM lead_cadastro WHERE categoria = :categoria");
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        exportCSV($data, ['Celular', 'Nome', 'CEP', 'Produtos'], 'dados_exportados.csv');
    }

    if (isset($_POST['export_contatos'])) {
        $stmt = $pdo->query("SELECT nome, celular FROM lead_cadastro");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        exportCSV($data, ['First Name', 'Phone'], 'contatos_exportados.csv');
    }
}

// Obter categorias disponíveis
$categorias = $pdo->query("SELECT DISTINCT categoria FROM lead_cadastro")->fetchAll(PDO::FETCH_COLUMN);
?>

<h1>Exportar Dados por Categoria</h1>
<form method="POST" action="export_csv.php">
    <label for="categoria">Selecione a Categoria:</label>
    <select name="categoria" id="categoria" required>
        <option value="">-- Selecione --</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" name="export_categoria">Exportar</button>
</form>

<h1>Exportar Contatos</h1>
<form method="POST" action="export_csv.php" style="margin-top: 20px;">
    <button type="submit" name="export_contatos">Exportar Contatos</button>
</form>
