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
			<form action="{{ route('processapriori') }}" method="post">
				@csrf
				<button type="submit" class="btn btn-lg btn-primary">Proses Apriori</button>
			</form>
		</div>
	</div>
	<div class="main-wrapper">
		<!-- content -->

		<div class="row">
			<div class="col-md-12">
				<div class="page-title">
					<p class="page-desc">Click Tombol Proses Untuk Mendapatkan Hasil Rekomendasi Produk Yang di Beli</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Hasil Rekomendasi</h5>
						<p>Hasil Rekomendasi Produk Dari Data Transaksi Pasardesa.id</p>
						<table class="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">products</th>
									<th scope="col">recommendation</th>
									<th scope="col">confidence</th>
									<th scope="col">lift</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($apriori as $a)
								<tr>
									<th scope="row">{{ $loop->iteration }}</th>
									<td>{{ $a->products_name }}</td>
									<td>{{ $a->recommendation_name }}</td>
									<td>{{ $a->confidence }}</td>
									<td>{{ $a->lift }}</td>
								
								</tr>
								@endforeach
							</tbody>
						</table>       
					</div>
				</div>
			</div>
		</div>
		@if ($apriori->lastPage() > 1 || $apriori->currentPage() > $apriori->lastPage())
		<ul class="pagination pagination-circle">
			<li class="page-item {{ ($apriori->currentPage() == 1) ? ' disabled' : '' }}">
				<a class="page-link" href="{{ $apriori->url(1) }}" aria-label="Previous">
					<span aria-hidden="true">«</span>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			@for ($i = 1; $i <= $apriori->lastPage(); $i++)
			<li class="page-item {{ ($apriori->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $apriori->url($i) }}">{{ $i }}</a></li>
			@endfor
			<li class="page-item {{ ($apriori->currentPage() == $apriori->lastPage()) ? ' disabled' : '' }}">
				<a class="page-link" href="{{ $apriori->url($apriori->currentPage()+1) }}" aria-label="Next">
					<span aria-hidden="true">»</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
		</ul>
		@endif
	</div>
</div>
@endsection