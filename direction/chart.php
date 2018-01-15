<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='admin' or $_SESSION['role']=='directeurregionale')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{require_once 'header.php';
?>
<title>Statistiques</title>
<link rel="shortcut icon" href="../images/ofppt.ico"/>	
		
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/gettheme.js"></script>
    <script type="text/javascript" src="js/jqxcore.js"></script>
    <script type="text/javascript" src="js/jqxdata.js"></script>
    <script type="text/javascript" src="js/jqxchart.js"></script>
    <script type="text/javascript" src="js/jqxtooltip.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/jqx.base.css" />
	
	    <script type="text/javascript" src="js/jqxbuttons.js"></script>
	<script type="text/javascript" src="js/jqxdropdownlist.js"></script>	
	    <script type="text/javascript" src="js/jqxscrollbar.js"></script>
	<script type="text/javascript" src="js/jqxlistbox.js"></script> 
	
	<script type="text/javascript" src="js/jqxdragdrop.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/icon.css">
<?php
require_once 'barre3.php';
require_once 'menu2.php';
?>

<section id="main" class="column">
	<div id="content">
<style>
#salle{
width: 100%;
border: 1px solid;
border-radius: 4px;
margin-top: 10%;
}
#formateur{
width: 100%;
border: 1px solid;
border-radius: 4px;
}
#salle tr th{
background-color: #F1E4E4;
text-align: center;
font-size: 18px;
color: #A52A2A;
width: 25%;
}
#salle tr td,#formateur tr td{
border: 1px solid;
border-radius: 4px;
text-align: center;
height: 30px;
}

#formateur tr th{
background-color: #F1E4E4;
text-align: center;
font-size: 13px;
color: #A52A2A;
width: 12%;
}
}

</style>	
	
	<div id="aa" class="easyui-accordion" style="height:450px;" >  
		<div title="Salles" data-options="iconCls:'icon-salle',selected:true" style="overflow:auto;padding:10px;">  
			<table id="salle"border =1>
			<tr>
			<th colspan=2>Offre en Heures</th>
			<th colspan=2>Besion actuel</th>
			<th rowspan=2>Disponible</th>
			<th rowspan=2>TAUX</th>
			</tr>
			<tr>
			<td>Pratique</td>
			<td>Théoriques</td>
			<td>Pratique</td>
			<td>Théorique</td>
			</tr>
			<tr>
			<td><?php $results=resultat_salle()  ;echo $results['opr']; ?></td><!--select count(*)*58*39 from salle where type like'%pratique%' and salle.`codeetablissement`='N520'-->
			<td><?php echo $results['oth']; ?></td><!--select count(*)*58*39 from salle where type like'%theorique%' and salle.`codeetablissement`='N520'-->
			<td><?php echo $results['hfpr']; ?></td><!--SELECT sum(`heureaffecterpratique`) FROM `affectation`where affectation.`codeetablissment`='N520'-->
			<td><?php echo $results['hfth']; ?></td><!--SELECT sum(`heureaffectertheorique`) FROM `affectation`where affectation.`codeetablissment`='N520'-->
			<td rowspan=3><?php echo ($results['opr']+$results['oth'])-($results['hfpr']+$results['hfth']); ?></td>
			<td rowspan=3><?php $str=($results['hfpr']+$results['hfth'])/($results['opr']+$results['oth'])*100;  echo substr($str,0,4).' %'; ?></td>
			</tr>
			<tr>
			<th colspan=2>Totale</th>
			<th colspan=2>Totale</th>
			</tr>
			<tr>
			<td colspan=2><?php echo $results['opr']+$results['oth']; ?></td>
			<td colspan=2><?php echo $results['hfpr']+$results['hfth']; ?></td>
			</tr>
			
			</table>
		</div>  
		<div title="Formateurs" data-options="iconCls:'formateur'" style="padding:10px;">  
			<table id="formateur"border =1>
			<tr>
				<th >Nom & Prénom</th>
				<th >Offre en H St</th>
				<th >Offre en HS</th>
				<th >Offre TOT</th>
				<th >MHA FORM A SSUREE</th>
				<th >Disponible Statut</th>
				<th >TAUX Statut</th>
				<th >TAUX ( Avec HS)</th>
			</tr>
			
			<?php
			$con=connect();
			$result=$con->query("SELECT * FROM `formateur` WHERE formateur.`codeetablissement`='{$_SESSION['codeetablissement']}'");
			while($row=$result->fetch())
			{
			echo "<tr>";
			echo "<td>{$row['nom']}</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
			echo "</tr>";
			}
			?>
			
			
			</table>
		</div>  
	 
	</div> 


		
	<div id='jqxChart' style='width: 500px; height: 400px'></div>
	
		
		
	
	</div>
</section>
<script type="text/javascript">
$('.current2').text('Statistiques'); 




$("#jqxChart").jqxDragDrop();
var theme = getDemoTheme('summer');
//$.messager.alert('My Title','Here is a info message!','info');

var dt;
	 $.post("inc/chart.php", function(data) {
	 dt=data;
	  /* $.each(data, function(){
	   alert(this.somme);
	   });*/
 var theme = getDemoTheme('summer');
            // prepare jqxChart settings
            var settings = {
                title: "capacité des salles",
                description: "pourcentage des salle",
                enableAnimations: true,
                showLegend: true,
                source:dt,
				seriesGroups:
[
    {
        type: 'stackedarea10',
        orientation: 'horizantal'}],
                categoryAxis:
                    {	 
                        text: 'Category Axis',
                        textRotationAngle: 0,
                        dataField: 'nomsalle',
                        showTickMarks: true,
                        tickMarksInterval: 5,
                        tickMarksColor: '#888888',
                        unitInterval: 1,
                        showGridLines: false,
                        gridLinesInterval: 4,
                        gridLinesColor: '#888888',
                        axisSize: 'auto'
                    },
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'stackedcolumn',
                            columnsGapPercent: 100,
                            seriesGapPercent: 5,
                            valueAxis:
                            {
								 formatSettings:
								{
								
									decimalPlaces: 0,
									sufix: ' %'
								},
                                unitInterval: 20,
                                minValue: 0,
                                maxValue: 100,
                                displayValueAxis: true,
                                description: 'pourcentage %',
                                axisSize: 'auto',
                                tickMarksColor: '#888888',
                                gridLinesColor: '#777777'
                            },
                            series: [
                                    { dataField: 'somme', displayText: 'salles' }
                                ]
                        }
                    ]
            };

            // setup the chart
            $('#jqxChart').jqxChart(settings);
	   
 },"json");

$('document').ready(function()
{		
		//formateur
		$('#formateurs').click(function (){
		$('#dlg').dialog('close');
			//$("#main").fadeOut(2000);
			$.post("formateur.php",function(result){
			$("#main").empty();
			$('title').text('Gestion des formateurs');
			$("#main").html(result);
			$('.current2').text('Gestion des Formateurs');
			});
			//$("#main").fadeIn(2000);
		});

		//salle
		$('#salles').click(function (){
		$('#dlg').dialog('close');
			//$("#main").fadeOut(2000);
			$.post("salle.php",function(result){
			$("#main").empty();
			$('title').text('Gestion des Salles');
			$('.current2').text('Gestion des Sales');
			$("#main").html(result);
			});
			
			//$("#main").fadeIn(2000);
		});
});
</script>	
</body>
</html>
<?php }?>
