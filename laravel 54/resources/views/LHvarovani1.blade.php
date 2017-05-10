
<style>
div.DivCLerror1{
	color:red;
	background-color:#eeeeee;
}
div.DivCLerror1:onclick{
	display:none;
}
div.DivCLerror1 div{
}
</style>
<script>


</script>

<div class=DivCLerror1 >
<div>

<?= $error1 ?><br>

@if(count($errors))
	@foreach($errors->all() as $e1)
		<?= $e1 ?>
	@endforeach
@endif

</div>
</div>

