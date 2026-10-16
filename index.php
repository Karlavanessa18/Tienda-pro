```php
<?php
$nombreTienda = "Vanessa Store";

$nombreProducto = "";
$precio = "";
$cantidad = "";
$subtotal = 0;
$descuento = 0;
$total = 0;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombreProducto = $_POST["producto"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];

    if ($precio <= 0 || $cantidad <= 0) {

        $mensaje = "Ingresa un precio y una cantidad mayores que cero.";

    } else {

        $precio = (float)$precio;
        $cantidad = (int)$cantidad;

        $subtotal = $precio * $cantidad;

        if ($subtotal >= 100000) {

            $descuento = $subtotal * 0.10;

        } elseif ($subtotal >= 50000) {

            $descuento = $subtotal * 0.05;

        } else {

            $descuento = 0;
        }

        $total = $subtotal - $descuento;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vanessa Store - Tienda de productos</title>

    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <header>
        <h1>🛍️ Vanessa Store</h1>
        <p>Encuentra tus productos favoritos</p>
    </header>

    <main>

        <section class="presentacion">

            <img
                src="https://images.unsplash.com/photo-1607082349566-187342175e2f?w=700"
                alt="Compras y productos"
            >

            <div>
                <h2>¡Bienvenido a nuestra tienda!</h2>

                <p>
                    Compra tus productos favoritos y descubre
                    los descuentos especiales que tenemos para ti.
                </p>
            </div>

        </section>

        <section class="contenedor">

            <h2>Calcula el valor de tu compra</h2>

            <form method="POST" action="">

                <label>Nombre del producto:</label>

                <input
                    type="text"
                    name="producto"
                    placeholder="Ejemplo: Camiseta"
                    value="<?php echo htmlspecialchars($nombreProducto); ?>"
                    required
                >

                <label>Precio del producto en pesos:</label>

                <input
                    type="number"
                    name="precio"
                    min="1"
                    step="any"
                    placeholder="Ejemplo: 30000"
                    value="<?php echo htmlspecialchars((string)$precio); ?>"
                    required
                >

                <label>Cantidad de productos:</label>

                <input
                    type="number"
                    name="cantidad"
                    min="1"
                    step="1"
                    placeholder="Ejemplo: 2"
                    value="<?php echo htmlspecialchars((string)$cantidad); ?>"
                    required
                >

                <button type="submit">Calcular compra</button>

            </form>

            <?php if ($mensaje != "") { ?>

                <p class="error">
                    <?php echo $mensaje; ?>
                </p>

            <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

                <div class="resultado">

                    <h2>Resumen de tu compra</h2>

                    <p>
                        Producto:
                        <?php echo htmlspecialchars($nombreProducto); ?>
                    </p>

                    <p>
                        Precio por unidad:
                        $<?php echo number_format($precio, 0, ',', '.'); ?>
                    </p>

                    <p>
                        Cantidad:
                        <?php echo $cantidad; ?>
                    </p>

                    <p>
                        Subtotal:
                        $<?php echo number_format($subtotal, 0, ',', '.'); ?>
                    </p>

                    <p class="descuento">
                        Descuento:
                        $<?php echo number_format($descuento, 0, ',', '.'); ?>
                    </p>

                    <h3>
                        Total a pagar:
                        $<?php echo number_format($total, 0, ',', '.'); ?>
                    </h3>

                </div>

            <?php } ?>

        </section>

        <section class="ofertas">

            <h2>Descuentos de nuestra tienda</h2>

            <div class="tarjetas">

                <div class="tarjeta">
                    <h3>Compra pequeña</h3>
                    <p>Menos de $50.000</p>
                    <strong>Sin descuento</strong>
                </div>

                <div class="tarjeta">
                    <h3>Compra mediana</h3>
                    <p>Desde $50.000</p>
                    <strong>5% de descuento</strong>
                </div>

                <div class="tarjeta">
                    <h3>Compra grande</h3>
                    <p>Desde $100.000</p>
                    <strong>10% de descuento</strong>
                </div>

            </div>

        </section>

    </main>

    <footer>
        <p>Proyecto de práctica PHP - Vanessa Store</p>
    </footer>

</body>

</html>
