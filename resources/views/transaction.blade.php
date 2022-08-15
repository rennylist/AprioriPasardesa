@extends('index')

@section('content')
<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Apps</a></li>
				<li class="breadcrumb-item active" aria-current="page">Data Transaction</li>
			</ol>
		</nav>
		<div class="page-options">
			<form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
				@csrf
				<!-- <a href="#" class="btn btn-secondary">Chose File</a> -->
				<div class="row">
					<div class="col-lg-8">
						<input type="file" class="form-control form-control-sm" id="transaction" name="transaction" aria-describedby="emailHelp" placeholder="Chose File">
					</div>
					<div class="col-lg-4">
						<button type="submit" class="btn btn-lg btn-primary">Upload</button>
					</div>	
				</div>

			</form>
		</div>
	</div>
	<div class="main-wrapper">
		<!-- content -->

		<div class="row">
			<div class="col-md-12">
				<div class="page-title">
					<p class="page-desc">Import Data Transaksi Pasardesa.id Dalam Bentuk Format Excel</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Data Transaction</h5>
						<p>Data Transaksi Pasardesa Tahun 2022</p>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Code Transaction</th>
									<th scope="col">Product Name</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($transaction as $t)
								<tr>
									<th scope="row">{{ $loop->iteration }}</th>
									<td>{{ $t->code_transaction }}</td>
									<td>{{ $t->transactiondetail->pluck('product_name')->join(', ') }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>       
					</div>
				</div>
			</div>
		</div>
		@if ($transaction->lastPage() > 1 || $transaction->currentPage() > $transaction->lastPage())
		<ul class="pagination pagination-circle">
			<li class="page-item {{ ($transaction->currentPage() == 1) ? ' disabled' : '' }}">
				<a class="page-link" href="{{ $transaction->url(1) }}" aria-label="Previous">
					<span aria-hidden="true">«</span>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			@for ($i = 1; $i <= $transaction->lastPage(); $i++)
			<li class="page-item {{ ($transaction->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $transaction->url($i) }}">{{ $i }}</a></li>
			@endfor
			<li class="page-item {{ ($transaction->currentPage() == $transaction->lastPage()) ? ' disabled' : '' }}">
				<a class="page-link" href="{{ $transaction->url($transaction->currentPage()+1) }}" aria-label="Next">
					<span aria-hidden="true">»</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
		</ul>
		@endif
	</div>
</div>
@endsection