<?php
// upload_form.php
if (isset($_GET['columns'])) {
    $columns = explode(",", $_GET['columns']);
    
    // Mapeamento padrão para cada coluna do banco de dados com base no CSV
    $default_mapping = [
        'cpf' => 'Documento',
        'nome' => 'Nome do Cliente',
        'CEP' => 'Cep',
        'cidade' => 'Cidade',
        'estado' => 'Estado',
        'rua' => 'Endereço',
        'numero' => 'Número',
        'data_compra' => 'Data Final do Pagamento',
        'produto_preco' => 'Preço do Plano',
        'bairro' => 'Bairro',
        'celular' => 'Telefone do Cliente',
        'produtos' => 'Plano'
    ];
    
    // Colunas do banco de dados
    $db_columns = array_keys($default_mapping);
    
    echo '<form action="upload.php" method="post">';
    echo '<input type="hidden" name="filename" value="' . $_GET['filename'] . '">';
    
    // Gerar selects com pré-seleção
    foreach ($db_columns as $db_column) {
        echo '<label for="' . $db_column . '">' . ucfirst($db_column) . ':</label>';
        echo '<select name="mapping[' . $db_column . ']" required>';
        
        foreach ($columns as $index => $column) {
            // Verifica se a coluna do CSV corresponde à coluna padrão definida
            $selected = ($column == $default_mapping[$db_column]) ? 'selected' : '';
            echo '<option value="' . $index . '" ' . $selected . '>' . htmlspecialchars($column) . '</option>';
        }
        
        echo '</select><br><br>';
    }
    
    // Campos adicionais
    echo '<h3>Campos adicionais</h3>';
    echo '<label for="link_checkout">Link de Checkout:</label>';
    echo '<input type="text" name="link_checkout" required><br><br>';
    
    echo '<label for="categoria">Categoria:</label>';
    echo '<input type="text" name="categoria" required><br><br>';
    
    echo '<label for="taxa_preco">Taxa Preço:</label>';
    echo '<input type="number" name="taxa_preco" step="0.01" required><br><br>';
    
    echo '<button type="submit" name="import">Importar Dados</button>';
    echo '</form>';
} else {
    echo '<h2>Upload de Arquivo CSV</h2>';
    echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
    echo '<label for="file">Escolha o arquivo CSV:</label>';
    echo '<input type="file" name="file" id="file" required><br><br>';
    echo '<button type="submit" name="upload">Upload</button>';
    echo '</form>';
}
?>