
<?php include '../layout/header.blade.php'; 


// Conectar a la base de datos
$conn = new mysqli("localhost", "root", "", "eventos");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Insertar calificaciones
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evento = $_POST['evento'];
    $juez = $_POST['juez'];
    $calificacion = $_POST['calificacion'];

    $sql = "INSERT INTO calificaciones (evento, juez, calificacion) VALUES ('$evento', '$juez', '$calificacion')";
    $conn->query($sql);
}

// Obtener calificaciones registradas
$result = $conn->query("SELECT * FROM calificaciones");
$datos = [];
while ($row = $result->fetch_assoc()) {
    $datos[] = $row;
}

// Calcular promedios por evento
$promedios_por_evento = [];
foreach ($datos as $dato) {
    $evento = $dato['evento'];
    if (!isset($promedios_por_evento[$evento])) {
        $promedios_por_evento[$evento] = [];
    }
    $promedios_por_evento[$evento][] = $dato['calificacion'];
}

// Calcular promedios finales por evento
$ponderacion_por_evento = [];
foreach ($promedios_por_evento as $evento => $califs) {
    $ponderacion_por_evento[$evento] = number_format(array_sum($califs) / count($califs), 2);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Calificaciones</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 10px;
        }
        input, button {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        #grafica {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registrar Calificación</h2>
    <form method="POST">
        <input type="text" name="evento" placeholder="Nombre del evento" required>
        <input type="text" name="juez" placeholder="Nombre del juez" required>
        <input type="number" step="0.1" name="calificacion" placeholder="Calificación (0-10)" required>
        <button type="submit">Registrar</button>
    </form>

    <h2>Calificaciones Registradas</h2>
    <table>
        <tr>
            <th>Evento</th>
            <th>Juez</th>
            <th>Calificación</th>
        </tr>
        <?php foreach ($datos as $dato) { ?>
            <tr>
                <td><?= htmlspecialchars($dato['evento']) ?></td>
                <td><?= htmlspecialchars($dato['juez']) ?></td>
                <td><?= htmlspecialchars($dato['calificacion']) ?></td>
            </tr>
        <?php } ?>
    </table>

    <h2>Ponderación Final por Evento</h2>
    <table>
        <tr>
            <th>Evento</th>
            <th>Ponderación Final</th>
        </tr>
        <?php foreach ($ponderacion_por_evento as $evento => $ponderacion) { ?>
            <tr>
                <td><?= htmlspecialchars($evento) ?></td>
                <td><?= $ponderacion ?></td>
            </tr>
        <?php } ?>
    </table>

    <h2>Gráfica de Promedios</h2>
    <canvas id="grafica"></canvas>
</div>

<script>
    const ctx = document.getElementById('grafica').getContext('2d');
    const chartData = {
        labels: <?= json_encode(array_keys($ponderacion_por_evento)) ?>,
        datasets: [{
            label: 'Promedio de Calificaciones por Evento',
            data: <?= json_encode(array_values($ponderacion_por_evento)) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };

    new Chart(ctx, {
        type: 'pie',
        data: chartData
    });
</script>

</body>
</html>

