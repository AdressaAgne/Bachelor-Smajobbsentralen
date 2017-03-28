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
	<div class="col-6">
		<h3>Mars</h3>
		<div class="col-12 dagsOversikt">
			<h2>Tirsdag</h2>

			<div class="row dag">
				<div class="col-1 col-m-12">
					<p>28</p>
				</div>
				<div class="col-9 col-m-12 midt">
					<p>heisann snerkefjes</p>
				</div>
				<div class="col-2 col-m-12">
					<button class="btn">info</button>
				</div>
			</div>

			<div class="row dag">
				<div class="col-1 col-m-12">
					<p>28</p>
				</div>
				<div class="col-9 col-m-12 midt">
					<p>heisann snerkefjes</p>
				</div>
				<div class="col-2 col-m-12">
					<button class="btn">info</button>
				</div>
			</div>

			<div class="row dag">
				<div class="col-1 col-m-12">
					<p>28</p>
				</div>
				<div class="col-9 col-m-12 midt">
					<p>heisann snerkefjes</p>
				</div>
				<div class="col-2 col-m-12">
					<button class="btn">info</button>
				</div>
			</div>

		</div>
	</div>
	<div class="col-6">
		<h3>April</h3>
		<div class="col-12 dagsOversikt">
			<h2>Torsdag</h2>

			<div class="row dag">
				<div class="col-1 col-m-12">
					<p>2</p>
				</div>
				<div class="col-9 col-m-12 midt">
					<p>heisann</p>
				</div>
				<div class="col-2 col-m-12">
					<button class="btn">info</button>
				</div>
			</div>

			<div class="row dag">
				<div class="col-1 col-m-12">
					<p>2</p>
				</div>
				<div class="col-9 col-m-12 midt">
					<p>heisann</p>
				</div>
				<div class="col-2 col-m-12">
					<button class="btn">info</button>
				</div>
			</div>

			<div class="row dag">
				<div class="col-1 col-m-12">
					<p>2</p>
				</div>
				<div class="col-9 col-m-12 midt">
					<p>heisann</p>
				</div>
				<div class="col-2 col-m-12">
					<button class="btn">info</button>
				</div>
			</div>

		</div>
	</div>
</div>
