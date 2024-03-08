@extends('layout.app')
@section('title', 'Learning List')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Transaction List</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Pages</li>
<li class="breadcrumb-item active">Transaction List</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 xl-60">
			<div class="row">

                @foreach ($transaction as $trx )
				<div class="col-xl-3 xl-50 col-sm-6 box-col-6">
					<div class="card">
						<div class="blog-box blog-grid text-center product-box">
							<div class="product-img">
								<img class="img-fluid top-radius-blog" src="{{asset('assets/images/login/122.png')}}" alt="">
								<div class="product-hover">
									<ul>
										<li><a href="{{ route('transaction.show', $trx->id) }}"><i class="icofont icofont-ui-note"></i></a></li>
										<li><a href="{{ route('invoice', $trx->id) }}" target="_blank"><i class="icofont icofont-print"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="blog-details-main">
								<ul class="blog-social">
									<li class="digits">{{ date('m-d-Y', strtotime($trx->updated_at)) }}</li>
									<li class="digits">by: {{$trx->user->name}}</li>
									<li class="digits">Rp. {{$trx->purchase_order}}</li>
								</ul>
								<hr>
								<h6 class="blog-bottom-details">{{$trx->transaction_code}}</h6>
							</div>
						</div>
					</div>
				</div>
                @endforeach

			</div>
		</div>
		
	</div>
</div>
@endsection

@section('script')

@endsection