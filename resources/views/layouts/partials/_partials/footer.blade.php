<footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
	<div class="row justify-content-between">
		<span class="pusll-right">
			<b>Copyright &copy; {{ date('Y') }}. {!! config('template.credits') !!}</b>. <span class="d-none d-lg-block d-xl-none">All rights reserved.</span>
		</span>
		<span class="pull-left d-none d-lg-block d-xl-none">
			<b>Version</b> {{ config('template.version') }} | Time: <b>{{ round(microtime(true) - LARAVEL_START, 6) }}s</b>
		</span>
	</div>
</footer>