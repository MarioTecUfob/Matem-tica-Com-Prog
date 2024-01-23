<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Estatísticas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 400px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
        }
        h3 {
            text-align: center;
            margin-top: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Calculadora de Estatísticas</h2>
        <img src="matematica.jpg" alt="Símbolo Matemático" style="display: block; margin: 0 auto;">
        <h3>Insira os números separados por espaços:</h3>
        <form method="post">
            <label>Números:</label>
            <input type="text" name="numbers" required>
            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numbers = $_POST["numbers"];
            $number_array = explode(" ", $numbers);

            // Funções de cálculo
            function calculate_mean($numbers) {
                if (count($numbers) > 0) {
                    return number_format(array_sum($numbers) / count($numbers), 2);
                } else {
                    return 'N/A';
                }
            }

            function calculate_median($numbers) {
                sort($numbers);
                $count = count($numbers);
                $middle = floor(($count - 1) / 2);
                if ($count % 2 == 0) {
                    return number_format(($numbers[$middle] + $numbers[$middle + 1]) / 2, 2);
                } else {
                    return number_format($numbers[$middle], 2);
                }
            }

            function calculate_mode($numbers) {
                $counts = array_count_values($numbers);
                $maxCount = max($counts);
                $mode = array_filter($counts, function($value) use ($maxCount) {
                    return $value == $maxCount;
                });

                // Verifica se os valores em $mode são numéricos
                $numeric_mode = array_filter(array_keys($mode), 'is_numeric');

                return empty($numeric_mode) ? 'N/A' : implode(", ", $numeric_mode);
            }

            function calculate_variance($numbers) {
                if (count($numbers) > 1) {
                    $mean = array_sum($numbers) / count($numbers);
                    $squared_deviations = array_map(function($x) use ($mean) { return pow($x - $mean, 2); }, $numbers);
                    return number_format(array_sum($squared_deviations) / (count($numbers) - 1), 2);
                } else {
                    return 'N/A';
                }
            }

            function calculate_std_deviation($numbers) {
                if (count($numbers) > 1) {
                    return number_format(sqrt(calculate_variance($numbers)), 2);
                } else {
                    return 'N/A';
                }
            }

            function calculate_coefficient_of_variation($numbers) {
                $mean = calculate_mean($numbers);
                $std_deviation = calculate_std_deviation($numbers);

                if ($mean != 'N/A' && $std_deviation != 'N/A' && $mean != 0) {
                    return number_format(($std_deviation / $mean) * 100, 2); // Coeficiente de variação em porcentagem
                } else {
                    return 'N/A';
                }
            }

            function calculate_amplitude($numbers) {
                if (count($numbers) > 0) {
                    return number_format(max($numbers) - min($numbers), 2);
                } else {
                    return 'N/A';
                }
            }

            // Calcular estatísticas
            $mean = calculate_mean($number_array);
            $median = calculate_median($number_array);
            $mode = calculate_mode($number_array);
            $variance = calculate_variance($number_array);
            $std_deviation = calculate_std_deviation($number_array);
            $coefficient_of_variation = calculate_coefficient_of_variation($number_array);
            $amplitude = calculate_amplitude($number_array);

            echo "<div class='result'>";
            echo "<p>Média: $mean</p>";
            echo "<p>Mediana: $median</p>";
            echo "<p>Moda: $mode</p>";
            echo "<p>Variância Amostral: $variance</p>";
            echo "<p>Desvio Padrão Amostral: $std_deviation</p>";
            echo "<p>Coeficiente de Variação: $coefficient_of_variation%</p>";
            echo "<p>Amplitude: $amplitude</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
