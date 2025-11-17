<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }
        .card {
            background-color: #2b2b2b;
            border-radius: 8px;
            padding: 20px;
            width: 700px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            overflow: hidden;
        }
        .card h3 {
            margin: 0 0 10px;
        }
        .card p {
            margin: 0 0 15px;
            color: #a5a5a5;
        }
        .card .icon {
            font-size: 24px;
            margin-bottom: 10px;
            color: #2196f3;
        }
        .novo {
            color: #00ff00;
            font-weight: bold;
        }
        .search-bar {
            margin: 20px auto;
            text-align: center;
        }
        .search-bar input {
            padding: 10px;
            width: 300px;
            border-radius: 8px;
            border: none;
            outline: none;
        }
        .card-content {
            display: none;
            background-color: #333;
            padding: 15px;
            margin-top: 10px;
            border-radius: 8px;
            color: #d3d3d3;
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
    <script>
        function toggleContent(event, cardId) {
            // Impede que a ação seja executada se o clique for em um elemento dentro de card-content
            if (event.target.closest('.card-content')) return;

            var content = document.getElementById(cardId);
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>

    <div class="search-bar">
        <input type="text" placeholder="Search...">
    </div>

    <div class="dashboard-container">
        <div class="card" onclick="toggleContent(event, 'content-system')">
            <h3>Adicionar Leads - CSV</h3>
            <p>Editar as configurações do bot</p>
            <div class="icon">⚙️</div>
            <div id="content-system" class="card-content">
                <?php include('upload_form.php'); ?>
            </div>
        </div>

        <div class="card" onclick="toggleContent(event, 'content-online')">
            <h3>Deletar Leads</h3>
            <p>Deletar Leads, Atualizar link do Checkout, Entre outros</p>
            <div class="icon">🔵</div>
            <div id="content-online" class="card-content">
                <?php include('delete_leads.php'); ?>
            </div>
        </div>

        <div class="card" onclick="toggleContent(event, 'content-users')">
            <h3>Criar CSV</h3>
            <p>Download no formato do template e contato Google</p>
            <div class="icon">⚙️</div>
            <div id="content-users" class="card-content">
                <?php include('export_csv.php'); ?>
            </div>
        </div>

        <div class="card" onclick="toggleContent(event, 'content-users-off')">
            <h3>Criar Template</h3>
            <p>Criar mensagem para WhatsApp!</p>
            <div class="icon">⚙️</div>
            <div id="content-users-off" class="card-content">
                <?php include('create_template.php'); ?>
            </div>
        </div>

        </div>
    </div>

</body>
</html>
