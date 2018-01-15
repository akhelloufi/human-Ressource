<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='admin' or $_SESSION['role']=='directeurregionale')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{
connect2();
mysql_query("SET NAMES 'utf8'");
include("inc/jqgrid_dist.php");


$col = array();// matricule
$col["title"] = "matricule"; 
$col["editable"] = true;
$col["align"] = "center";
$col["name"] = "matricule"; 
$col["editoptions"] = array("style"=>"color:#003DFF;background-color:#E7E7F7;;font-size: 15px;font-weight: bold;"); // with these attributes

$col["width"] = "15";
$cols[] = $col;		

$col = array();//nom
$col["title"] = "nom";
$col["name"] = "nom"; 
$col["width"] = "30";
$col["editoptions"] = array("style"=>"color:#003DFF;background-color:#E7E7F7;;font-size: 15px;font-weight: bold;"); // with these attributes

$col["editable"] = true ;// this column is editable
$col["editrules"] = array("required"=>true, "edithidden"=>false); // and is required
$col["align"] = "center";					
$cols[] = $col;
	
$col = array();
$col["title"] = "profilformateur";
$col["name"] = "profilformateur";
$col["editoptions"] = array("style"=>"color:#003DFF;background-color:#E7E7F7;;font-size: 15px;font-weight: bold;"); // with these attributes

$col["width"] = "25";
$col["editable"] = true; // this column is not editable
$col["align"] = "center";
$col["search"] = true; // this column is not searchable
$cols[] = $col;

$col = array();
$col["title"] = "statut";
$col["name"] = "statut";
$col["editoptions"] = array("style"=>"color:#003DFF;background-color:#E7E7F7;;font-size: 15px;font-weight: bold;"); // with these attributes
$col["align"] = "center";
$col["width"] = "25"; // not specifying width will expand to fill space
$col["sortable"] = true; // this column is not sortable
$col["search"] = true; // this column is not searchable
$col["editable"] = true;
$col["edittype"] = "text"; // render as textarea on edit
//$col["editoptions"] = array("rows"=>2, "cols"=>20); // with these attributes
$cols[] = $col;

$col = array();
$col["title"] = "Bilan_competence";
$col["name"] = "Bilan_competence";
$col["align"] = "center";
$col["width"] = "25"; // not specifying width will expand to fill space
$col["sortable"] = true; // this column is not sortable
$col["search"] = true; // this column is not searchable
$col["editable"] = true;
$col["edittype"] = "text"; // render as textarea on edit
$col["editoptions"] = array("style"=>"color:#003DFF;background-color:#E7E7F7;;font-size: 15px;font-weight: bold;"); // with these attributes
$cols[] = $col;


$col = array();
$col["title"] = "Etablissement";
$col["name"] = "nomet";
$col["width"] = "30";
$col["editable"] = true;
$col["align"] = "center";
$col["edittype"] = "select"; 
$et=getFKey();
$col["editoptions"] = array("value"=>$et);
$cols[] = $col;

$g = new jqgrid();

$grid["rowNum"] = 10; // by default 20
//$grid["sortname"] = 'matricule'; // by default sort grid by this field
$grid["sortorder"] = "desc"; // ASC or DESC
$grid["caption"] = "formateurs"; // caption of grid
$grid["autowidth"] = true; // expand grid to screen width
$grid["multiselect"] = true; // allow you to multi-select through checkboxes

$g->set_options($grid);

$g->set_actions(array(	
						"add"=>false, // allow/disallow add
						"edit"=>false, // allow/disallow edit
						"delete"=>false, // allow/disallow delete
						"rowactions"=>false, // show/hide row wise edit/del/save option
						"search" => "advance" 
					) 
				);

// you can provide custom SQL query to display data
 $g->select_command = "select * from (SELECT formateur.`matricule`,formateur.`nom` ,formateur.`profilformateur`,formateur.`statut` ,formateur.`Bilan_competence`
 ,etablissement.etablissementab as nomet
 FROM formateur, etablissement
 WHERE  formateur.codeetablissement=etablissement.codeetablissement
AND formateur.codeetablissement like'".$_SESSION['codeetablissement']."%' ) as o";

// this db table will be used for add,edit,delete
$g->table = "formateur";

// pass the cooked columns to grid
$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");?>
	<link id="theme" rel="stylesheet" type="text/css" ;" media="screen" href="js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

		<h4 class="title_info">Formateurs</h4>	
		<div id="content">
		<div class="spacer"></div>

			<div class="datarid">
	
				<?php
				echo $out;
				?>
			</div>
		
		</div><!-- centent -->
		<div class="spacer"></div>
	
<?php }?>