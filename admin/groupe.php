<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']!='admin')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{
connect2();
mysql_query("SET NAMES 'utf8'");
include("inc/jqgrid_dist.php");


$col = array();// codegroupe
$col["title"] = "codegroupe"; 
$col["name"] = "codegroupe";
$col["editable"] = true ;
$col["width"] = "15";
$cols[] = $col;		

$col = array();//nomgroupe
$col["title"] = "nomgroupe";
$col["name"] = "nomgroupe"; 
$col["width"] = "65";
$col["editable"] = true ;// this column is editable
$col["editoptions"] = array("size"=>65); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>false); // and is required
$col["hidden"] = false;						
$cols[] = $col;
	
$col = array();//NIVEAU
$col["title"] = "NIVEAU";
$col["name"] = "NIVEAU";
$col["width"] = "10";
$col["editable"] = true ; // this column is not editable
//$col["align"] = "center"; // 
$col["search"] = true; // this column is not searchable
$cols[] = $col;
# $col["formatter"] = "image"; // format as image -- if data is image url e.g. http://<domain>/test.jpg
# $col["formatoptions"] = array("width"=>'20',"height"=>'30'); // image width / height etc

$col = array();//codefiliere
$col["title"] = "codefiliere"; 
$col["editable"] = true ;
$col["name"] = "codefiliere"; 
$col["width"] = "15";
$cols[] = $col;		

$col = array();
$col["title"] = "Etablissement";
$col["name"] = "codeetablissment";
$col["width"] = "34";
$col["editable"] = true ;
$col["edittype"] = "select"; 
$et=getFKey();
$col["editoptions"] = array("value"=>$et);
$cols[] = $col;

$g = new jqgrid();

$grid["rowNum"] = 10; // by default 20
$grid["sortorder"] = "desc"; // ASC or DESC
$grid["caption"] = "groupes"; // caption of grid
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
//$g->select_command = "SELECT * FROM (SELECT * FROM groupe ) o";//SELECT CONCAT("Num","-","Tipo") AS mykey,

$g->select_command = "SELECT `codegroupe`, `nomgroupe`, `NIVEAU`, `codefiliere`, `codeetablissment` FROM (SELECT * FROM groupe ) o";


//$g->setPrimaryKeyId("codegroupe");


// this db table will be used for add,edit,delete
$g->table = "groupe";

// pass the cooked columns to grid
$g->set_columns($cols);
$g->actions["export"] = true;
// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");
?>
		<h4 class="title_info">goupes</h4>	
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
