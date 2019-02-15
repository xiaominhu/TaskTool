@extends('layouts.employee')
@section('title','Update Maintenance | '.  $task->first_name . ' ' . $task->last_name )
@section('usercontent')
	@push('css')  
		<link href="{!! asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') !!}" rel="stylesheet">
		<link href="{!! asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}" rel="stylesheet"> 
	@endpush 
	<?php 
			if(old('equipment')){
				$equipment_array = old('equipment'); 
			}
			 
			if(old('poolowner')){
				$poolowner_array = old('poolowner');
			}
	?>
	 
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
							<a href = "{!! route('employeemaintenances') !!}" class="btn btn-info"><i class="demo-psi-cross"></i></a> 
						</div> 
						<h3 class="panel-title"> Update Maintenance </h3> 
					</div>
					<div class="panel-body">   
						<form class="form-horizontal" method = "post" action = "{{ route('employeemaintenancesupdate', $task->id) }}">  
							<div class="form-group nomargin">  
								<label class="col-md-3 control-label text-right"> <strong> First Name: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">  
										{!! $task->first_name !!}
									</label> 
								</div>
								<label class="col-md-3 control-label text-right"> <strong> Service Date: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">  
										{!! $task->date !!}
									</label> 
								</div> 
							</div>  
							
							<div class="form-group nomargin">   
								<label class="col-md-3 control-label text-right"> <strong> Last Name: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">
										{!! $task->last_name !!}
									</label> 
								</div>  
								<label class="col-md-3 control-label text-right"> <strong> Service Time: </strong></label>
								<div class="col-md-3"> 
									<label  class="control-label">
										{!! $task->time !!}
									</label> 
								</div>  
							</div>  
							<div class="form-group nomargin">  
								<label class="col-md-3 control-label text-right"> <strong> Company: </strong></label>
								<div class="col-md-9"> 
									<label  class="control-label">  
										{!! $task->company !!}
									</label> 
								</div>  
							</div>  
							<div class="form-group nomargin">  
								<label class="col-md-3 control-label text-right"> <strong> Address: </strong></label>
								<div class="col-md-9"> 
									<label  class="control-label">  
										{!! $task->address !!}
									</label> 
								</div>  
							</div>  
							<div class="form-group">
								<div class = "col-md-1"> 
								</div>
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
														<input placeholder="" name = "chlorine_action_taken" value ="@if($errors->any()){{old('end_date')}}@else{{$task->end_date}}@endif" class="form-control" type="text">
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
															<input id="salt-form-radio-2" class="magic-radio" type="radio" name="salt" value = "1" @if($errors->any()) @if(old('salt') == '1') checked @endif @else @if($maintenance->salt == '1') checked @endif @endif>
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
										<input id="demo-checkbox-2" class="magic-checkbox" type="checkbox" name="equipment[]" value="pump"  @if(in_array("pump", $equipment_array)) checked @endif >
										<label for="demo-checkbox-2">Pump</label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-3" class="magic-checkbox" type="checkbox" name="equipment[]" value="filter"  @if(in_array("filter", $equipment_array)) checked @endif  >
										<label for="demo-checkbox-3">Filter </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-4" class="magic-checkbox" type="checkbox" name="equipment[]" value="heater"   @if(in_array("heater", $equipment_array)) checked @endif >
										<label for="demo-checkbox-4">Heater</label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-5" class="magic-checkbox" type="checkbox" name="equipment[]" value="heat_pump"  @if(in_array("heat_pump", $equipment_array)) checked  @endif>
										<label for="demo-checkbox-5">Heat pump</label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-6" class="magic-checkbox" type="checkbox" name="equipment[]" value="salt_chlorinator_system"  @if(in_array("salt_chlorinator_system", $equipment_array)) checked  @endif>
										<label for="demo-checkbox-6">Salt chlorinator system </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-7" class="magic-checkbox" type="checkbox" name="equipment[]" value="pool_light"  @if(in_array("pool_light", $equipment_array)) checked @endif  >
										<label for="demo-checkbox-7">Pool light (s) </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-8" class="magic-checkbox" type="checkbox" name="equipment[]" value="spa_light"  @if(in_array("spa_light", $equipment_array)) checked @endif >
										<label for="demo-checkbox-8"> Spa light (s) </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-9" class="magic-checkbox" type="checkbox" name="equipment[]" value="automation_system"  @if(in_array("automation_system", $equipment_array)) checked  @endif>
										<label for="demo-checkbox-9"> Automation system  </label>
									</div> 
									<div class="checkbox">
										<input id="demo-checkbox-1" class="magic-checkbox" type="checkbox" name="equipment[]" value="other"  @if(in_array("other", $equipment_array)) checked @endif>
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
										<input id="checkbox-2" class="magic-checkbox" type="checkbox" name="poolowner[]" value="clean"   @if(in_array("clean", $poolowner_array)) checked @endif>
										<label for="checkbox-2">Please clean filter </label>
									</div> 
									<div class="checkbox">
										<input id="checkbox-3" class="magic-checkbox" type="checkbox" name="poolowner[]" value="waterto"  @if(in_array("waterto", $poolowner_array)) checked @endif>
										<label for="checkbox-3">Please add water to pool  </label>
									</div> 
									<div class="checkbox">
										<input id="checkbox-4" class="magic-checkbox" type="checkbox" name="poolowner[]" value="waterfrom"  @if(in_array("waterfrom", $poolowner_array)) checked @endif >
										<label for="checkbox-4">Please drain excess water from pool </label>
									</div>
									<div class="checkbox">
										<input id="checkbox-5" class="magic-checkbox" type="checkbox" name="poolowner[]" value="other"  @if(in_array("other", $poolowner_array)) checked @endif  >
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
							<input type = "hidden" class = "savesend" name = "savesend"> 
							<div class="form-group">
								<div class = "col-md-1"> </div>
								<div class="col-md-11">
									<textarea placeholder="" name = "pool_comments" class="form-control" type="text">@if($errors->any()){{old('pool_comments')}}@else{{$maintenance->pool_comments}}@endif</textarea> 
								</div>
							</div>
							 
							<div class="form-group">   
								<div class="col-md-12 text-center">   
									<button type = "button" class="btn btn-mint submitdata save">SAVE</button> 
									<button type = "button" class="btn btn-danger submitdata send">COMPLETE</button> 
								</div>
							</div>
							{{csrf_field()}} 
						</form>
					</div> 
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
	<script> 
		$('#demo-tp-com').timepicker({defaultTime: '{!! $time !!}'});  
		$('#demo-dp-component .input-group.date').datepicker({
				format: "yyyy-mm-dd",
				todayBtn: "linked",
				autoclose: true,
				todayHighlight: true
		});
		
		$(".submitdata").click(function(){
			if($(this).hasClass('save')){
				$(".savesend").val(0);
				$(".form-horizontal").submit();
			}
			
			if($(this).hasClass('send')){
				$(".savesend").val(1);
				$(".form-horizontal").submit();
			}
		});
		
		
	</script> 
	@endpush	
	
	
@endsection
