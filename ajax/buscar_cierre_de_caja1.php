<! DOCTYPE html>
<html lang="es">
<Cabeza>
    <meta charset="UTF-8">
    <título>Listado Por Fecha</título>
	<meta nombre="Autor" contenido=""/>
</Cabeza>
<Cuerpo>

<Forma>
  <h1>Búsqueda por Fecha</h1>
 Fecha inicio: <br/>
    <input type="text" id="start_date" nombre="start_date" valor="09/01/2015" marcador de posición="mm/dd/aaaa"></input> 
    Fecha final:<br/>
    <input type="text" id="end_date" nombre="end_date" valor="10/01/2015" marcador de posición="mm/dd/aaaa"></input>
    <br/>
    Fecha:<br/>

    <input type="hidden" id="form_sent" name="form_sent" value="true"></input>
    <button text="enviar" id="btn_submit" valor="Enviar"></button>
    <br/>

</Forma>


<Hr>

<?php if (isset($_GET['form_sent']) &&  $_GET['form_sent'] == "true") {?>

<?php include_once('connections/connect.php'); ?>
<?php

     $SDATE  =  $_GET['start_date'];
     $SSDATE  = explosión('/',  $SDATE );
     $START_DATE  =  $SSDATE[2]. "-".  $SSDATE[0]. "-".  $SSDATE[1];
    echo('<h3>'. $START_DATE. '</h3>');

     $EDATE  =  $_GET['end_date'];
     $EEDATE  = explotar('/',  $EDATE );
     $END_DATE  =  $EEDATE[2]. "-".  $EEDATE[0]. "-".  $EEDATE[1];
    echo('<h3>'. $END_DATE. '</h3>');


    SELECCIONE * DE LA PRUEBA DONDE course_date ENTRE '2015-01-09' Y '2015-10-01'

   $strsql = "SELECT * FROM backup WHERE course_date BETWEEN '$START_DATE' Y '$END_DATE'";


   $rs = mysql_query($strsql) o morir(mysql_error());
   $fila = mysql_fetch_assoc($rs);
   $total_rows = mysql_num_rows($rs);

  print_r($row);
?>


<ancho de la tabla ="800" borde="0" cellspacing="0" cellpadding="2">
    <Tr>
        <td>Id</td>
        <td>Curso</td>
        <td>Fecha</td>
    </Tr>

<?php si ($total_rows > 0) {
        hacer {
?>
    <Tr>
        <td><?php echo($fila['id']); ?></td>
        <td><?php echo($row['course']); ?></td>
        <td><?php echo($fila['course_date']); ?></td>
    </Tr>
<?php
        } while (  $fila = mysql_fetch_assoc($rs) );
        mysql_free_result($rs);
    } Más {
?>
    <Tr>
        <td colspan="3">No se han encontrado datos. </td>
    </Tr>

<?php } ?>
</Mesa>
<?php } ?>

</Cuerpo>
</Html>