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
$grid["caption"] = "Lists des etablissements";
$grid["multiselect"] = true;
$g->set_options($grid);
$g->table = "etablissement";
 $g->select_command = "select * from (select * from etablissement ) as o";
$out = $g->render("list1");
?>
<h4 class="title_info">Etablissements</h4>
		<div id="content">
		<div class="spacer"></div>
			<div class="datarid">
			<?php
				echo $out
				?>
			</div>
		</div><!-- centent -->
		<div class="spacer"></div>
	
<?php }?>