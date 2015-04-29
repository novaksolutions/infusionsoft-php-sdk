<?php
	include('../infusionsoft.php');
	include('object_editor_all_tables.php');	
	include('../tests/testUtils.php');
	if(empty($_GET['object'])){
		renderLoadForm(); 
	}
	elseif(isset($_POST['Id'])){
		$class_name = "Infusionsoft_" . $_GET['object'];
		$object = null;
		
		echo 'I am loading an object...';
		try{		
			$object = new $class_name($_GET['Id']);
		}
		catch(Exception $e){
			echo $e->getMessage();
			renderLoadForm();
			return;
		}
		foreach($object->getFields() as $fieldName){
			$object->$fieldName = $_POST[$fieldName];			
		}	 		
		$object->save();
		
		echo 'Object Saved!';
		renderObjectForm($object);
	}
	else{
		$class_name = "Infusionsoft_" . $_GET['object'];
		$object = null;
		
		echo 'I am loading an object...';
		try{		
			$object = new $class_name($_GET['Id']);
		}
		catch(Exception $e){
			echo $e->getMessage();
			renderLoadForm();
			return;
		}		
		renderObjectForm($object);		
	}
	
	function renderLoadForm(){
		?>
			<form>
				Table:<br/>				
				<select name="object">
					<?php
						global $all_tables;
						sort($all_tables);
						foreach($all_tables as $table){
							?><option value="<?php echo $table; ?>"><?php echo $table; ?></option><?php 
						} 
					?>					
				</select><br/>				
				Id:<br/>
				<input type="text" name="Id"/><br/>
				<input type="submit"/>
			</form>
		<?php
	}
	
	function renderObjectForm($object){
	?>
		<form method="post">
			<input type="hidden" name="object" value="<?php echo $object->getTable();?>"/>
		<?php 
		foreach($object->toArray() as $field=>$value){
			?>
				<?php echo $field; ?><br/>
				<input type="text" name="<?php echo $field; ?>" value="<?php echo $value; ?>"><br/>
			<?php 
		}
		?>
		<input type="submit"/>
		</form>
		<?php 		
	}