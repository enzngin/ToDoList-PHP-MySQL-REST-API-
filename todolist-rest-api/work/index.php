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
			<div  style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Yeni Yapılacak İş Ekle</button>
				<a style="float: right;"href="completed.php"><button type="button" name="add_button" id="add_button" class="btn btn-primary btn-xs">Tamamlanmış İşleri Göster</button></a>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Yapılacak İşler</th>
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

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title"></h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>İş İsmi</label>
			        	<input type="text" name="todoname" id="todoname" class="form-control" />
			        </div>
			       
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Ekle" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	fetch_data();

	function fetch_data()
	{
		$.ajax({
			url:"fetch.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('.modal-title').text('Yapılacak İş Ekle');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#todoname').val() == '')
		{
			alert("Lütfen boş bırakmayınız!");
		}
	
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Yapılacak iş listeye eklendi!");
					}
				
				}
			});
		}
	});


	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Listeden kaldırmak istiyor musunuz?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Kaldırıldı");
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr("id");
		var action = 'undone';
		
		if(confirm("Tamamlanmış işler listesine göndermek istiyor musunuz?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Tamamlanmış işler listesine gönderildi!");
				}
			});
		}
	});

});
</script>