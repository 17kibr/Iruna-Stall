

<link href="{{ asset('css/error.css') }}" rel="stylesheet">
<div class="container">
	<div class="row">
		<div class="col-md-11 offset-md-1" >
		<div style="height: auto !important;">
			<br>
			
			<div id="notfound">
				<div class="notfound">
					<div class="notfound-404">
						<h1>Oops!</h1>
					</div>
					<p>{{ $exception->getMessage() }}</p>
					<a href="/">Go To Homepage</a>
				</div>
			</div>
		</div>
	</div>



