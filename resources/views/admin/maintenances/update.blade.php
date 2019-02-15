@extends('layouts.admin')
@section('title','Update Maintenance | '.  $task->id)
@section('usercontent')
	@push('css')  
		<link href="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}" rel="stylesheet">
		<link href="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/heatmap/css/bootstrap-colorpicker.min.css') }}">
	@endpush
	
	<div id="page-head">
		<div id="page-title">
			<h1 class="page-header text-overflow">Update Maintenance</h1>
		</div>
		<ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="{{route('adminmaintenances')}}"> Manage Maintenances </a></li>   
			<li class="active">Update Maintenance</li>
		</ol>
	</div>    
	<div id="page-content">
		<div class="row"> 
			<div class="col-md-6 col-md-offset-3">  
				<div class="panel panel-bordered panel-info">
					<div class="panel-heading"> 
						<div class="panel-control">
							<a href = "{!! route('adminmaintenances') !!}?employee={!! $task->employee !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a>  
						</div>
						<h3 class="panel-title"> Update Maintenance </h3> 
					</div>
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{ route('adminmaintenancesupdate', $task->id) }}">  
							<div class="form-group"> 
								<label class="col-md-3 control-label"> <strong> Client: <star>*</star></strong></label>
								<div class="col-md-3">
									<select name = "client"   class="form-control" type="text" required>
										<option> Please select the client </option>
										@foreach($clients as $client)
											<option value = "{!! $client->id !!}" @if($errors->any()) @if(old('client') == $client->id) selected @endif @else @if($client->id == $task->client) selected @endif @endif > {!! $client->first_name !!} {!! $client->last_name !!} </option>
										@endforeach
									</select>
									@if ($errors->has('client'))  
										<span class="help-block">
											<strong>{{ $errors->first('client') }}</strong>
										</span>
									@endif   
								</div>
								<label class="col-md-3 control-label"> <strong> Date: <star>*</star></strong></label>
								<div class="col-md-3">
									<div id="demo-dp-component">
										<div class="input-group date">
											<input type="text" class="form-control" name = "date"  value ="@if($errors->any()){{old('date')}}@else{{$task->date}}@endif" required>
											<span class="input-group-addon"><i class="demo-pli-calendar-4"></i></span>
										</div> 
									</div> 
									@if ($errors->has('date'))  
										<span class="help-block">
											<strong>{{ $errors->first('date') }}</strong>
										</span>
									@endif   
									@if(Session::has('maintenanceweekupdate'))  
										<span class="help-block">
											<strong>{{ Session::get('maintenanceweekupdate') }}</strong>
										</span>
									@endif  
								</div>  
							</div> 
							<div class="form-group">   
								<label class="col-md-3 control-label"> <strong> MAINTENANCE SIGN:  </strong></label>
								<div class="col-md-3">
									 <select name = "sign"   class="form-control" type="text">
										<option value = ""> Please select the maintenance sign. </option>
										@foreach($maintenancesigns as $maintenancesign) 
											<option value = "{!! $maintenancesign->id !!}" @if($errors->any()) @if(old('sign') == $maintenancesign->id) selected @endif @else @if($maintenancesign->id == $maintenance->sign) selected @endif @endif > {!! $maintenancesign->title !!} </option> 
										@endforeach
									</select>
									@if ($errors->has('sign'))  
										<span class="help-block">
											<strong>{{ $errors->first('sign') }}</strong>
										</span>
									@endif   
								</div>   
								<label class="col-md-3 control-label"> <strong> Time: <star>*</star></strong></label>
								<div class="col-md-3">
									<div class="input-group date">
										<input id="demo-tp-com" type="text" class="form-control" name = "time"  required>
										<span class="input-group-addon"><i class="demo-pli-clock"></i></span>
									</div>
									@if ($errors->has('time'))   
										<span class="help-block">
											<strong>{{ $errors->first('time') }}</strong>
										</span>
									@endif   
								</div> 
							</div> 
							
							<div class="form-group">
								<label class="col-md-3 control-label"> </label>
								<div class="col-md-3">
									<button type = "button" class="btn btn-primary createnewsign">Creat New Sign</button> 
								</div> 
							</div> 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<div class="table-responsive">
										<table class="table table-vcenter mar-top">
											<thead>
												<tr>
													<th class="min-w-td">Chemical Readings</th>
													<th class="min-w-td">In Range</th>
													<th>  Out of Range   </th>
													<th>   Action Taken  </th> 
												</tr>
											</thead>
											<tbody> 
												<tr>
													<td class="min-w-td"> Chlorine  </td>
													<td class = "text-center">
														<div class="radio">
															<input id="chlorine-form-radio" class="magic-radio" type="radio" name="chlorine" value = "0" @if($errors->any()) @if(old('chlorine') == '0') checked @endif @else @if($maintenance->chlorine == '0') checked @endif @endif >
															<label for="chlorine-form-radio"></label>
														</div> 
													</td>
													<td class = "text-center">  
													    <div class="radio">
															<input id="chlorine-form-radio-2" class="magic-radio" type="radio" name="chlorine" value = "1" @if($errors->any()) @if(old('chlorine') == '1') checked @endif @else @if($maintenance->chlorine == '1') checked @endif @endif>
															<label for="chlorine-form-radio-2"></label>
														</div> 
													</td>
													<td>   
														<input placeholder="" name = "chlorine_action_taken" value ="@if($errors->any()){{old('chlorine_action_taken')}}@else{{$maintenance->chlorine_action_taken}}@endif" class="form-control" type="text">
													</td> 
												</tr>
												
												<tr>
													<td class="min-w-td"> pH  </td>
													<td class = "text-center">
														<div class="radio">
															<input id="ph-form-radio" class="magic-radio" type="radio" name="ph" value = "0" @if($errors->any()) @if(old('ph') == '0') checked @endif @else @if($maintenance->ph == '0') checked @endif @endif>
															<label for="ph-form-radio"></label>
														</div> 
													</td>
													<td class = "text-center">
														<div class="radio">
															<input id="ph-form-radio-2" class="magic-radio" type="radio" name="ph" value = "1" @if($errors->any()) @if(old('ph') == '1') checked @endif @else @if($maintenance->ph == '1') checked @endif @endif>
															<label for="ph-form-radio-2"></label>
														</div> 
													</td>
													<td>
														<input placeholder="" name = "ph_action_taken" value ="@if($errors->any()){{old('ph_action_taken')}}@else{{$maintenance->ph_action_taken}}@endif" class="form-control" type="text">
													</td> 
												</tr>
												
												<tr>
													<td class="min-w-td"> Total alkalinity  </td>
													<td class = "text-center">
														<div class="radio">
															<input id="total_alkalinity-form-radio" class="magic-radio" type="radio" name="total_alkalinity" value = "0" @if($errors->any()) @if(old('total_alkalinity') == '0') checked @endif @else @if($maintenance->total_alkalinity == '0') checked @endif @endif>
															<label for="total_alkalinity-form-radio"></label>
														</div> 
													</td>
													<td class = "text-center">
														<div class="radio">
															<input id="total_alkalinity-form-radio-2" class="magic-radio" type="radio" name="total_alkalinity" value = "1" @if($errors->any()) @if(old('total_alkalinity') == '1') checked @endif @else @if($maintenance->total_alkalinity == '1') checked @endif @endif>
															<label for="total_alkalinity-form-radio-2"></label>
														</div> 
													</td>
													<td>
														<input placeholder="" name = "total_alkalinity_action_taken" value ="@if($errors->any()){{old('total_alkalinity_action_taken')}}@else{{$maintenance->total_alkalinity_action_taken}}@endif" class="form-control" type="text">
													</td> 
												</tr>
												
												<tr>
													<td class="min-w-td"> Stabilizer </td>
													<td class = "text-center">
														<div class="radio">
															<input id="stabilizer-form-radio" class="magic-radio" type="radio" name="stabilizer" value = "0" @if($errors->any()) @if(old('stabilizer') == '0') checked @endif @else @if($maintenance->stabilizer == '0') checked @endif @endif>
															<label for="stabilizer-form-radio"></label>
														</div> 
													</td>
													<td class = "text-center">
														<div class="radio">
															<input id="stabilizer-form-radio-2" class="magic-radio" type="radio" name="stabilizer" value = "1" @if($errors->any()) @if(old('stabilizer') == '1') checked @endif @else @if($maintenance->stabilizer == '1') checked @endif @endif>
															<label for="stabilizer-form-radio-2"></label>
														</div> 
													</td>
													<td>
														<input placeholder="" name = "stabilizer_action_taken"  value = "@if($errors->any()){{old('stabilizer_action_taken')}}@else{{$maintenance->stabilizer_action_taken}}@endif"   class="form-control" type="text">
													</td> 
												</tr>
												
												<tr>
													<td class="min-w-td"> Salt  </td>
													<td class = "text-center">
														<div class="radio">
															<input id="salt-form-radio" class="magic-radio" type="radio" name="salt" value = "0" @if($errors->any()) @if(old('salt') == '0') checked @endif @else @if($maintenance->salt == '0') checked @endif @endif>
															<label for="salt-form-radio"></label>
														</div> 
													</td>
													<td class = "text-center">
														<div class="radio">
															<input id="salt-form-radio-2" class="magic-radio" type="radio" name="salt" value = "1" @if($errors->any()) @if(old('salt') == '0') checked @endif @else @if($maintenance->salt == '1') checked @endif @endif>
															<label for="salt-form-radio-2"></label>
														</div> 
													</td>
													<td>
														<input placeholder="" name = "salt_action_taken" value ="@if($errors->any()){{old('salt_action_taken')}}@else{{$maintenance->salt_action_taken}}@endif" class="form-control" type="text">
													</td> 
												</tr>
												
												<tr>
													<td class="min-w-td"> Other  </td>
													<td class = "text-center">
														<div class="radio">
															<input id="other-form-radio" class="magic-radio" type="radio" name="other" value = "0" @if($errors->any()) @if(old('other') == '0') checked @endif @else @if($maintenance->other == '0') checked @endif @endif>
															<label for="other-form-radio"></label>
														</div> 
													</td>
													<td class = "text-center">
														<div class="radio">
															<input id="other-form-radio-2" class="magic-radio" type="radio" name="other" value = "1" @if($errors->any()) @if(old('other') == '1') checked @endif @else @if($maintenance->other == '1') checked @endif @endif>
															<label for="other-form-radio-2"></label>
														</div> 
													</td>
													<td>
														<input placeholder="" name = "other_action_taken" value ="@if($errors->any()){{old('other_action_taken')}}@else{{$maintenance->other_action_taken}}@endif" class="form-control" type="text">
													</td> 
												</tr>
												
											</tbody>
										</table> 
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<strong> We tested / serviced the fallowing equipment: </strong>
								</div>
							</div> 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11"> 
									<div class="checkbox">
										<input id="demo-checkbox-2" class="magic-checkbox" type="checkbox" name="equipment[]" value="pump"  @if($errors->any()) @if(in_array("pump", old('equipment'))) checked @endif @else  @if(in_array("pump", $equipment_array)) checked @endif @endif >
										<label for="demo-checkbox-2">Pump</label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-3" class="magic-checkbox" type="checkbox" name="equipment[]" value="filter" @if($errors->any()) @if(in_array("filter", old('equipment'))) checked @endif @else @if(in_array("filter", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-3">Filter </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-4" class="magic-checkbox" type="checkbox" name="equipment[]" value="heater"  @if($errors->any()) @if(in_array("heater", old('equipment'))) checked @endif @else @if(in_array("heater", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-4">Heater</label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-5" class="magic-checkbox" type="checkbox" name="equipment[]" value="heat_pump" @if($errors->any()) @if(in_array("heat_pump", old('equipment'))) checked @endif @else @if(in_array("heat_pump", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-5">Heat pump</label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-6" class="magic-checkbox" type="checkbox" name="equipment[]" value="salt_chlorinator_system" @if($errors->any()) @if(in_array("salt_chlorinator_system", old('equipment'))) checked @endif @else @if(in_array("salt_chlorinator_system", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-6">Salt chlorinator system </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-7" class="magic-checkbox" type="checkbox" name="equipment[]" value="pool_light" @if($errors->any()) @if(in_array("pool_light", old('equipment'))) checked @endif @else @if(in_array("pool_light", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-7">Pool light (s) </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-8" class="magic-checkbox" type="checkbox" name="equipment[]" value="spa_light" @if($errors->any()) @if(in_array("spa_light", old('equipment'))) checked @endif @else @if(in_array("spa_light", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-8"> Spa light (s) </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-9" class="magic-checkbox" type="checkbox" name="equipment[]" value="automation_system" @if($errors->any()) @if(in_array("automation_system", old('equipment'))) checked @endif @else @if(in_array("automation_system", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-9"> Automation system  </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-1" class="magic-checkbox" type="checkbox" name="equipment[]" value="other" @if($errors->any()) @if(in_array("other", old('equipment'))) checked @endif @else @if(in_array("other", $equipment_array)) checked @endif @endif>
										<label for="demo-checkbox-1"> Other  </label>
									</div> 
								</div> 
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									Comments 
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "serviced_comments" class="form-control" type="text">@if($errors->any()){{old('serviced_comments')}}@else{{$maintenance->serviced_comments}}@endif</textarea>
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<strong> Actions required of pool owner: </strong>
								</div>
							</div> 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11"> 
									<div class="checkbox">
										<input id="checkbox-2" class="magic-checkbox" type="checkbox" name="poolowner[]" value="clean" @if($errors->any()) @if(in_array("clean", old('poolowner'))) checked @endif @else @if(in_array("clean", $poolowner_array)) checked @endif @endif >
										<label for="checkbox-2">Please clean filter </label>
									</div> 
									<div class="checkbox">
										<input id="checkbox-3" class="magic-checkbox" type="checkbox" name="poolowner[]" value="waterto" @if($errors->any()) @if(in_array("waterto", old('poolowner'))) checked @endif @else @if(in_array("waterto", $poolowner_array)) checked @endif @endif>
										<label for="checkbox-3">Please add water to pool  </label>
									</div> 
									<div class="checkbox">
										<input id="checkbox-4" class="magic-checkbox" type="checkbox" name="poolowner[]" value="waterfrom" @if($errors->any()) @if(in_array("waterfrom", old('poolowner'))) checked @endif @else @if(in_array("waterfrom", $poolowner_array)) checked @endif @endif>
										<label for="checkbox-4">Please drain excess water from pool </label>
									</div>
									<div class="checkbox">
										<input id="checkbox-5" class="magic-checkbox" type="checkbox" name="poolowner[]" value="other" @if($errors->any()) @if(in_array("other", old('poolowner'))) checked @endif @else @if(in_array("other", $poolowner_array)) checked @endif @endif>
										<label for="checkbox-5">Other</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									Comments
								</div>
							</div>
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "pool_comments" class="form-control" type="text">@if($errors->any()){{old('pool_comments')}}@else{{$maintenance->pool_comments}}@endif</textarea>
								</div>
							</div>
							 
							<div class="form-group">   
								<div class="col-md-12 text-center">  
									<button type = "submit" class="btn btn-mint">Update</button>
									<a href = "{!! route('adminmaintenances') !!}?employee={!! $task->employee !!}" class="btn btn-danger">Cancel</a>
								</div>
							</div>
							{{csrf_field()}} 
						</form>
					</div> 
				</div> 
			</div>
		</div>
	</div>  
	<div id="detailmodal" class="modal fade" role="dialog">
		<div class="modal-dialog"> 
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">  Create New Sign   </h4>
			  </div>
			  <div class="modal-body">
				<div class="row"> 
					<div class="col-md-12">  
						<div class="form-group clearfix"> 
							<label class="col-md-3 control-label"> <strong> SIGN TITLE: <star>*</star></strong></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name = "sign_title" required> 
							</div>  
						</div>
						<div class="form-group clearfix"> 
							<label class="col-md-3 control-label"> <strong> SIGN COLOR: <star>*</star></strong></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name = "sign_color" required> 
							</div>  
						</div>
					</div>
				</div> 
			  </div>
			  <div class="modal-footer">
					<button type="button" class="btn btn-primary addsign">Add</button>                         
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
			  </div>
			</div> 
		</div>
	</div> 
	@push('scripts')
	<?php
		if($errors->any())
			$time = old('time');
		else
			$time = $task->time; 
		$time = date("h:i A", strtotime($time));   
	?>
    <script src="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') !!}"></script>
    <script src="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') !!}"></script>
	<script src="{{  asset('plugins/heatmap/js/bootstrap-colorpicker.min.js') }}"  type="text/javascript"></script>	 
	<script> 
		$('#demo-tp-com').timepicker({defaultTime: '{!! $time !!}'});  
		$('#demo-dp-component .input-group.date').datepicker({
				format: "yyyy-mm-dd",
				todayBtn: "linked",
				autoclose: true,
				todayHighlight: true
		});	
		$('input[name="sign_color"]').colorpicker(
			{
				format: 'hex'
			}
		);    
		$(".createnewsign").click(function(){
			$('input[name="sign_color"]').val('');
			$('input[name="sign_title"]').val('');
			$('#detailmodal').modal('show');
		}); 
		$(".addsign").click(function(){
			if(($('input[name="sign_color"]').val() == "") || ($('input[name="sign_title"]').val() == ""))
				return; 
			  $.ajax({
				url: '{!! route('adminmaintenancesaddsign') !!}',
				type: 'POST',
				data: {_token : "{{ csrf_token() }}", color : $('input[name="sign_color"]').val(), title : $('input[name="sign_title"]').val()},
				dataType: 'json',
				beforeSend: function () {
					
				},
				success: function(json) {
					 if(json.status){
							$('select[name="sign"]').html(json.html);
					 }
					 
						
				},
				complete: function () {
					$('#detailmodal').modal('hide');
				},
				error: function() { 
				}
			}); 
		}); 
	</script> 
	@endpush	
	
	
@endsection
