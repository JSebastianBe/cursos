<div class="row notificaciones">
	<?php 
	if(isset($this->d['notificacion'])){
		$notificacion = $this->d['notificacion'];

	  	if($notificacion['error']){
	  	?>
	  		<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  		<strong><i class="bi bi-patch-exclamation"></i></strong>
	  	<?php	
	  	}else{
	  	?>
	  		<div class="alert alert-success alert-dismissible fade show" role="alert">
	  		<strong><i class="bi bi-patch-check"></i></strong>
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
