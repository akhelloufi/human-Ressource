<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='directeur' or $_SESSION['role']=='directeurregionale')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{
connect2();
mysql_query("SET NAMES 'utf8'");
include("inc/jqgrid_dist.php");


$col = array();//codesalle
$col["title"] = "codesalle"; 
$col["editable"] = true;
$col["name"] = "codesalle"; 
$col["width"] = "15";
$cols[] = $col;		

$col = array();//nom
$col["title"] = "nom";
$col["name"] = "nom"; 
$col["width"] = "30";
$col["editable"] = true ;// this column is editable
$col["editoptions"] = array("size"=>30); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>false); // and is required
$col["hidden"] = false;						
$cols[] = $col;

$col = array();
$col["title"] = "type";
$col["name"] = "type";
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
$grid["caption"] = "salles"; // caption of grid
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
$g->select_command = "SELECT * FROM (SELECT * FROM salle) o";

// this db table will be used for add,edit,delete
$g->table = "salle";

// pass the cooked columns to grid
$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");
?>
	<h4 class="title_info">Salles</h4>	
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
