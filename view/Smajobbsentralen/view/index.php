@layout('layout.head', ['title' => $page->header])
    
    <!-- check if the selected page has a controller with it -->
    @if(isset($class))
        @layout('pages.'.$page->style, ['page' => $page, 'class' => $class])
    @else
        @layout('pages.'.$page->style, ['page' => $page])
    @endif
    
@layout('layout.foot')