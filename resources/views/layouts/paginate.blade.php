<ul class="paginate">
    <li class="arrow-paginate">
        <a href="{{ ($blogs->url($blogs->onFirstPage())) }}">
            <i class="fa-solid fa-angle-left"></i>
        </a>
    </li>
    @for ($i = 1; $i <= $numberPage; $i++)
        <li @if ($i == $blogs->currentPage()) class="paginate-active" @endif>
            <a href="{{ ($blogs->url($i)) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="arrow-paginate">
        <a href="{{ $blogs->url($blogs->lastPage()) }}">
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </li>
{{-- {{ $blogs->links() }} --}}
</ul>
