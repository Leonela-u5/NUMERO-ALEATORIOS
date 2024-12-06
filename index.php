<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador Congruencial Cuadrático</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Generador Congruencial Cuadrático</h1>
        <form method="POST" action="process.php" class="bg-white p-4 rounded shadow">
            <div class="mb-3">
                <label for="seed" class="form-label">Semilla Inicial (\(X_0\)):</label>
                <input type="number" name="seed" id="seed" class="form-control" value="<?= htmlspecialchars($_POST['seed'] ?? '') ?>" required placeholder="Ejemplo: 123456">
            </div>
            <div class="mb-3">
                <label for="a" class="form-label">Coeficiente \(a\) (par):</label>
                <input type="number" name="a" id="a" class="form-control" value="<?= htmlspecialchars($_POST['a'] ?? '') ?>" required placeholder="Ejemplo: 4">
            </div>
            <div class="mb-3">
                <label for="b" class="form-label">Coeficiente \(b\):</label>
                <input type="number" name="b" id="b" class="form-control" value="<?= htmlspecialchars($_POST['b'] ?? '') ?>" required placeholder="Ejemplo: 5">
            </div>
            <div class="mb-3">
                <label for="c" class="form-label">Constante \(c\) (impar):</label>
                <input type="number" name="c" id="c" class="form-control" value="<?= htmlspecialchars($_POST['c'] ?? '') ?>" required placeholder="Ejemplo: 7">
            </div>
            <div class="mb-3">
                <label for="m" class="form-label">Módulo \(m\) (\(2^g\)):</label>
                <input type="number" name="m" id="m" class="form-control" value="<?= htmlspecialchars($_POST['m'] ?? '') ?>" required placeholder="Ejemplo: 1000000">
            </div>
            <div class="mb-3">
                <label for="digits" class="form-label">Cantidad de Dígitos:</label>
                <input type="number" name="digits" id="digits" class="form-control" value="<?= htmlspecialchars($_POST['digits'] ?? '') ?>" required placeholder="Ejemplo: 6">
            </div>
            <div class="mb-3">
                <label for="count" class="form-label">Cantidad de Números a Generar:</label>
                <input type="number" name="count" id="count" class="form-control" value="<?= htmlspecialchars($_POST['count'] ?? '100') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Generar Números</button>
        </form>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger mt-3">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
