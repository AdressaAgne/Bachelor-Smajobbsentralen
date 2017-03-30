<div class="row">
	@if(!empty($page->header))
		<h3>{{$page->header}}</h3>
	@endif
	@if(!empty($page->content))
		<h1>{{$page->content}}</h1>
	@endif
</div>
@layout('layout.telefonvakt_menu')
<!-- TODO loop igjennom fra backend. Evt vurder table istedet -->
	<div class="row">
		@form('', 'post')
			<div class="col-3 font-left">
				<input type="hidden" name="month" value="{{$class->month}}">
				<input type="hidden" name="year" value="{{$class->year}}">
				<button type="submit" id="prev" name="prev" class="btn"> <i class="fa fa-arrow-left"></i> Forrige måned</button>
			</div>

			<div class="col-6 font-center">{{$class->month_to_str($class->month)}} {{$class->year}}</div> <!-- TODO månednavn -->

			<div class="col-3 font-right">
				<button type="submit" id="next" name="next" class="btn">Neste måned <i class="fa fa-arrow-right"></i></button>
			</div>
		@formend()

		<div class="calendar-modal" style="display:none;"></div>

		<div class="col-12">
			@for($i = 1; $i < 8; $i++)
				<div class="cal-1 calendar calendar--header">
					{{$class->day_to_str($i)}}
				</div>
			@endfor

			@foreach($class->calendar() as $key => $cal)
				<div class="cal-1 calendar calendar--{{$cal['class']}}">
					<div class="calendar--date" data-date="{{$cal['date']}}" data-name="{{$cal['work']['name']}}" data-surname="{{$cal['work']['surname']}}">{{$cal['date']}}</div>
					<p>{{ isset($cal['work']['name']) ? $cal['work']['name'] : '' }}</p>
					<p>{{ isset($cal['holy']) ? $cal['holy'] : "" }}</p>
				</div>
				@if($key % 7 == 6)
					<div class="cal-7 calendar--edit">
						<div class="calendar--date exit">&times;</div>
						<h2><span class="date">{{$cal['date']}}</span>. <span class="month">{{$class->month_to_str($class->month)}}</span> <span class="year">{{$class->year}}</span></h2>
						@form('', 'PUT')
							<div class="form-element col-12">

								<label>Navn
									<input type="text" name="name" placeholder="Navn">
								</label>
								<label>Annet
									<textarea name="annet" rows="8" cols="80"></textarea>
								</label>
							</div>

							<div class="form-element col-12">
								<input type="hidden" name="date" value="{{$cal['date']}}">
								<input type="hidden" name="month" value="{{$class->month}}">
								<input type="hidden" name="year" value="{{$class->year}}">
								<input type="submit" value="Rediger">
							</div>
						@formend()
					</div>
				@endif
			@endforeach
			<div class="cal-7 calendar--edit">
				<h2><span class="date">{{$cal['date']}}</span>. <span class="month">{{$class->month_to_str($class->month)}}</span> <span class="year">{{$class->year}}</span></h2>
				@form('', 'PUT')
					<div class="form-element col-12">

						<label>Navn
							<input type="text" name="name" placeholder="Navn">
						</label>
						<label>Annet
							<textarea name="annet" rows="8" cols="80"></textarea>
						</label>
					</div>

					<div class="form-element col-12">
						<input type="hidden" name="date" value="{{$cal['date']}}">
						<input type="hidden" name="month" value="{{$class->month}}">
						<input type="hidden" name="year" value="{{$class->year}}">
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
			var form_info = $(form).find('[name=annet]');
			var form_date = $(form).find('.date');

			$(cal).removeClass('calendar--active');

			$('.cal-7').not(form).slideUp();

			var name    = $(this).find("div").data("name");
			var surname = $(this).find("div").data("surname");
			var date    = $(this).find("div").data("date");
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
