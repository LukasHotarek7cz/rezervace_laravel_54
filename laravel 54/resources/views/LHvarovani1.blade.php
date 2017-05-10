
@if(count($errors))
	<div style="background-color:red; color:black; padding:3px;" >
		@foreach($errors->all() as $e1)
			<?= $e1 ?>
		@endforeach
	</div>
@endif
