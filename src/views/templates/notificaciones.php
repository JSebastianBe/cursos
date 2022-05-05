<div class="row notificaciones">
	<?php 
	if(isset($this->d['notificacion'])){
		$notificacion = $this->d['notificacion'];
		?>
		
		  	<?php
		  	if($notificacion['error']){
		  	?>
		  		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  		<strong>!Error!</strong>
		  	<?php	
		  	}else{
		  	?>
		  		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  		<strong>!Correcto!</strong>
		  	<?php	
		  	}
		  	echo $notificacion['mensaje']
		  	?>
		  	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
	<?php
	}
	?>
</div>
