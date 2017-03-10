@layout('layout.head', ['title' => $page->header])
    
    @layout('pages.'.$page->style, ['page' => $page])
    
@layout('layout.foot')