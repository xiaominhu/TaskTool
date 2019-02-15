<div class="row"> 
		<div class="form-group"> 
			<label class="col-md-3 control-label text-right"> <strong> First Name: </strong></label>
			<div class="col-md-9">
				<label  class="control-label"> {!! $client->first_name !!} </label>
			</div> 
		</div>
		
		<div class="form-group"> 
			<label class="col-md-3 control-label text-right"> <strong> Last Name: </strong></label>
			<div class="col-md-9">
				<label  class="control-label"> {!! $client->last_name !!} </label>
			</div> 
		</div>
		<div class="form-group"> 
			<label class="col-md-3 control-label text-right"> <strong> Company: </strong></label>
			<div class="col-md-9">
				<label  class="control-label"> {!! $client->company !!} </label>
			</div> 
		</div>
		
		<div class="form-group"> 
			<label class="col-md-3 control-label text-right"> <strong> Phone: </strong></label>
			<div class="col-md-9">
				<label  class="control-label"> {!! $client->phone !!} </label>
			</div> 
		</div>
		
		
		<div class="form-group"> 
			<label class="col-md-3 control-label text-right"> <strong> Address: </strong></label>
			<div class="col-md-9">
				<label  class="control-label"> {!! $client->address !!} </label>
			</div> 
		</div>
		
		<div class="form-group "> 
			<label class="col-md-3 control-label text-right"> <strong> Email: </strong></label>
			<div class="col-md-9">
				<label  class="control-label"> {!! $client->email !!} </label>
			</div> 
		</div>
		
		<div class="form-group clearfix"> 
			<label class="col-md-3 control-label text-right"> <strong> Pool Description: </strong></label>
			<div class="col-md-9">
				<label  class="control-label"> {!! $client->pool_description !!} </label>
			</div> 
		</div>
		
		@if(count($client->clientpool))
			<div class = "form-group clearfix">
				<div id ="form-gallery" style="display:none;">  
					@foreach($client->clientpool as $item)
					<a href="#">
						<img alt="{!! $item->id !!}"
							 src="{!! asset('images/client/' . $item->name)!!}"
							 data-image="{!! asset('images/client/'. $item->name)!!}"
							 data-description="{!! $item->id !!}"
							 style="display:none">
					</a>  
					@endforeach
				</div>
			</div>
		@endif 
</div>
				