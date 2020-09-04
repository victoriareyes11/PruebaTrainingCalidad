<?php 
 session_start();
 require_once"./conexionBD.php";
 error_reporting(E_ALL ^ E_NOTICE);
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Solución del segundo punto</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>

<body>

<?php 
   
    if(!empty($_POST['enviar'])){
        $_SESSION["peso"] = $_POST['peso'];
        if( $_SESSION["peso"]>=-1 ){
            if( $_SESSION["peso"]<501){

                if($_SESSION["peso"]>=0 && $_SESSION["peso"]<26){
                    $_SESSION["valor"]=0;
                    ingresoBD();
                    header('Location: '.$_SERVER['PHP_SELF']);
                    return;
                }
                if($_SESSION["peso"]>25 && $_SESSION["peso"]<301){
                    $_SESSION["valor"]=$_SESSION["peso"]*1500;
                    ingresoBD();
                    header('Location: '.$_SERVER['PHP_SELF']);
                    return;
                }
                if($_SESSION["peso"]>299 && $_SESSION["peso"]<501){
                    $_SESSION["valor"]=$_SESSION["peso"]*2500;
                    ingresoBD();
                    header('Location: '.$_SERVER['PHP_SELF']);
                    return;
                }
            }else{
                $_SESSION["error"]=true;
                header('Location: '.$_SERVER['PHP_SELF']);
                return;
            }
        }else{
            $_SESSION["error2"]=true;
            header('Location: '.$_SERVER['PHP_SELF']);
            return;
        }
    }

    if(!empty($_POST['restablecer'])){
        echo ("entro");
        unset($_SESSION["count"]);
        $pdo = conexionSQL();
        $stmt = $pdo->prepare('DELETE FROM infobultos');
        $stmt->execute( );

    }
    function ingresoBD(){
        
        $pdo = conexionSQL();
        $_SESSION["count"]=$_SESSION["count"]+1;
            $stmt = $pdo->prepare('INSERT INTO infobultos(kilo, valor) VALUES ( :kilo, :valor)');
                    
                $stmt -> bindParam(":kilo", $_SESSION["peso"], PDO::PARAM_STR);
                $stmt -> bindParam(":valor", $_SESSION["valor"], PDO::PARAM_INT);
                $stmt->execute( );

                $stmt2 = $pdo->query('SELECT* FROM infobultos ORDER BY infobultos.kilo DESC LIMIT 1');
                $row=$stmt2->fetch(PDO::FETCH_ASSOC);
                $_SESSION["maxvalor"]=$row["kilo"];

                $stmt3 = $pdo->query('SELECT* FROM infobultos ORDER BY infobultos.kilo ASC LIMIT 1');
                $row2=$stmt3->fetch(PDO::FETCH_ASSOC);
                $_SESSION["minvalor"]=$row2["kilo"];

                $stmt4 = $pdo->query('SELECT SUM(kilo) as total FROM infobultos');
                $row3=$stmt4->fetch(PDO::FETCH_ASSOC);
                $_SESSION["promedio"]=$row3["total"]/$_SESSION["count"];
                $_SESSION["promedio"]=round($_SESSION["promedio"],3);

                $stmt5 = $pdo->query('SELECT SUM(valor) as totalv FROM infobultos');
                $row4=$stmt5->fetch(PDO::FETCH_ASSOC);
                $_SESSION["ingresos"]=$row4["totalv"];
                $_SESSION["dolares"]=$_SESSION["ingresos"]*0.00028;

                
    }
?>


    <div class="container content">
        <div class="card" style="margin-top: 40px;" >
            <div class="row">
    
                <div class="col-md-8 offset-md-2">  
     
                    <div class="card-header">
                        <h4	class="text-info">Calculadora para determinar el valor del equipaje</h4>
                    </div>
    
                </div>
    
                <div class="col-md-6 offset-md-3">
                    <div class="card-body">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
                        <?php 
                            if(!empty($_SESSION["peso"])  && $_SESSION["error"]==false && $_SESSION["error2"]==false){
                                
                                echo('<h6  class="text-center">Valor a pagar : $'.($_SESSION["valor"])."</h6>\n");
                                echo('<h6  class="text-center">Numero total de bultos : '.$_SESSION["count"]."</h6>\n");
                                echo('<h6  class="text-center">Peso del bulto mas liviano : '.$_SESSION["minvalor"]."Kg"."</h6>\n");
                                echo('<h6  class="text-center">Peso del bulto mas pesado : '.$_SESSION["maxvalor"]."Kg"."</h6>\n");
                                echo('<h6  class="text-center">Pesos por concepto de carga : '.$_SESSION["ingresos"]."</h6>\n");
                                echo('<h6  class="text-center">Dolares por concepto de carga : '.$_SESSION["dolares"]."</h6>\n");
                                echo('<h6  class="text-center">Peso promedio de los bultos : '.$_SESSION["promedio"]."</h6>\n");
                                unset($_SESSION["valor"]);
                                unset($_SESSION["peso"]);
                                unset($_SESSION["error"]);
                                
                                
                                
                                }
                            if($_SESSION["error"]==true){
                                echo('<h6  class="text-center">Error: El peso del equipaje supera el peso maximo '."</h6>\n");
                                unset($_SESSION["error"]);
                                unset($_SESSION["valor"]);
                                unset($_SESSION["peso"]);
                                
                            }

                            if($_SESSION["error2"]==true){
                                echo('<h6  class="text-center">Error: Entrada invalida '."</h6>\n");
                                unset($_SESSION["error2"]);
                                unset($_SESSION["valor"]);
                                unset($_SESSION["peso"]);
                                
                            }
                            
                            ?>
                        
                            <div class="form-group">
                                <label for="peso">Ingrese el peso del equipaje</label>
                                <input type="number" name="peso"	class="form-control" id="peso"	placeholder="Ingrese el valor en Kg" >
                            </div>
                            
                            <div class="row">
                            <div class="col-md-2 col-sm-1 col-1 offset-md-3 offset-2 text-left">
                            <div class="previous">
                            <input  type="submit" name="enviar" value="Enviar"  class="btn btn-info   previus">
                            </div>
                            </div>
                            <div class=" col-md-2 col-sm-1 col-1 offset-md-1 offset-2 text-right">   
                            <div class=" next">
                            <input  type="submit" name="restablecer" value="Restablecer"  class="btn btn-primary  offset-md-2 next"><br>
                            </div>
                            </div>
                            </div>

                        </form>
                    </div>
    
                </div>
            </div>
            <?php 
            $pdo = conexionSQL();
            $stmt = $pdo->query('SELECT kilo,valor FROM infobultos');?>
                <table class="table-bordered col-md-4 offset-md-4" >
            
                <thead>
                    <tr class="text-center">
                        <th>Peso(Kg)</th>
                        <th>Valor</th>

                    </tr>
                </thead>
        
                <tbody class="text-center">
                   <?php
        
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        echo '<tr>
                            <td>'.$row["kilo"].'</td>
                            <td>'.$row["valor"].'</td>
                           
                        </tr>';

                    }?>
        
                    
        
                </tbody>
        
            </table>
              <a class="text-center"href="../index.html">Salir</a> 

        </div>
    </div>


</body>
</html>