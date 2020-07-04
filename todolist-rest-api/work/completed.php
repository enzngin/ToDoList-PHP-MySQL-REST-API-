<!DOCTYPE html>
<html>
	<head>
		<title>ToDoList</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			
			<br />
			<div style="margin-bottom:5px;">
			    <a href="index.php"><button type="button" name="add_button" id="add_button" class="btn btn-primary btn-xs">Yapılacaklar Listesi</button></a>
				
				
				
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Tamamlanmış İşler</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</body>
</html>


<script>
$(document).ready(function(){

fetch_data();

function fetch_data()
{
    $.ajax({
        url:"fetch_completed.php",
        success:function(data)
        {
            $('tbody').html(data);
        }
    })
}


$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Silmek istediğinize emin misiniz?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Silindi!");
				}
			});
			
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr("id");
		var action = 'done';
		if(confirm("Yapılacak işler listesine geri göndermek istediğinize emin misiniz?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Yapılacak işler listesine geri gönderildi!");
				}
			});
		}
	});









});


</script>