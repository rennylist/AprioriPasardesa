@extends('index')

@section('content')
<div class="page-content">
	<div class="page-info">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Apps</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kombinasi Itemset</li>
			</ol>
		</nav>
		<div class="page-options">
			<a href="/apriori" class="btn btn-primary">Lihat Association Rules</a>
		</div>
	</div>
	<div class="main-wrapper">
		<!-- content -->
		@foreach ($aprioriAlgorithm->k_itemset as $k => $k_itemsets)
		<h3>{{ $k }}-Itemset</h3>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="100px">ID</th>
					<th width="120px">Jumlah Order</th>
					<th width="160px">Support (%)</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($k_itemsets as $result)
				<tr>
					<td>{{ str_pad(implode(', ', $result['items']), 17, ' ') }}</td>
					<td>{{ str_pad($result['count'], 13, ' ') }}</td>
					<td>{{ $result['support'] }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<hr>
		@endforeach



	</div>
</div>
@endsection