<?php
// Conectar directamente a la base de datos
$conn = new mysqli("localhost", "root", "", "eventos");

// Verificar la conexión
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

// Calcular promedios y ponderación final por evento
$promedios_por_evento = [];
$ponderacion_por_evento = [];

foreach ($datos as $dato) {
    $evento = $dato['evento'];
    if (!isset($promedios_por_evento[$evento])) {
        $promedios_por_evento[$evento] = [];
    }
    $promedios_por_evento[$evento][] = $dato['calificacion'];
}

// Calcular promedios por evento y ponderación final
foreach ($promedios_por_evento as $evento => $califs) {
    $promedios_por_evento[$evento] = array_sum($califs) / count($califs);
    $ponderacion_por_evento[$evento] = number_format($promedios_por_evento[$evento], 2);
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
        /* Estilo para la gráfica (tamaño reducido) */
        #grafica {
            width: 50%; /* Ajusta el tamaño a la mitad */
            height: 300px; /* Ajusta la altura de la gráfica */
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <h2>Registrar Calificación</h2>
    <form method="POST">
        <input type="text" name="evento" placeholder="Nombre del evento" required>
        <input type="text" name="juez" placeholder="Nombre del juez" required>
        <input type="number" step="0.1" name="calificacion" placeholder="Calificación (0-10)" required>
        <button type="submit">Registrar</button>
    </form>

    <h2>Calificaciones Registradas</h2>
    <table border="1">
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
    <table border="1">
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

    <h2>Gráfica de Calificaciones</h2>
    <canvas id="grafica"></canvas>

    <script>
        const ctx = document.getElementById('grafica').getContext('2d');
        const chartData = {
            labels: <?= json_encode(array_keys($promedios_por_evento)) ?>,
            datasets: [{
                label: 'Promedio de Calificaciones por Evento',
                data: <?= json_encode(array_values($promedios_por_evento)) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
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
            type: 'pie', // Se cambia a pastel
            data: chartData
        });
    </script>

</body>
</html>
