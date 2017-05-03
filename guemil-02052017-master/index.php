<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Guemil Project · Test Results</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="http://www.guemil.info/wp-content/themes/guemil/images/favicon.png" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,900' rel='stylesheet' type='text/css'>
<link href="style.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
$json = file_get_contents('http://guemil.info/results/data.json');
$json_data = json_decode($json,true);
?>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-12">
<header>
<h1><a href="http://www.guemil.info">Guemil Project</a></h1>
<hr>
<button type="button" class="btn btn-sm btn-default" id="all">All results</button>
<button type="button" class="btn btn-sm btn-success" id="accepted">Accepted</button>
<button type="button" class="btn btn-sm btn-danger" id="not-accepted">Not accepted</button>
<hr>
</header>
</div><!--/col-sm-12-->

<?php for ($a = 0; $a < $all = count($json_data['test']['pictogramas']); $a++) {?>
<?php $q1=0; $q2=0; $q3=0; $q4=0; $q5=0; $q6=0; ?>
<?php for ($c = 0; $c < $all = count($json_data['test']['pictogramas'][$a]['respuestas']); $c++) {?>
<?php
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "1"){ $q1++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "2"){ $q2++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "3"){ $q3++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "4"){ $q4++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "5"){ $q5++; }
if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "6"){ $q6++; }
$desempeno= ($q1+$q2*0.75+$q3*0.5)*100/($q1+$q2+$q3+$q4+$q5+$q6);
$opuesto = ($q5*100/count($json_data['test']['pictogramas'][$a]['respuestas']));
};?>
<div class="col-sm-6 col-md-3 <?php if ($desempeno >= "83"){ echo ('accepted'); } else{ echo ('not-accepted'); };?>">
<article>
<!--primer fila-->
<div class="row primera">
  <div class="col-xs-6 icono">
    <figure><img class="picto" src="<?php echo($json_data['test']['pictogramas'][$a]['imagen']);?>"/></figure>
  </div>
  <div class="col-xs-6 cifra">
    <?php if ($opuesto >= "5"){ ;?>
    <div class="circle">
      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </div>
    <?php };?>
    <h3 class="<?php if ($desempeno >= "83"){ echo ('aceptable'); } else { echo ('inaceptable'); };?>"><?php echo (round($desempeno));?>%</h3>
    <p>Performance <span lang="es">Desempeño</span></p>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <h2><?php echo($json_data['test']['pictogramas'][$a]['nombre']);?></h2>
  </div>
</div>
<!--segunda fila-->
<div class="row segunda">
  <div class="col-xs-6"><p>Meaning <span lang="es">Significado</span></p></div>
  <div class="col-xs-3"><p>Answer <span lang="es">Respuestas</span></p></div>
  <div class="col-xs-3"><p id="qrespuestas"><?echo (count($json_data['test']['pictogramas'][$a]['respuestas']))?></p></div>
</div>
<!--tercera fila-->
<div class="row qevaluacion">
    <div class="col-xs-4 contador"><h5><?php echo ($q1);?></h5><p>Correct<br><span lang="es">Correcta</span></p></div>
    <div class="col-xs-4 contador"><h5><?php echo ($q2);?></h5><p>Almost correct<br><span lang="es">Casi correcta</span></p></div>
    <div class="col-xs-4 contador"><h5><?php echo ($q3);?></h5><p>Doubtful <br><span lang="es">Dudosa</span></p></div>
    <div class="col-xs-4 contador"><h5><?php echo ($q4);?></h5><p>Incorrect<br><span lang="es">Incorrecta</span></p></div>
    <div class="col-xs-4 contador"><h5><?php echo ($q5);?></h5><p>Opposite<br><span lang="es">Opuesto</span></p></div>
    <div class="col-xs-4 contador"><h5><?php echo ($q6);?></h5><p>No answer<br><span lang="es">Sin respuesta</span></p></div>
</div>
<p id="action">Action <span lang="es">Acción</span></p>
<p><?php if ($desempeno >= "90"){ echo ('Due to its high performance, this pictogram could be used.'); } else if ($desempeno >= "80"){ echo ('Due to its performance, this pictogram can be improved.'); } else if ($desempeno >= "70"){ echo ('Due to its performance, this pictogram should be rethought.'); }else{ echo ('Due to its poor performance, this pictogram should be discarded.'); };?></p>
<p lang="es"><?php if ($desempeno >= "90"){ echo ('Debido a su alto desempeño, este pictograma podría ser aprovechado.'); } else if ($desempeno >= "80"){ echo ('Debido a su desempeño, este pictograma puede ser mejorado.'); } else if ($desempeno >= "70"){ echo ('Debido a su desempeño, este pictograma debería replantearse.'); }else{ echo ('Debido a su bajo desempeño, este pictograma debe ser descartado.'); };?></p>
</article>
</div><!--/col-sm-4-->

<?php };?><!--cierre el for con $a-->
<div class="clearfix"></div>
</div><!--/row-->
</div><!--/container-->

<div class="container-flow">
  <div class="row">
    <div class="col-sm-12">
    <footer><p>Guemil Project by <a href="mailto:rramireo@uc.cl">Rodrigo Ramírez</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.</p></footer>
    </div><!--/col-sm-12-->
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#accepted").click(function(){
        $(".accepted").show(500);
        $(".not-accepted").hide(500);
        $(".opposite").hide(500);
    });
    $("#not-accepted").click(function(){
      $(".accepted").hide(500);
      $(".not-accepted").show(500);
      $(".opposite").hide(500);
    });
    $("#all").click(function(){
      $(".accepted").show(500);
      $(".not-accepted").show(500);
      $(".opposite").show(500);
    });
});
</script>
</body>
</html>
