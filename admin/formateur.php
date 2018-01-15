<?php
include('../functions/login.php');
connect2();
mysql_query("SET NAMES 'utf8'");
include("inc/jqgrid_dist.php");


$col = array();// matricule
$col["title"] = "matricule"; 
$col["editable"] = true;
$col["name"] = "matricule"; 
$col["width"] = "15";
$cols[] = $col;		

$col = array();//nom
$col["title"] = "nom";
$col["name"] = "nom"; 
$col["width"] = "30";
$col["editable"] = true ;// this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>false); // and is required
$col["hidden"] = false;						
$cols[] = $col;

$col = array();
$col["title"] = "profilformateur";
$col["name"] = "profilformateur";
$col["width"] = "25";
$col["editable"] = true; // this column is not editable
//$col["align"] = "center"; // 
$col["search"] = true; // this column is not searchable
$cols[] = $col;

$col = array();
$col["title"] = "statut";
$col["name"] = "statut";
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
$col["width"] = "25"; // not specifying width will expand to fill space
$col["sortable"] = true; // this column is not sortable
$col["search"] = true; // this column is not searchable
$col["editable"] = true;
$col["edittype"] = "text"; // render as textarea on edit
//$col["editoptions"] = array("rows"=>2, "cols"=>20); // with these attributes
$cols[] = $col;


$col = array();
$col["title"] = "Etablissement";
$col["name"] = "codeetablissement";
$col["width"] = "30";
$col["editable"] = true;
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
						"add"=>true, // allow/disallow add
						"edit"=>true, // allow/disallow edit
						"delete"=>true, // allow/disallow delete
						"rowactions"=>true, // show/hide row wise edit/del/save option
						"search" => "advance" 
					) 
				);

// you can provide custom SQL query to display data
$g->select_command = "SELECT * FROM (SELECT * FROM formateur ) o";

// this db table will be used for add,edit,delete
$g->table = "formateur";

//autre parametre
$g->actions["inlineadd"] = true;
 //$g->actions["export"] = true;
//$g->options["cellEdit"] = false;
//$g->options["width"] = 900;
//$g->options["rowList"] = array(5,10,15,20,30);
//$g->options["height"] = 235;



// pass the cooked columns to grid
$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");
?>

		<h4 class="title_info">Formateurs</h4>	
		<div id="content">
		 <div class="spacer"></div>
				<div class="datarid">
					<?php echo $out; ?>
				</div>
		</div><!-- centent -->
		<div class="spacer"></div
		