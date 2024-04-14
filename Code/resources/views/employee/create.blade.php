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
				<a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
			</div>
		</div>

		<form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="card border-0 shadow-lg">
				<div class="card-body">
					<div class="mb-3">
						<label for="name" class="form-label">Name</label>
						<input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name')
							is-invalid
						@enderror" value="{{ old('name') }}">
						@error('name')
						<p class="invalid-feedback">{{ $message }}</p>
						@enderror
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="text" name="email" id="email" placeholder="Enter Email" class="form-control @error('email')
						is-invalid
					@enderror" value="{{ old('email') }}">
					@error('email')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
					</div>
					<div class="mb-3">
						<label for="address" class="form-label">Address</label>
						<textarea name="address" id="address" cols="30" rows="4" placeholder="Enter Address" class="form-control" >{{ old('address') }}</textarea>
					</div>

					<div class="mb-3">
						<label for="image" class="form-label"></label>
						<input type="file" name="image" class="@error('image')
						is-invalid
					@enderror">
						@error('image')
					<p class="invalid-feedback">{{ $message }}</p>
					@enderror
					</div>
				</div>
			</div>
			<button class="btn btn-primary mt-3">Save Employee</button>
		</form>
</div>
</body>
</html>