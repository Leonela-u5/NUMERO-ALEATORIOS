<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura de datos del formulario
    $seed = $_POST['seed'];//semilla
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $m = $_POST['m'];//para la longitud de los numeros
    $digits = $_POST['digits'];//cantidad de digitos
    $count = $_POST['count'];//cantidad de numeros 

    // Validación de parámetros
    if (strlen((string)$seed) != $digits) {
        header("Location: index.php?error=La semilla inicial debe tener exactamente $digits dígitos.");
        exit;
    }
    if ($a % 2 != 0) {
        header("Location: index.php?error=El coeficiente 'a' debe ser un número par.");
        exit;
    }
    if ($c % 2 == 0) {
        header("Location: index.php?error=La constante 'c' debe ser un número impar.");
        exit;
    }
    if ($m < pow(10, $digits - 1)) {
        header("Location: index.php?error=El módulo 'm' debe ser al menos " . pow(10, $digits - 1) . " para garantizar números de $digits dígitos.");
        exit;
    }

    // Generación de números
    $numbers = [];
    $current = $seed;

    for ($i = 0; $i < $count; $i++) {
        //Aplicacion de la formula del algoritmo congruencial cuadratico
        $next = ($a * $current ** 2 + $b * $current + $c) % $m;

        // Asegurarse de que el número generado tenga exactamente la cantidad de dígitos
        $next_str = (string)$next;
        if (strlen($next_str) != $digits) {
            // Si el número no tiene la cantidad correcta de dígitos, ajustamos
            while (strlen($next_str) < $digits) {
                $next_str = '0' . $next_str; // Añadimos ceros a la izquierda si es necesario
            }
            if (strlen($next_str) > $digits) {
                $next_str = substr($next_str, 0, $digits); // Recortamos el número si es demasiado largo
            }
        }

        $numbers[] = $next_str;
        $current = $next_str;
    }

    // Guardar en archivo
    $file = fopen("numeros_aleatorios.txt", "w");
    fwrite($file, "Números Aleatorios Generados:\n");
    foreach ($numbers as $num) {
        fwrite($file, $num . "\n");
    }
    fclose($file);

    // Mostrar resultados
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Resultados</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
        <div class='container mt-5'>
            <h1 class='text-center text-success'>Resultados</h1>
            <table class='table table-bordered table-striped mt-4'>
                <thead class='table-primary'>
                    <tr><th>Iteración</th><th>Número Generado</th></tr>
                </thead>
                <tbody>";

    foreach ($numbers as $index => $number) {
        echo "<tr><td>" . ($index + 1) . "</td><td>$number</td></tr>";
    }

    echo "</tbody>
            </table>
            <a href='numeros_aleatorios.txt' class='btn btn-success w-100' download>Descargar Números Generados</a>
            <a href='index.php' class='btn btn-secondary w-100 mt-3'>Volver</a>
        </div>
    </body>
    </html>";
}
?>
