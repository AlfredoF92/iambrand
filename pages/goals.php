<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin 2 - Bootstrap Admin Theme</title>

	<?php include_once("headerlink.php"); ?>
	<?php include_once("include_core.php"); ?>
	
</head>

<?php

	session_start();
	$idUser = "";
	if ( isset( $_SESSION[ 'id' ] ) ) {
		$myLife_manager = new MyLifeManager();
		$user = $myLife_manager->getUserByID( $_SESSION[ 'id' ] );
		$nomeUtente = $user->username;
		$idUser = $_SESSION[ 'id' ];

	} else {
		header( "location: http://localhost/iambrand/iambrand/pages/login.php" );
		// redirect verso pagina interna
	}

	$manager = new MyLifeManager();
?>
<body>

	<div id="wrapper">

		<?php include_once("nav.php"); ?>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Crea obiettivo</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->


			<div class="row">
				<div class="col-lg-8">

					
							
							<div class="panel-body">

								<!--
									MODAL TO MODIFY	
								-->
								<div id="bodyModalGoalToModify">
									<form>
										<div class="form-group">
											<label for="usr">Titolo</label>
											<input type="text" class="form-control" id="gm_title" value="">
										</div>
										<div class="form-group">
											<label for="comment">Descrizione</label>
											<textarea class="form-control" rows="1" id="gm_description"></textarea>
										</div>
									</form>

									<!--
										MANAGER LABEL
									-->
									<?php

										$array_labels = $myLife_manager->getLabels($idUser);
										$max_labels = sizeof( $array_labels );

									?>

									<div class="form-group">
										<label for="sel1"><span id="spanLabel">Etichetta</span> 
													
							<button id="buttonNewLabel" class="btn btn-info btn-xs">Crea nuova</button>
							<button id="buttonEditLabel" class="btn btn-warning btn-xs">Modifica</button>
							</label>

										<div id="divEditLabel" style="display: none" class="well well-sm">

											<div class="row">

												<div class="col-lg-8">

													<input type="text" class="form-control" placeholder="Nome nuova etichetta" value="" id="gm_NameEditLabel">
												</div>
												<div class="col-lg-4">
													<select class="form-control" id="gm_newEditColor">
														<?php 
													$colors = $myLife_manager->getColors();
													for($k=0; $k<sizeof($colors); $k++){

														 echo '<option value="'. $colors[$k] . '">' . 					$colors[$k] . '</option>';
													}
												?>

													</select>
												</div>

											</div>
											<div class="row">
												<div class="col-lg-12" style="padding-top: 5px; ">
													<button id="cancelEditLabel" class="btn btn-info btn-xs">Annulla</button>
												</div>
											</div>
										</div>

										<div id="divNewLabel" style="display: none" class="well well-sm">

											<div class="row">
												<div class="col-lg-8">

													<input type="text" class="form-control" placeholder="Nome nuova etichetta" id="gm_newLabel">
												</div>
												<div class="col-lg-4">
													<select class="form-control" id="gm_newLabelColor">
														<?php 
													$colors = $myLife_manager->getColors();
													for($k=0; $k<sizeof($colors); $k++){
														
														  echo '<option value="'. $colors[$k] . '">' . 					$colors[$k] . '</option>';
													}
												?>
													</select>
												</div>

											</div>
											<div class="row">
												<div class="col-lg-12" style="padding-top: 5px; ">
													<button id="cancelNewLabel" class="btn btn-info btn-xs">Annulla</button>
												</div>
											</div>
										</div>
										<div class="row" id="oldLabel">
											<div class="col-lg-8">
												<select class="form-control" id="gm_idlabel">
													<?php 
											for($j=0; $j<$max_labels; $j++){
												
												
													$idLabel = $array_labels[$j]->id; 
													$color = $array_labels[$j]->color; 
													echo '<option value="'. $idLabel . "_" . $color .'">' . $array_labels[$j]->name . '</option>';
												
											}
										?>
												</select>

											</div>
											<div class="col-lg-4">
												<!-- EDIT COLOR
												<select class="form-control" id="gm_idlabelColor">
													<?php 
														/*
														$colors = $myLife_manager->getColors();
														for($k=0; $k<sizeof($colors); $k++){
															if($colors[$k] == $goal->color){
																echo '<option selected value="'. $colors[$k] . '">' . $colors[$k] . '</option>';
															}else echo '<option value="'. $colors[$k] . '">' . $colors[$k] . '</option>';
														}*/
													?>
												</select>
												-->
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="sel1">Data inizio</label>
										<input type="text" class="form-control" id="gm_dateBegin" placeholder="aaaa-mm-gg hh:mm" value="">

										<label for="sel1">Data fine</label>
										<input type="text" class="form-control" id="gm_dateFinal" placeholder="aaaa-mm-gg hh:mm" value="">
									</div>

									<div class="form-group">
										<div style="padding: 20px" class="text-center">
											<div class="row">
												<div class="col-lg-3">
													<span id="label_slider_Y">Yourself</span>
												</div>
												<div class="col-lg-9">
													<div class="slidecontainer">
														<input type="range" min="-10" max="10" value="0" class="slider" id="gm_lifeYourself">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-3">
													<span id="label_slider_C">Career</span>
												</div>
												<div class="col-lg-9">
													<div class="slidecontainer">
														<input type="range" min="-10" max="10" value="0" class="slider" id="gm_lifeCareer">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-3">
													<span id="label_slider_R">Relationship</span>
												</div>
												<div class="col-lg-9">
													<div class="slidecontainer">
														<input type="range" min="-10" max="10" value="0" class="slider" id="gm_lifeRelationships">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-3">
													<span id="label_slider_R">Percentage</span>
												</div>
												<div class="col-lg-9">
													<div class="slidecontainer">
														<input type="range" min="-10" max="10" value="0" class="slider" id="gm_percentage">
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>

							</div>
							<!-- BODY -->
							
							<div class="panel-footer text-right" >
								<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
								<button id="newGoal" class="btn btn-success" style="padding-left: 60px; padding-right: 60px">Crea</button>
							</div>
							<div id="answerHtml2">Risposta</div>
				</div>
				<!-- /.col-lg-12 -->
			</div>


		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->
	
		
<script>
	
	/*
		0 = label Goal
		1 = label New
		2 = label Edit
	*/
	var labelOperation = 0; 
	
	$("#buttonEditLabel").click(function(){
		$("#spanLabel").text("Modifica Etichetta"); 
		$( "#divEditLabel" ).show();
		$( "#oldLabel" ).hide();
		$( "#buttonNewLabel" ).hide();
		$( "#buttonEditLabel" ).hide();
		labelOperation = 2;
	});
	
	$("#cancelEditLabel").click(function(){
		$("#spanLabel").text("Etichetta"); 
		$( "#buttonNewLabel" ).show();
		$( "#buttonEditLabel" ).show();
		$( "#divEditLabel" ).hide();
		$( "#oldLabel" ).show();
		labelOperation = 0;
	});
	
	$( "#buttonNewLabel" ).click( function () {
		$("#spanLabel").text("Nuova Etichetta"); 
		$( "#divNewLabel" ).show();
		$( "#oldLabel" ).hide();
		$( "#buttonNewLabel" ).hide();
		$( "#buttonEditLabel" ).hide();
		labelOperation = 1;
	} );

	$( "#cancelNewLabel" ).click( function () {
		$("#spanLabel").text("Etichetta"); 
		$( "#buttonNewLabel" ).show();
		$( "#oldLabel" ).show();
		$( "#divNewLabel" ).hide();
		$( "#buttonEditLabel" ).show();
		labelOperation = 0;
	} );
	
	$( "#newGoal" ).click( function () {
			
			var datiForm = new FormData();
			
			datiForm.append( 'title', $("#gm_title").val() );
			datiForm.append( 'description', $("#gm_description").val() );
			
			datiForm.append( 'dateBegin', $("#gm_dateBegin").val() );
			datiForm.append( 'dateFinal', $("#gm_dateFinal").val() );
			
			datiForm.append( 'lifeYourself', $("#gm_lifeYourself").val() );
			datiForm.append( 'lifeCareer', $("#gm_lifeCareer").val() );
			datiForm.append( 'lifeRelationships', $("#gm_lifeRelationships").val() );
			datiForm.append( 'percentage', $("#gm_percentage").val() );
			
			//ETICHETTA
			datiForm.append( 'labelOperation', labelOperation );
			
			if(labelOperation == 0){
				val = $("#gm_idlabel").val();
				id = val.substring(0, val.indexOf("_"));	 
			    
				datiForm.append( 'idLabel', id );
				//datiForm.append( 'idlabelColor', $("#gm_idlabelColor").val() );
				
			}else if(labelOperation == 1){
				
				datiForm.append( 'newLabel', $("#gm_newLabel").val() );
				datiForm.append( 'newLabelColor', $("#gm_newLabelColor").val() );
				
			}else if(labelOperation == 2){
				val = $("#gm_idlabel").val();
				id = val.substring(0, val.indexOf("_"));	 
			   
				datiForm.append( 'idEditLabel', id );
				datiForm.append( 'labelEditName', $("#gm_NameEditLabel").val() );
				datiForm.append( 'labelEditColor', $("#gm_newEditColor").val() );
			}
			
		
		    //idGoal = $( this ).attr( "id" );
			//$("#modalGoal .modal-title").html("Ciao");	
			$.ajax( {
						url: "../core/control/newGoal.php",
						type: 'POST', //Le info testuali saranno passate in POST
						data: datiForm, //I dati, forniti sotto forma di oggetto FormData
						cache: false,
						processData: false, //Serve per NON far convertire l’oggetto
						//FormData in una stringa, preservando il file
						contentType: false, //Serve per NON far inserire automaticamente
						//un content type errato
						success: function ( risposta ) {
							
							$('#answerHtml2').html(risposta);
							
							// imposto un refresh di pagina dopo 60 secondi

							/*setTimeout( function () {
								window.location.reload()
							}, 1000 );
							*/
						},
				
						error: function () {
							alert( "Chiamata fallita!!!" );
						}
					} );
			
		} );
		
		/*
			$('select').on('change', function() {
			  alert( this.value );
			});

			$('# option[value=val2]').attr('selected','selected');

			$('select_tags').on('change', function() {
				alert( $(this).find(":selected").val() );
			});
		*/
		 	  
		$('#oldLabel select').on('change', function() {
			  val = $(this).find(":selected").val();
			  id = val.substring(0, val.indexOf("_"));	 
			  color = val.substring(val.indexOf("_")+1);
			
			  text = $(this).find(":selected").text();
		      
			  $("#gm_NameEditLabel").val(text);
			  
			  selectorColor = '#divEditLabel option[value=' + color + ']';
			  $(selectorColor).attr('selected','selected');
			  
		});
	
</script>
	
<?php include_once("footerlinkscript.html")?>
	

</body>

</html>