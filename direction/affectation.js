$('document').ready(function(){

/**********************************  remplissage des selects *******************************************/		
			
			//charger filiere 
		function charger_filiere()
		{
            
            var source =
            {
                datatype: "json",
                url: 'inc/filiere_select.php',
				cache: false
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
			// creation du select filiere
			$("#filiere").jqxDropDownList(
            {	//autoOpen: true,
                source: dataAdapter,
                theme: 'summer',
				width: 250,
				//animationType: 'fade',
				openDelay: 1000,
				closeDelay: 1000,
				//itemHeight: 25,
				//autoDropDownHeight: true,
				//dropDownWidth:250,
				dropDownHeight: 250,
				height: 25,
				selectedIndex: 0,
				displayMember: 'label',
				valueMember: 'value'
            });  
 			
        };//fin de charger filiere
			charger_filiere()//executer charger_filiere() pour charger la selcte onload
			//render groupe;
			$("#groupe").jqxDropDownList(
            {
				source:[{ value: 0, label:'-----Selectionner-----'}],
                 theme: 'summer',
				width: 250,
				height: 25,
				selectedIndex: 0,
				displayMember: 'label',
				valueMember: 'value'
            });
			//render module;
			$("#module").jqxDropDownList(
            {
				source:[{ value: 0, label:'-----Selectionner-----'}],
                theme: 'classic',
				width: 250,
				dropDownHeight: 300,
				height: 25,
				selectedIndex: 0,
				displayMember: 'label',
				valueMember: 'value'
            });
			//render salle_pr;
			$("#salle_pr").jqxDropDownList(
            {
				source:[{ value: 0, label:'-----Selectionner-----'}],
                theme: 'classic',
				width: 170,
				dropDownHeight: 100,
				height: 25,
				selectedIndex: 0,
				displayMember: 'label',
				valueMember: 'value'
            });
			//render salle_th;
			$("#salle_th").jqxDropDownList(
            {
				source:[{ value: 0, label:'-----Selectionner-----'}],
                theme: 'classic',
				width: 170,
				dropDownHeight: 100,
				height: 25,
				selectedIndex: 0,
				displayMember: 'label',
				valueMember: 'value'
            });
				//render formateur;
			$("#formateur").jqxDropDownList(
            {
				source:[{ value: 0, label:'-----Selectionner-----'}],
                theme: 'classic',
				width: 250,
				height: 25,
				selectedIndex: 0,
				displayMember: 'label',
				valueMember: 'value'
            });
/***********************   les select on change  ******************************/
			//filiere on change
			var codefilire=0;
			$("#filiere").change(function(){
			codefilire=$("#filiere").val();
			if(codefilire!=0)
				{
					$('.filiereloader').show();
					$.post("inc/groupe_select.php",{filiere:codefilire},function(result){
					$("#groupe").jqxDropDownList({source:result});
					$('.filiereloader').hide();
					},"json");
				}
			
			});
			//groupe on change
			var codegroupe=0;
			$("#groupe").on('change', function (event) {
			
                codegroupe=event.args.item.value;
				if(codegroupe!=0)
				{liste_formateur();
					$('.groupeloader').show();
					$.post("inc/module_select.php",{filiere:$("#filiere").val(),code:codegroupe},function(result){

						var source1 = {
						datatype: 'json',
						id: 'code',
						localdata: result.data,
						datafields: [{ name: 'code'},{ name: 'formateur'},{ name: 'filiere'},
									{ name: 'module'},{ name: 'salle'},{ name: 'groupe'}],
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
							
						$('[name=dropdownlisteditorjqxgridfiliere]').val(false);
						$('[name=dropdownlisteditorjqxgridgroupe]').val(false);					
						$('[name=dropdownlisteditorjqxgridmodule]').val(false);
						$('[name=dropdownlisteditorjqxgridformateur]').val(false);
						$('[name=dropdownlisteditorjqxgridsalle]').val(false);
						}
					});	
                }
									
									
									
									
									};
							var dataAdapter = new $.jqx.dataAdapter(source1);
						$("#jqxgrid").jqxGrid({source:dataAdapter});

					 
					$("#module").jqxDropDownList({source:result.module});
					$('.groupeloader').hide();
					},"json");
				}
             });
			 var theme = getDemoTheme();
			 //module on change
			var codemodule=0;
			$("#module").on('change', function (event) {
                codemodule=event.args.item.value;
				if(codemodule!=0)
				{	$("#moduleheurs").show();
					$('.moduleloader').show();
					$.post("inc/salle_select.php",{filiere:$("#filiere").val(),code:codemodule},function(result){
						$("#salle_pr").jqxDropDownList({source:result.salle_pr});
						$("#salle_th").jqxDropDownList({source:result.salle_th});
						$("#module").jqxTooltip({ content:'profile : '+result.module.profil+" pratique :"+result.module.heurepratique+" theorique : "+result.module.heuretheorique ,autoHide: false, position: 'left', theme: theme });
						
						$('.moduleloader').hide();
					},'json');
					
				}
             });

			//salle pratique on change
			var codesalle_pr=0;
			$("#salle_pr").on('change',function(event){
			    codesalle_pr=event.args.item.value;
				
				if(codesalle_pr!=0)
				{		$('.salleload12').show();
						$.post("inc/formateur.php",function(result){
							$("#formateur").jqxDropDownList({source:result});
							$('.salleload12').hide();	
						},"json");
				}
			});
			//salle theorique on change
			var codesalle_th=0;
			$("#salle_th").on('change',function(event){
			    codesalle_th=event.args.item.value;
				if(codesalle_th!=0)
				{		$('.salleload12').show();
						$.post("inc/formateur.php",function(result){
							$("#formateur").jqxDropDownList({source:result});
							$('.salleload12').hide();	
						},"json");
				}
			});
			
			//formateur on change
			var matricule=0;
			$("#formateur").on('change',function(event){
			    matricule=event.args.item.value;
				
				if(matricule!=0)
				{		
						$('#jqxwindow').jqxWindow('open');
						$('.formateurloader').show();
						$.post("inc/info_formateur.php",{mat:matricule},function(result){
						$("#jqxwindow ").jqxWindow({ height:224, width: 310, position:{ x:945 , y: 143 },animationType: 'combined',showCollapseButton: true, theme: 'summer' });
						$('#jqxwindow').jqxWindow('setContent', result);	
						
							$('.formateurloader').hide();
							
						});
				}
			});
	
			$('#affecter').click(function (){
				$('.affecterloader').show();
				if( codefilire==0 ||codegroupe==0||codemodule==0||matricule==0 &&(codesalle_pr==0 ||codesalle_th==0))
				{
					$().toastmessage('showToast', {
					text     : '<br>* CHAMPS OBLIGATOIRE</br></br>',
					sticky   : false,
					position : 'top-right',
					type     :'warning'
					});
				$('.affecterloader').fadeOut(1000);
				}else{
				
				$.post("inc/affectation_terminer.php",{'filiere':codefilire,'groupe':codegroupe,'module':codemodule,'salle_pr':codesalle_pr,'salle_th':codesalle_th,'formateur':matricule},function(result){
				//afficher notification de l'ajout
				if(result.type=="warning")
				{
				$('.affecterloader').fadeOut(1000);
				$().toastmessage('showToast', {text: result.msg,sticky: false,position :'top-right',type: result.type});
				$("#formateur").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
				$("#salle_th").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
				$("#salle_pr").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
				
				}else
				{
				liste_formateur();
				$().toastmessage('showToast', {text: result.msg,sticky: false,position :'top-right',type: result.type});
				$('.affecterloader').fadeOut(1000);
				//remplissage des filieres
				$("#groupe").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
				$("#module").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
				$("#salle_th").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
				$("#salle_pr").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
				$("#formateur").jqxDropDownList( {selectedIndex: 0,source:[{ value: 0, label:'-----Selectionner-----'}]});
			
				$("#filiere").jqxDropDownList({selectedIndex: 0});
				$('#jqxwindow').jqxWindow('close');
				
				}//end if warrnnig
				},'json');
				};//end else
				
				
				
				
			//alert("filier :"+codefilire+"//groupe:"+codegroupe+"//module:"+codemodule+
			//"//salle_pra:"+codesalle_pr+"//salle_th:"+codesalle_th+"//matricule:"+matricule);
			
			
			
			
			
			});//end affectation
		
		   
/************************************************/
		
		//recuperer les donner de la BD
		
		//formateur
		$('#formateurs').click(function (){
		page="formateur";
			//$("#main").fadeOut(3000);
			$.post("formateur.php",function(result){
			$("#main").empty();$('title').text('Gestion des formateurs');
			$("#main").html(result);
			$('.current2').text('Gestion des Formateurs');
			});
			//$("#main").fadeIn(1000);
		});

		//salle
		$('#salles').click(function (){
		page="salle";
			//$("#main").fadeOut(3000);
			$.post("salle.php",function(result){
			$("#main").empty();$('title').text('Gestion des Salles');
			$("#main").html(result);
			$('.current2').text('Gestion des Salles');
			});
			//$("#main").fadeIn(1000);
		});
		
/*********************   afficher notifications   ***********************/
			$('#nbrfrmt').mouseenter(function(){
			$('#modulenonaffecter').hide('slow');
			$('#formateurnonaffecter').show('slow');
			}).mouseleave(function(){
			$('#formateurnonaffecter').hide('slow');
			});
			
			$('#nbrsalle').mouseenter(function(){
			$('#sallenonaffecter').show('slow');
			$('#modulenonaffecter').hide('slow');
			}).mouseleave(function(){
			$('#sallenonaffecter').hide('slow');
			});
			
			$('#nbrmodule').mouseenter(function(){
			$('#modulenonaffecter').show('slow');
			})
			
			$('#modulenonaffecter').mouseleave(function(){
			$(this).hide('slow');
			}).mouseenter(function(){
			$(this).show('slow');
			});
			
			
			function liste_formateur()
			{
				$.post("inc/liste_formateur.php",{code:codegroupe},function(data){
				
				$('#formateurnonaffecter').html(data.liste_formateur);
				$('#sallenonaffecter').html(data.salles);
				$('#modulenonaffecter').html(data.modules);
				
				$('#nbrfrmt').html(data.nbr);
				$('#nbrsalle').html(data.nbrsalle);
				$('#nbrmodule').html(data.nbrmodule);
					
			
			},"json");
			}
		
			liste_formateur();


});

