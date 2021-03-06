@extends('layouts.main')
@section('title')
<meta name='coverage' content='Worldwide'>
    <meta name='distribution' content='Global'>
    <meta name='rating' content='General'>
    <meta name='HandheldFriendly' content='True'>
    <meta name='MobileOptimized' content='320'>
    <meta name='target' content='all'>
    <meta name="apple-mobile-web-app-title" content="Iruna Global Stall">
    <meta name='apple-mobile-web-app-capable' content='yes'>
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name='application-name' content="Iruna Global Stall">
    <link rel="apple-touch-icon" href="https://irunastall.com/img/iruna.jpg">
    <meta name="twitter:card" content="summary" >
    <meta name="twitter:title" content="Search | Iruna Global Stall" >
    <meta name="twitter:description" content="Search for item in Iruna Global Stall" >
    <meta property="og:title" content="Search | Iruna Global Stall">
    <meta property="og:type" content="website" >
    <meta property="og:description" content="Search for item in Iruna Global Stall">
    <meta property="og:image" content="https://irunastall.com/img/iruna.jpg">
	<meta property="og:url" content="https://irunastall.com" >
	   
    <!-- manifest for PWA -->
    <link rel="manifest" href="manifest.json" >
    <script src="js/serviceLoader.js"></script>
@endsection

@section('content')

<link href="{{ asset('css/mainsearch.css') }}" rel="stylesheet">
<link href="{{ asset('css/util.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<div class="container">
    <div class="row" >
        <div class="col-md-7 offset-md-2" >
            <br>
            <br>
			<form class="form-inline" name="form1" id="form1" action="/search" method="GET">
				@csrf
			  <div class="form-group mb-2" style="width:80%">
				<label for="search" class="sr-only">Item name</label>
				<input type="text" class="form-control ui-autocomplete-input" id="search"  name="search" placeholder="Item name" autocomplete="off" style="width:98%">
			  </div>
			  <button type="submit" class="btn btn-primary mb-2" name="search_button" id="search_button" value="Search" style="width:20%">Search</button>
			</form>
			@error('searcherror')
			<div style="color:red">{{$message}}</div>
			<br>
			@enderror
        </div>
    </div>
</div>
<div class="container">
    <div class="row" >
        <div class="col-md-7 offset-md-2" >

            <div style="height: auto !important;">
                <br>
				<h4>Search Results: {{ $input }}</h4>
				<br>
				@error('searcherror')
				<div style="color:red">{{$message}}</div>
				<br>
				@enderror
				<p>There are {{$totalCount }} results</p>
				<hr>
				@if($equipSearch->count() >= 1)
				<h4>Equipment</h4>
				<br>
				<div>
					<div>
						<table id="equip">
							<thead>
								<tr class="table100-head">
									<th class="equipment">Name</th>
									<th class="equipment">ATK</th>
									<th class="equipment">DEF</th>
									<th class="equipment">Refinement</th>
									<th class="equipment">Slots</th>
									<th class="equipment">Slot 1</th>
									<th class="equipment">Slot 2</th>
									<th class="equipment">Ability</th>
									<th class="equipment">Ability Lv</th>
									<th class="equipment">Price</th>
									<th class="equipment">Contact</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($equipSearch as $equip)
									
								
								<tr>
									<td class="equipment"><a href="item/equip/{{$equip->item_id}}">{{ $equip->name }}</a></td>
									<td class="equipment">{{ $equip->atk }}</td>
									<td class="equipment">{{ $equip->def }}</td>
									<td class="equipment">{{ $equip->refinement }}</td>
									<td class="equipment">{{ $equip->slots }}</td>
									@if ($equip->slots == 0)
										<td class="equipment">/</td>
										<td class="equipment">/</td>
									@elseif ($equip->slots == 1)
										@if ($equip->slot1 == null)
											<td class="equipment">empty</td>
											<td class="equipment">/</td>
										@else
											<td class="equipment">{{ $equip->slot1 }}</td>
											<td class="equipment">/</td>
										@endif
									@elseif ($equip->slots == 2)
										@if ($equip->slot1 != null)
											@if ($equip->slot2 != null)
												<td class="equipment">{{ $equip->slot1 }}</td>
												<td class="equipment">{{ $equip->slot2 }}</td>
											@else
												<td class="equipment">{{ $equip->slot1 }}</td>
												<td class="equipment">empty</td>
											@endif
										@elseif ($equip->slot1 == null)
											@if ($equip->slot2 == null)
												<td class="equipment">empty</td>
												<td class="equipment">empty</td>
											@else
												<td class="equipment">empty</td>
												<td class="equipment">{{ $equip->slot2 }}</td>
											@endif
										@endif
									@endif
									
									@if ($equip->ability == null)
										<td class="equipment">none</td>
									@else
										<td class="equipment">{{ $equip->ability }}</td>
									@endif
									<td class="equipment">{{ $equip->ability_level}}</td>
									<td class="equipment">{{ number_format($equip->price )}}</td>
									<td class="equipment"><a href="/user/{{$equip->owner_id}}">{{ $equip->contact }}</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{$equipSearch->appends(['search' => request('search'), 'xtalPage' => request('xtalPage'), 'equipPage' => request('equipPage'), 'itemPage' => request('itemPage'), 'relicPage' => request('relicPage'), 'alPage' => request('alPage')])->fragment('equip')->links()}}
					</div>
				</div>
				@endif
				
				<br>
				@if($itemSearch->count() >= 1)
				<h4>Materials</h4>
				<br>
				<div>
					<div>
						<table id="material">
							<thead>
								<tr class="table100-head">
									<th class="materials">Name</th>
									<th class="materials">QTY</th>
									<th class="materials">Price</th>
									<th class="materials">Contact</th>
								</tr>
							</thead>
							<tbody>
								@foreach($itemSearch as $item)
								<tr>
									<td class="materials"><a href="/item/material/{{$item->item_id}}">{{ $item->name }}</td>
									<td class="materials">{{ $item->quantity }}</td>
									<td class="materials">{{ number_format($item->price) }}</td>
									<td class="materials"><a href="/user/{{ $item->owner_id}}">{{ $item->contact }}</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{$itemSearch->appends(['search' => request('search'), 'xtalPage' => request('xtalPage'), 'equipPage' => request('equipPage'), 'itemPage' => request('itemPage'), 'relicPage' => request('relicPage'), 'alPage' => request('alPage')])->fragment('material')->links() }}
					</div>
				</div>
				@endif
				<br>
				@if($xtalSearch->count() >= 1)
				<h4>Xtals</h4>
				<br>
				<div>
					<div>
						<table id="xtal">
							<thead>
								<tr class="table100-head">
									<th class="xtals">Name</th>
									<th class="xtals">QTY</th>
									<th class="xtals">Price</th>
									<th class="xtals">Contact</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($xtalSearch as $xtal)
									
								
								<tr>
								<td class="xtals"><a href="/item/xtal/{{$xtal->item_id}}">{{ $xtal->name }}</a></td>
									<td class="xtals">{{ $xtal->quantity }}</td>
									<td class="xtals">{{ number_format($xtal->price) }}</td>
									<td class="xtals"><a href="/user/{{ $xtal->owner_id}}">{{ $xtal->contact }}</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{$xtalSearch->appends(['search' => request('search'), 'xtalPage' => request('xtalPage'), 'equipPage' => request('equipPage'), 'itemPage' => request('itemPage'), 'relicPage' => request('relicPage'), 'alPage' => request('alPage')])->fragment('xtal')->links()}}
					</div>
				</div>
				@endif
				<br>
				@if($alSearch->count() >= 1)
				<h4>AL Crystals</h4>
				<br>
				<div>
					<div>
						<table id="alcrystas">
							<thead>
								<tr class="table100-head">
									<th class="als">Name</th>
									<th class="als">Color</th>
									<th class="als">QTY</th>
									<th class="als">Price</th>
									<th class="als">Contact</th>
								</tr>
							</thead>
							<tbody>
								@foreach($alSearch as $al)
									
								
								<tr>
                                    @if($al->color == "Red")
                                    <td class="als" style="color:red;"><a style="color:red;" href="/item/alcrystas/{{$al->item_id}}">{{ $al->name }}</a></td>
                                    @elseif($al->color == "Blue")
                                    <td class="als" style="color:blue;"><a style="color:blue;" href="/item/alcrystas/{{$al->item_id}}">{{ $al->name }}</a></td>
                                    @elseif($al->color == "Green")
                                    <td class="als" style="color:green;"><a style="color:green;" href="/item/alcrystas/{{$al->item_id}}">{{ $al->name }}</a></td>
                                    @endif
									<td class="als">{{ $al->color }}</td>
									<td class="als">{{ $al->quantity }}</td>
									<td class="als">{{ number_format($al->price) }}</td>
									<td class="als"><a href="/user/{{ $al->owner_id}}">{{ $al->contact }}</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{$alSearch->appends(['search' => request('search'), 'xtalPage' => request('xtalPage'), 'equipPage' => request('equipPage'), 'itemPage' => request('itemPage'), 'relicPage' => request('relicPage'), 'alPage' => request('alPage')])->fragment('alcrystas')->links()}}
					</div>
				</div>
				@endif
				<br>
				@if($relicSearch->count() >= 1)
				<h4>Relics</h4>
				<br>
				<div>
					<div>
						<table id="reliccrystas">
							<thead>
								<tr class="table100-head">
									<th class="relics">Name</th>
									<th class="relics">QTY</th>
									<th class="relics">Price</th>
									<th class="relics">Contact</th>
								</tr>
							</thead>
							<tbody>
								@foreach($relicSearch as $relic)
								<tr>
									<td class="relics"><a href="/item/relic/{{$relic->item_id}}">{{ $relic->name }}</a></td>
                                    <td class="relics">{{ $relic->quantity }}</td>
									<td class="relics">{{ number_format($relic->price) }}</td>
									<td class="relics"><a href="/user/{{$relic->owner_id}}">{{ $relic->contact }}</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{$relicSearch->appends(['search' => request('search'), 'xtalPage' => request('xtalPage'), 'equipPage' => request('equipPage'), 'itemPage' => request('itemPage'), 'relicPage' => request('relicPage'), 'alPage' => request('alPage')])->fragment('reliccrystas')->links()}}
					</div>
				</div>
				@endif
            </div>
        </div>


		<script src="https://code.jquery.com/jquery-3.4.1.min.js"   integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="   crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"   integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="   crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script type="text/javascript" id="cookieinfo"
		src="//cookieinfoscript.com/js/cookieinfo.min.js"></script>

		<script>
			
				$(document).ready(function() {
					
				$( "#search" ).autocomplete({
			   
				source: function(request, response) {
					$.ajax({
					url: "{{secure_url('api/searchitem')}}",
					data: {
							term : request.term
					 },
					dataType: "json",
					success: function(data){
					   var resp = $.map(data,function(obj){
							return obj.name;
					   }); 
		 
					   response(resp);
					}
				});
			},
			minLength: 3
		 });
		});

		/*(function($){
			window.onbeforeunload = function(e){    
				window.name += ' [' + $(window).scrollTop().toString() + '[' + $(window).scrollLeft().toString();
			};
				$.maintainscroll = setTimeout(function() {
				if(window.name.indexOf('[') > 0)
				{
				var parts = window.name.split('['); 
				window.name = $.trim(parts[0]);
				window.scrollTo(parseInt(parts[parts.length - 1]), parseInt(parts[parts.length - 2]));
				}   
			}) 
			$.maintainscroll();
		})(jQuery);*/
		</script>

@endsection
