@layout('layout.head', ['title' => 'Småjobbsentralen'])
<div class="row">
	<h1>Telefonvakt Framside</h1>
</div>
@layout('layout.telefonvakt_menu')
<!-- TODO loop igjennom fra backend. Evt vurder table istedet -->

	<div class="row">

			<div class="col-3 font-left">
				<a href="/telefonvakt/{{$prev_month}}/{{$prev_year}}" class="btn"> <i class="fa fa-arrow-left"></i> Forrige måned</a>
			</div>

			<div class="col-6 font-center">{{$global->month_to_str($month)}} {{$year}}</div> <!-- TODO månednavn -->

			<div class="col-3 font-right">
				<a href="/telefonvakt/{{$next_month}}/{{$next_year}}" class="btn">Neste måned <i class="fa fa-arrow-right"></i></a>
			</div>


		<div class="calendar-modal" style="display:none;"></div>

		<div class="col-12">
			@for($i = 1; $i < 8; $i++)
				<div class="cal-1 calendar calendar--header">
					{{$global->day_to_str($i)}}
				</div>
			@endfor

			@foreach($calendar as $key => $cal)
				<div class="cal-1 calendar calendar--{{$cal['class']}}">
					<div class="calendar--date" data-date="{{$cal['date']}}" data-nameid="{{$cal['work']['id']}}" data-name="{{$cal['work']['name']}}" data-description="{{$cal['work']['description']}}" data-day="{{$cal['day']}}" data-month="{{ $month }}" data-year="{{ $year }}" data-name="{{$cal['work']['name']}}" data-surname="{{$cal['work']['surname']}}">{{$cal['date']}}</div>
					<p>{{ isset($cal['work']['name']) ? $cal['work']['name']." ".$cal['work']['surname'] : '' }}</p>
					<p>{{ isset($cal['holy']) ? $cal['holy'] : "" }}</p>
				</div>
				@if($key % 7 == 6)
					<div class="cal-7 calendar--edit">
						<div class="calendar--date exit">&times;</div>
						<h2><span class="date">{{$cal['date']}}</span>. <span class="month">{{$global->month_to_str($month)}}</span> <span class="year">{{$year}}</span></h2>
						@form('', 'PUT')
							<div class="form-element col-12">

								<label>Navn
									
									<select class="" name="user_id">
										<option value="" class="selected_option">Velg et Navn</option>
										<option value="">Ingen</option>
										@foreach($global->users() as $u)
											<option value="{{$u->id}}">{{$u->name}} {{$u->surname}}</option>
										@endforeach
									</select>
								</label>
								<label>Annet
									<textarea name="desc" rows="8" cols="80"></textarea>
								</label>
							</div>

							<div class="form-element col-12">
								<input type="hidden" name="day" value="{{$cal['date']}}">
								<input type="hidden" name="month" value="{{$month}}">
								<input type="hidden" name="year" value="{{$year}}">
								<input type="submit" value="Rediger">
							</div>
						@formend()
					</div>
				@endif
			@endforeach
			<div class="cal-7 calendar--edit">
				<div class="calendar--date exit">&times;</div>
				<h2><span class="date">{{$cal['date']}}</span>. <span class="month">{{$global->month_to_str($month)}}</span> <span class="year">{{$year}}</span></h2>
				@form('', 'PUT')
					<div class="form-element col-12">
						<label>Navn
							<select class="" name="user_id">
								<option value="" class="selected_option">Navn</option>
								<option value="">Ingen</option>
								@foreach($global->users() as $u)
									<option value="{{$u->id}}">{{$u->name}} {{$u->surname}}</option>
								@endforeach
							</select>
						</label>
						<label>Annet
							<textarea name="desc" rows="8" cols="80"></textarea>
						</label>
					</div>

					<div class="form-element col-12">
						<input type="hidden" name="day" value="{{$cal['date']}}">
						<input type="hidden" name="month" value="{{$month}}">
						<input type="hidden" name="year" value="{{$year}}">
						<input type="submit" value="Rediger">
					</div>
				@formend()
			</div>
		</div>
	</div>
@layout('layout.scripts')
	<script>
	var cal = $('.calendar--holy, .calendar--normal, .calendar--current');
		$(cal).on('click', function(e){

			var form = $(this).nextAll('.cal-7').first();

			if($(this).hasClass('calendar--active')){
				$(this).removeClass('calendar--active');
				$(form).slideUp();
				return;
			}


			var form_name = $(form).find('[name=name]');
			var form_info = $(form).find('[name=desc]');
			var form_date = $(form).find('.date');
			
			var form_select = $(form).find('option.selected_option');
			var form_desc = $(form).find('textarea');
	
			$(cal).removeClass('calendar--active');

			$('.cal-7').not(form).slideUp();

			var div    = $(this).find("div");
			var name    = $(div).data("name");
			var surname = $(div).data("surname");
			var date    = $(div).data("date");
			var name_id    = $(div).data("nameid");
			var description    = $(div).data("description");
			
			var day    = $(form).find("[name=day]");
			var month  = $(form).find("[name=month]");
			var year   = $(form).find("[name=year]");

			
			$(day).val($(div).data('date'));
			$(month).val($(div).data('month'));
			$(year).val($(div).data('year'));
			
			$(form_desc).val(description);
			$(form_select).val(name_id);
			$(form_select).text(name + ' ' + surname);
			$(form).find('option').removeAttr('selected');
			$(form_select).attr('selected', 'selected')
			
			//todo: add stuff to form
			$(form_date).text(date);
			$(form_name).val(name + ' ' + surname);

			$(form).slideDown();
			$(this).addClass('calendar--active');

		});

		$(".exit").on('click', function(e){
			$(cal).removeClass('calendar--active');
			$('.calendar--edit').slideUp();
		});
	</script>
@layout('layout.foot')