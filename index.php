<?php
    include('restcountries.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Países</title>
    <link rel="stylesheet" type="text/css" href="css/formcss.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<div id="fundo"><diV>
    <nav>
        <h1>Consultar Países</h1>
    </nav>
    <form method="post">
        <input id="campo-pais" type="text" name="pais" list="paises">
        <datalist id="paises">
            <optgroup label="paises">
                <!-- Listar todos os países -->
                <?php
                foreach($jsonall as $todospaises){
                    $ing = $todospaises -> name -> common;
                    $por = $todospaises -> translations -> por -> common;
                    echo '<option value="'.$ing.'">'.$por.'</option>';
                }
                ?>
            </optgroup>
        </datalist>
        <?php
        // Verificar se houve uma tentativa de consulta e se a consulta deu errado
        if(isset ($_POST['pais']) and strpos($http_response_header[0], "200") == false) { 
                echo "<p id='mensagem'>País não encontrado</p>";
            }
        ?>
        <input id="botao" type="submit" value="Pesquisar"/>
        
        <div id="container">
            <div id="bandeira">
                <p>Bandeira:</p>
                <img src="<?php echo @$json[0] -> flags -> svg ?>">
            </div>
            <div id="dados">
                <div class="sub">
                <p class="atributo">Nome Oficial:&nbsp</p><p class="valor"><?php 
                    echo @$json[0] -> translations -> por -> official;
                ?></p>
                </div>
                <div class="sub">
                <p class="atributo">Nome Comum:&nbsp</p><p class="valor"><?php 
                    echo @$json[0] -> translations -> por -> common;
                ?></p>
                </div>
                <div class="sub">
                <p class="atributo">Capital:&nbsp</p><p class="valor"> <?php 
                    if(@$json[0] -> capital != null){
                        foreach(@$json[0] -> capital as $capital){
                            echo $capital ." ";
                        }
                    } 
                ?></p>
                </div>
                <div class="sub">
                <p class="atributo">Área:&nbsp</p><p class="valor"> <?php 
                    // Formatar o número da área para separar em centenas
                    $area = number_format(@$json[0] -> area,0,",","."); 
                    if($area != 0){
                        echo $area ." km²";
                    }
                ?></p>
                </div>
                <div class="sub">
                <p class="atributo">População:&nbsp</p><p class="valor"> <?php
                    // Formatar o número da população para separar em centenas 
                    $populacao = number_format(@$json[0] -> population,0,",",".");
                    if($populacao != 0){
                        echo $populacao;
                    }
                ?></p>
                </div>
                <div class="sub">
                <p class="atributo">Estado de dependência:&nbsp</p><p class="valor"> <?php 
                    $dependencia = @$json[0] -> independent;
                    if(isset($dependencia)){
                        if($dependencia){
                            echo "Independente";
                        } else {
                            echo "Dependente";
                        }
                    }
                ?></p>
                </div>
                <div class="sub">
                <p class="atributo">Região:&nbsp</p><p class="valor"> <?php 
                    $regiao = @$json[0] -> subregion;
                    // Traduzir as regiões
                    switch($regiao){
                        case "South America":
                            echo "América do Sul";
                            break;
                        case "North America":
                            echo "América do Norte";
                            break;
                        case "Central America":
                            echo "América Central";
                            break;
                        case "Australia and New Zealand":
                            echo "Oceania";
                            break;
                        case "Micronesia":
                            echo "Micronésia (Oceania)";
                            break;
                        case "Central Europe":
                            echo "Europa Central";
                            break;
                        case "Caribbean":
                            echo "Caribe (América Central)";
                            break;
                        case "Polynesia":
                            echo "Polinésia (Oceania)";
                            break;
                        case "Melanesia":
                            echo "Melanésia (Oceania)";
                            break;
                        default:
                            // Separar a região e verificar se a região está inteira
                            $regiaoseparada=explode(" ",$regiao);
                            if(isset($regiaoseparada[1])){
                                switch($regiaoseparada[0]){
                                    case "Southern":
                                        echo "Sul da ";
                                        break;
                                    case "Middle":
                                        echo "Meio da ";
                                        break;
                                    case "Western":
                                        echo "Oeste da ";
                                        break;
                                    case "Northern":
                                        echo "Norte da ";
                                        break;
                                    case "Eastern":
                                        echo "Leste da ";
                                        break;
                                    case "South-Eastern" or "Southeast":
                                        echo "Sudeste da ";
                                        break;
                                    default:
                                        echo $regiao;
                                        break;
                                }
                                switch($regiaoseparada[1]){
                                    case "Africa":
                                        echo "África";
                                        break;
                                    case "Europe":
                                        echo "Europa";
                                        break;
                                    case "Asia":
                                        echo "Ásia";
                                        break;
                                    default:
                                        echo $regiao;
                                        break;
                                }
                            }
                            break;
                    }
                ?></p>
                </div>
                <div id="mapabotao"><a target="_blank" href="<?php echo @$json[0] -> maps -> openStreetMaps; ?>"><div>Ver no Mapa</div></a></div>
            </div>
        </div>
    </form>
</div></diV>
</body>
</html>