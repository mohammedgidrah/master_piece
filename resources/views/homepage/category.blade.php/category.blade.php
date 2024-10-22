 <section class="category_section">
    <div>
        <h1 class="category_heading">Our Categories</h1>
    </div>
</section>

<div class="All_category">
    @if ($categories->isEmpty())
        <p>No categories found.</p>
    @else
        @foreach ($categories as $category)
            <div class="category_card">
                <h3 class="category_name">{{ $category->name }}</h3>
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                    class="category_img" />
                <a class="category_link" href="{{ route('category.products', $category->id) }}">More details</a>
            </div>
        @endforeach
    @endif
</div>
</section>




 