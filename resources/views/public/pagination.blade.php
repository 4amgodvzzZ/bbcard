

@if ( $page && $page->lastPage() > 1)

<div class="admin-page">
	<div class="pagination paging"> 
		<span class="statistics">共有{{ $page->total() }}条，当前显示 : {{ $page->count() }}条</span>
		{{ $page->links() }}
	</div>
</div>

@endif