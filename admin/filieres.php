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
$g = new jqgrid();
$grid["caption"] = "Lists des Filieres";
$grid["multiselect"] = true;
$g->set_options($grid);
$g->table = "filiere";
 $g->select_command = "select * from (select * from filiere ) as o";
$out = $g->render("list1");
?>
	<h4 class="title_info">Filieres</h4>
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