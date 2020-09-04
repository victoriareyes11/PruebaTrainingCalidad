<?php 
 session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Solución del primer punto</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>
<?php 
    if(!empty($_POST['enviar'])){
        $_SESSION["distancia"] = $_POST['distancia'];
        $_SESSION["dias"] = $_POST['dias'];
        $valor_km=35.00;
                    
    
        if($_SESSION["distancia"]>1000 && $_SESSION["dias"]>7){
            $_SESSION["valor_pasaje"]=$valor_km*$_SESSION["distancia"];
            $descuento=$valor_km*$_SESSION["distancia"]*0.3;
            $_SESSION["valor_pasaje"]=$_SESSION["valor_pasaje"]-$descuento;
            header('Location: '.$_SERVER['PHP_SELF']);
            return;
      
        }else{
            $_SESSION["valor_pasaje"]=$valor_km*$_SESSION["distancia"];
            header('Location: '.$_SERVER['PHP_SELF']);
            return;
                    
        }
    
    }
?>
    <div class="container content">
        <div class="card" style="margin-top: 40px;" >
            <div class="row">
    
                <div class="col-md-8 offset-md-2">  
     
                    <div class="card-header">
                        <h4	class="text-primary">Calculadora para determinar el valor de un pasaje en avión</h4>
                    </div>
    
                </div>
    
                <div class="col-md-6 offset-md-3">
                    <div class="card-body">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
                            <?php 
                            if(!empty($_SESSION["valor_pasaje"])){
                                echo('<h6  class="text-center">El valor del pasaje es : $'.($_SESSION["valor_pasaje"])."</h6>\n");
                                unset($_SESSION["valor_pasaje"]);
                                
                                
                                }
                            
                            ?>  
                            <div class="form-group">
                                <label for="distancia">Ingrese el valor de la distancia a recorrer</label>
                                <input type="number" name="distancia"	class="form-control" id="distancia"	placeholder="Ingrese el valor en Km" required>
                            </div>
                            <div class="form-group">
                                <label for="dias">Ingrese el número de días de estancia</label>
                                <input type="number" name="dias"	class="form-control" id="dias"	placeholder="Ingrese el número de días" required>
                            </div>
                            <input  type="submit" name="enviar" value="Enviar"  class="btn btn-primary col-md-8 offset-md-2"><br>

            
                        </form>
                    </div>
    
                </div>
            </div>
                <a class="text-center"href="../index.html">Salir</a>
        </div>
    </div>


</body>
</html>