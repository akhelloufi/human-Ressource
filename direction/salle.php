<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='admin' or $_SESSION['role']=='directeurregionale')
{  echo "<script>window.location.assign('../index.php');</script>";

}else
{
connect2();
mysql_query("SET NAMES 'utf8'");
include("inc/jqgrid_dist.php");


$col = array();//codesalle
$col["align"] = "center";
$col["title"] = "codesalle";
$col["search"] = true; 
$col["editable"] = true;
$col["name"] = "codesalle"; 
$col["width"] = "6";
$cols[] = $col;		

$col = array();//nom
$col["title"] = "nom";
$col["name"] = "nom"; 
$col["width"] = "5";
$col["search"] = true;
$col["align"] = "center";
$col["editable"] = true ;// this column is editable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20						
$cols[] = $col;


$col = array();
$col["title"] = "codefiliere";
$col["name"] = "codefiliere";
$col["width"] = "5"; // not specifying width will expand to fill space
$col["sortable"] = true; // this column is not sortable
$col["search"] = true; // this column is not searchable
$col["editable"] = true;
$col["align"] = "center";
$col["edittype"] = "text"; // render as textarea on edit
//$col["editoptions"] = array("rows"=>2, "cols"=>20); // with these attributes
$cols[] = $col;


$col = array();
$col["search"] = true;
$col["title"] = "Etablissement";
$col["name"] = "nomet";
$col["width"] = "5";
$col["align"] = "center";
$col["editable"] = false;
$col["edittype"] = "select"; 
$et=getFKey();
$col["editoptions"] = array("value"=>$et);
$cols[] = $col;

$g = new jqgrid();

$grid["rowNum"] = 10; // by default 20
//$grid["sortname"] = 'matricule'; // by default sort grid by this field
$grid["sortorder"] = "desc"; // ASC or DESC
$grid["caption"] = "salles"; // caption of grid
$grid["autowidth"] = true; // expand grid to screen width
$grid["multiselect"] = true; // allow you to multi-select through checkboxes
$g->set_options($grid);
$g->options["width"] = 700;
$g->options["height"] = 235;
$g->actions["inlineadd"] = true;
$g->set_actions(array(	
						"add"=>false, // allow/disallow add
						"edit"=>false, // allow/disallow edit
						"delete"=>false, // allow/disallow delete
						"rowactions"=>false, // show/hide row wise edit/del/save option
						"search" => "advance" 
					) 
				);

// you can provide custom SQL query to display data
 $g->select_command = "select * from (SELECT codesalle,salle.`nom`,salle.`type`,salle.`codefiliere`
 ,etablissement.etablissementab as nomet
 FROM salle, etablissement
 WHERE  salle.`codeetablissement`=etablissement.codeetablissement
AND salle.codeetablissement like'".$_SESSION['codeetablissement']."%' ) as o";
// this db table will be used for add,edit,delete
$g->table = "salle";

// pass the cooked columns to grid
$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");
?>
	<link id="theme" rel="stylesheet" type="text/css" ;" media="screen" href="js/themes/redmond/jquery-ui.custom.css"></link>	
	<link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>	
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

		<h4 class="title_info">Salles</h4>	
		<div id="content">
		 <div class="spacer"></div>

			<div class="datarid">
			
				
				<?php
				echo $out;
				?>
			
			
			</div>
		
		</div><!-- centent -->
		<!-- end of styles article -->
		<div class="spacer"></div>

<?php }?>
