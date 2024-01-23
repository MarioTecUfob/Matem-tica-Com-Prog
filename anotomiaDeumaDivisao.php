<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 06</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        //Capturando os dados do formulário retroalimentado 
        $dividendo = $_GET['dividendo'] ?? 0;
        $divisor = $_GET['divisor'] ?? 1;
    ?>
        <main>
        <h1>Anotomia De Uma Divisão</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get"> <!--Manda os dados para o proprio arquivo, echo simplificado-->
            <label for="dividendo">Dividendo</label>
            <input type="number" name="dividendo" id="dividendo" min="0" value="<?=$dividendo?>">
            <label for="v2">Divisor</label>
            <input type="number" name="divisor" id="divisor" min="1" value="<?=$divisor?>">
            <input type="submit" value="Analisar">
        </form>
    </main>
        <section id ="resultado">
        <h2>Estrutura Da Divisão</h2>
        <?php 
            $divisao = intdiv($dividendo,$divisor); #Pega a divisão inteira
            $resto = $dividendo % $divisor;
            echo "<ul>";
            echo "<li>Dividendo: $dividendo</li>";
            echo "<li>Divisor: $divisor </li>";
            echo "<li>Quociente: $divisao </li>";
            echo "<li>Resto: $resto</li>";
            echo "</ul>";        

            print "A Formula é D = d x q + R ";
            print " => Dividendo = divisor x quociente + Resto </br>";
            
        ?>
        <table class="divisao">
            <tr> <!--Linha -->
                <td><?=$dividendo?></td>
                <td><?=$divisor?></td>
            </tr>
            <tr>
                <td><?=$resto?></td>
                <td><?=$divisao?></td>
            </tr>
        </table>
        <?="Substituindo Temos Que => " . $dividendo . " = " . $divisor . " x " . $divisao . " + " . $resto;?>

    </section>
    <h2>Exemplo</h2>
    <img src="divisor.jpg" alt="Símbolo Matemático" style="display: block; margin: 0 auto; width: 500px;">

    
</body>
</html>