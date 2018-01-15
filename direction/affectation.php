<?php
include('../functions/login.php');
if(session()==false || $_SESSION['role']=='admin' or $_SESSION['role']=='directeurregionale')
{
  echo "<script>window.location.assign('../index.php');</script>";
}else
{
require_once 'header.php';
?>
<title>Affectation</title>
	<link rel="shortcut icon" href="../images/ofppt.ico"/>	
	<script src="js/jquery.js"></script>
	 <link type="text/css" href="../css/jquery.toastmessage-min.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery.toastmessage-min.js"></script>
	
	<script type="text/javascript" src="js/gettheme.js"></script>
    <script type="text/javascript" src="js/jqxcore.js"></script>
    <script type="text/javascript" src="js/jqxdata.js"></script>
    <script type="text/javascript" src="js/jqxchart.js"></script>
	
	    <script type="text/javascript" src="js/jqxbuttons.js"></script>
	<script type="text/javascript" src="js/jqxdropdownlist.js"></script>	
	    <script type="text/javascript" src="js/jqxscrollbar.js"></script>
	<script type="text/javascript" src="js/jqxlistbox.js"></script> 
	<script type="text/javascript" src="js/jqxdragdrop.js"></script>

	 <link rel="stylesheet" type="text/css" href="../css/jqx.summer.css" />
	<script type="text/javascript" src="js/jqxwindow.js"></script>
    <script type="text/javascript" src="js/jqxtooltip.js"></script>
	 <link rel="stylesheet" type="text/css" href="../css/jqx.base.css" />
	<link rel="stylesheet" type="text/css" href="../css/icon.css">

	
	<script type="text/javascript" src="js/jqxmenu.js"></script>
    <link rel="stylesheet" href="../css/jqx.classic.css" type="text/css" />
    <script type="text/javascript" src="js/jqxcheckbox.js"></script>
    <script type="text/javascript" src="js/jqxgrid.js"></script>
    <script type="text/javascript" src="js/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="js/jqxgrid.edit.js"></script>
    <script type="text/javascript" src="js/jqxgrid.sort.js"></script>
	<script type="text/javascript" src="js/jqxgrid.filter.js"></script>

	
	
<?php
require_once 'barre3.php';
require_once 'menu2.php';
?>

<link rel="stylesheet" type="text/css" href="../css/aff.css">


	<section id="main" class="column">
		<div id="content">
	<table class="affectation">
	<tr>
		<th> Filiere <span class="etoile">*</span></th>	
		<td class="flr" >
			<ul class="ul">
			<li class="left"><div id="filiere" ></div></li>
			<li class="right"><img  class="filiereloader" src="../images/loading2.gif" /></li>
			</ul>
		</td>
	</tr>
	<tr>
		<th> Groupe <span class="etoile">*</span></th>	
		<td>
			<ul class="ul">
			<li class="left"><div id="groupe" ></div></li>
			<li class="right"><img  class="groupeloader" src="../images/loading2.gif" /></li>
			</ul>
		</td>
	
	</tr>
	<tr>
		<th> Module <span class="etoile">*</span></th>
		<td>
			<ul class="ul">
			<li class="left"><div id="module" ></div></li>
			<li class="right"><img  class="moduleloader" src="../images/loading2.gif" /></li>
			</ul>
		</td>
		
		
	</tr>
	<tr>
		<th> Salle <span class="etoile">*</span></th>
		<td>
		<ul style="width: 100%;height: 30px;">
			<li class="sallepratique"><div id="salle_pr" ></div>
			</li>
			<li	class="salletheorique"><div id="salle_th" ></div>
			</li>
			<li class="salleloader"><img  class="salleload12" style="width: 28px;display: none;" src="../images/loading2.gif" />
			</li>
		</ul>

		</td>
	</tr>
	<tr>
		<th> Formateur <span class="etoile">*</span></th>
		<td>
			<ul class="ul">
			<li class="left"><div id="formateur" ></div></li>
			<li class="right"><img  class="formateurloader" src="../images/loading2.gif" /></li>
			</ul>
		</td>
		
	</tr>
	<tr>
	<th> Action </th>
		<td>
					<a href="#" class="easyui-linkbutton" id="affecter">&nbsp;&nbsp;&nbsp;Affecter&nbsp;&nbsp;&nbsp;</a>	
		<div class="afectarerloader">
			<img  class="affecterloader" src="../images/loading2.gif" />
		</div>
		</td>

	</tr>
	
	</table >
	<br>
			
		<div id="grid">
			<div id="jqxgrid"></div>
			
		</div>
		</div><!-- centent -->
		<!-- end of styles article --><div class="infff"></div>
		<div class="spacer"></div>
	 </section>
	 <!-- notifications -->
	 <div id="nbrfrmt"></div>
	 <div id="nbrmodule"></div>
	 <div id="nbrsalle"></div>
	 <div id="formateurnonaffecter"></div>
	 <div id="sallenonaffecter"></div>
	 <div id="modulenonaffecter"></div>
		<div id='jqxwindow' >
			<div>Info formateurs</div>
			<div>Content</div>
		</div>
	<div id="formateurnonaffecter"></div>
<script >
        $(document).ready(function () {
            // prepare the data
            
			var theme = 'classic';

            var source =
            {
                 datatype: "json",
				 datafields: [
					 { name: 'code'},
					 { name: 'formateur'},
					 { name: 'filiere'},
					 { name: 'module'},
					 { name: 'salle'},
					 { name: 'groupe'}
                ],
				cache: false,
				id: 'code',
                url: 'inc/data.php',           
                updaterow: function (rowid, rowdata, commit) {
			       
				   // recuperer les  valeur modifier dans datagrid par les input type="hidden"
          
					data_update={
						codeaffectation:rowid,
						codefiliere:$('[name=dropdownlisteditorjqxgridfiliere]').val(),
						codegroupe:$('[name=dropdownlisteditorjqxgridgroupe]').val(),						
						codemodule:$('[name=dropdownlisteditorjqxgridmodule]').val(),
						matricule:$('[name=dropdownlisteditorjqxgridformateur]').val(),
						codesalle:$('[name=dropdownlisteditorjqxgridsalle]').val()};
					var str="update=true";
					//trier la table si la valeur="undefined" sera supprimer
					for(x in data_update)
					{
					if(typeof(data_update[x])!='undefined' && data_update[x]!='false')
						{str+="&"+x+"="+data_update[x];}
					}
					
					$.ajax({
						dataType: 'json',
						url: 'inc/liste_crud.php',
						data:str,
						success: function (data, status, xhr) {
						// update command is executed.
							commit(true);
							$.messager.show({title: 'Effectuer',msg: data.sql});
							$('#jqxGrid').jqxGrid('refresh');
						$('[name=dropdownlisteditorjqxgridfiliere]').val(false);
						$('[name=dropdownlisteditorjqxgridgroupe]').val(false);					
						$('[name=dropdownlisteditorjqxgridmodule]').val(false);
						$('[name=dropdownlisteditorjqxgridformateur]').val(false);
						$('[name=dropdownlisteditorjqxgridsalle]').val(false);
						}
					});	
                }
            };
			
			
			// initialize jqxGrid
			var dataAdapter = new $.jqx.dataAdapter(source);
			var liste_formateur;
			var liste_salle;
			var liste_groupe;
			$.post('inc/liste_crud.php',function(data){
			liste_filiere=data.filiere;
			liste_formateur=data.formateur;
			liste_salle=data.salle;
			liste_groupe=data.groupe;
			},'json');
            $("#jqxgrid").jqxGrid(
            {	
                width: 800,
                height: 350,
				selectionmode: 'singlecell',
                source: dataAdapter,
                theme: theme,
				showfilterrow: true,
                filterable: true,
				enablehover: true,
				autoshowcolumnsmenubutton: true,
				editable: true,
				//sortable: true,
                columns: [
        { text: 'code',hidden:true,datafield: 'code', width: 50},
		
		{ text: 'filiere',columntype: 'dropdownlist',align:'center', datafield: 'filiere', width: 250 ,
	    createeditor: function (row, cellvalue, editor){editor.jqxDropDownList(
		{source:liste_filiere,displayMember:'label',valueMember:'value',width: 250 })}
		},
		
		{ text: 'groupe',columntype: 'dropdownlist', datafield: 'groupe',align:'center',resizable:true , width: 150 ,
	    createeditor: function (row, cellvalue, editor){editor.jqxDropDownList(
		{source:liste_groupe,displayMember:'label',valueMember:'value' })}
		},
		
		{ text: 'module', datafield: 'module', width: 150,editable:false ,align:'center'},
		
		{ text: 'formateur',columntype: 'dropdownlist', datafield: 'formateur',align:'center', width: 150 ,
	    createeditor: function (row, cellvalue, editor){editor.jqxDropDownList(
		{source:liste_formateur,displayMember:'label',valueMember:'value' })}
		},
		
		{ text: 'salle',columntype: 'dropdownlist',align:'center', datafield: 'salle', width: 100 ,
	    createeditor: function (row, cellvalue, editor){editor.jqxDropDownList(
		{source:liste_salle,displayMember:'label',valueMember:'value' })}
		}
                  ]
            });
        });
  
</script>
<script src="affectation.js"></script>
<script type="text/javascript">
$('.current2').text('AFFECTATIONS');
var slide=true;
var page="affectation";

$('document').ready(function(){
	var theme = getDemoTheme();
	$(".flr").jqxTooltip({ content: 'Selectionner Filière', position: 'left', theme: theme});
	$("#groupe").jqxTooltip({ content: 'Selectionner Groupe', position: 'left', theme: theme });
	$("#salle_pr").jqxTooltip({ content: 'Selectionner Salle Pratique', position: 'left', theme: theme });
	$("#salle_th").jqxTooltip({ content: 'Selectionner Salle Thèorique', position: 'right', theme: theme });
	$("#formateur").jqxTooltip({ content: 'Selectionner  Formateur', position: 'left', theme: theme });
// hide show menu	
$('#menuslide').click(function(){
	
if(page=='affectation')
{
	if(slide==true)
	{
		$('#sidebar').animate({left: '-222px'},1000)
		$('#menuslide').css('background-position','-33px');
	
		slide=false;
	}else
	{		$('#sidebar').animate({left: '0px'},1000)
			$('#menuslide').css('background-position','-6px');	

		slide=true;
	}
}else
		{

	if(slide==true)
	{
		$('#sidebar').animate({left: '-222px'},1000,function(){
		$('#menuslide').css('background-position','-33px');
		$('#main').css('position','absolute');
		$('#main').animate({width: '100%',left: '-290px'},1000)

		});

		slide=false;
	}else
		{	
			
			$('#main').animate({width: '77%',left: '0px'},1000,function(){
			$('#main').css('position','');
			$('#sidebar').animate({left: '0px'},1000);
			$('#menuslide').css('background-position','-6px');
			})
			
			
		slide=true;
	}
		
		}

	});//menu slide click
});
</script>
</script>
</body>
</html>
<?php }?>