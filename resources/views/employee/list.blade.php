<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIMPLE LEVEL 9 CRUD</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>
	<div class="bg-dark py-3">
		<div class="container">
			<div class="h4 text-white">Crud Application</div>
		</div>
	</div>

	<div class="container">
		<div class="d-flex justify-content-between py-3">
			<div class="h4">Employees</div>
			<div>
				<a href="{{ route('employees.create') }}" class="btn btn-primary">Create</a>
			</div>
			
		</div>

@if (Session::has('success'))
	<div class="alert alert-success">
		{{ Session::get('success') }}
	</div>
@endif
	<div class="card border-0 shadow-lg">
		<div class="card-body">
			<table class="table table-striped">
				<tr>
					<th>Id</th>
					<th>Image</th>
					<th>Name</th>
					<th>Email</th>
					<th>Address</th>
					<th>Action</th>
				</tr>

				@if ($employees->isNotEmpty())
				@foreach ($employees as $item)
					
				<tr valign="middle">
					<td>{{ $item->id }}</td>
					<td>
						@if ($item->image != '' && file_exists(public_path().'/uploads/employees/'.$item->image))
							<img src={{ url('uploads/employees/'.$item->image) }} alt="" width="40" height="40" class="rounded-circle">
						@else
						<img src="{{ url('assets/images/no-img.png') }}" alt="" width="40" height="40" class="rounded-circle">
						@endif
					</td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->email }}</td>
					<td>{{ $item->address }}</td>
					<td>
						<a href="{{ route('employees.edit' , $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
						<a href="#" onclick="deleteEmployee({{ $item->id }})" class="btn btn-danger btn-sm">Delete</a>

						<form id="employee-edit-action-{{ $item->id }}" action="{{ route('employees.destroy' , $item->id) }}" method="post">
						@csrf
						@method('delete')
						</form>
					</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td colspan="6">No data Found</td>
				</tr>
				@endif
			</table>
		</div>
	</div>
	<div class="mt-3">
		{{ $employees->links() }}
	</div>
</div>
<script>
	function deleteEmployee(id){
		if(confirm("are you sureyou want to delete ? ")){
			document.getElementById('employee-edit-action-'+id).submit();
		}
	}


</script>
</body>
</html>
