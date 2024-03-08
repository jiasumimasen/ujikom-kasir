@extends('layout.app')
@section('title', 'JS Grid Tables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Product</li>
<li class="breadcrumb-item active">Tables Product</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Data Product</h5>
					<button class="btn btn-primary" style="margin-top:20px" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Product</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="display" id="basic-2">
							<thead>
							
								<tr>
									<th>Product Code</th>
									<th>Product Name</th>
									<th>Stock</th>
									<th>Price</th>
									<th><center>Action</center></th>

								</tr>
							</thead>
							<tbody>
							@foreach ($products as $product)
								<tr>
									<td>{{ $product->product_code }}</td>
									<td>{{ $product->name }}</td>
									<td>{{ $product->quantity }}</td>
									<td>{{ $product->price }}</td>
									<td><center>
											<form action="{{ route('products.destroy', $product->id)}}" method="post" style="display: inline-block">
                                               
											<a href="#" data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-code="{{ $product->product_code }}" data-quantity="{{ $product->quantity }}" data-price="{{ $product->price }}"><button class="btn btn-success">Edit</button></a>
											@csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
										</center>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>


               <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Input Product</h5>
                           <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
						<form class="needs-validation" novalidate="" method="POST" action="{{ route('products.store') }}">
						@csrf
                        <div class="modal-body">
							<input type="hidden" name="id">
						<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationTooltip01">Product Code</label>
								<input class="form-control" id="validationTooltip01" name="product_code" type="text" placeholder="Product Code" required="">
								<div class="invalid-tooltip">Please insert Product Code!</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="validationTooltip02">Product Name</label>
								<input class="form-control" id="validationTooltip02" name="name" type="text" placeholder="Product Name" required="">
								<div class="invalid-tooltip">Please Give a Product Name!</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationTooltip01">Stock</label>
								<input class="form-control" id="validationTooltip01" name="quantity" type="number" min="1" max="100" placeholder="Product Stock" required="">
								<div class="invalid-tooltip">Please insert Stock!</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="validationTooltip02">Price</label>
								<input class="form-control" id="validationTooltip02" name="price" type="text" placeholder="Price" required="">
								<div class="invalid-tooltip">Please Give Product Price!</div>
							</div>
						</div>
                        </div>
                        <div class="modal-footer">
                           <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                           <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
						</form>
                     </div>
                  </div>
               </div>

			   <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Edit Product</h5>
                           <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
						<form class="needs-validation" novalidate="" method="POST" action="{{ route('updatete') }}">
						@csrf
						@method('PUT')
                        <div class="modal-body">
						<div class="row">
							<input type="hidden" name="id">
							<div class="col-md-4 mb-3">
								<label for="validationTooltip01">Product Code</label>
								<input class="form-control" id="product_code" name="product_code" type="text"  required="">
								<div class="invalid-tooltip">Please insert Product Code!</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="validationTooltip02">Product Name</label>
								<input class="form-control" id="name" name="name" type="text" placeholder="Product Name"  required="">
								<div class="invalid-tooltip">Please Give a Product Name!</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationTooltip01">Stock</label>
								<input class="form-control" id="quantity" name="quantity" type="number" min="1" max="100" placeholder="Product Stock"  required="">
								<div class="invalid-tooltip">Please insert Stock!</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="validationTooltip02">Price</label>
								<input class="form-control" id="price" name="price"  type="text" placeholder="Price" required="">
								<div class="invalid-tooltip">Please Give Product Price!</div>
							</div>
						</div>


                        </div>
                        <div class="modal-footer">
                           <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                           <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
						</form>
                     </div>
                  </div>
               </div>


@endsection

@section('script')
@push('scripts')
<script>
    $("#edit").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var code = $(e.relatedTarget).data('code');
        var name = $(e.relatedTarget).data('name');
        var quantity = $(e.relatedTarget).data('quantity');
        var price = $(e.relatedTarget).data('price');
        var category = $(e.relatedTarget).data('category');
        
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="product_code"]').val(code);
        $('#edit').find('input[name="name"]').val(name);
        $('#edit').find('input[name="quantity"]').val(quantity);
        $('#edit').find('input[name="price"]').val(price);
        $('#edit').find('select[name="category_id"]').val(category);
    });
	</script>
@endpush
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
@endsection