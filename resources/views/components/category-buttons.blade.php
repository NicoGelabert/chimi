<?php
    /** @var \Illuminate\Database\Eloquent\Collection $categories */
    ?>
<div class="px-5 max-w-screen-xl mx-auto flex justify-evenly items-center my-20">
            <div id="categoryimagesection" class="hidden sm:inline-block mix-blend-multiply max-w-[350px] lg:w-3/5">
                <img src="{{ asset('storage/img/muffins.png') }}" alt="">
            </div>
            <div id="categorybuttons">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.view', $category->slug) }}" class="" alt="">
                        <img src="{{ $category -> icon }}" class="" alt="tartas" />
                        <h5>{{$category -> name}}</h5>
                    </a>
                @endforeach
            </div>
        </div>

<script>
    const buttonsContainer = document.getElementById("categorybuttons");
    const childrenButtons = buttonsContainer.querySelectorAll("a")
    childrenButtons.forEach((item,index) =>{
        ((index > 0 && index < 3) || (index > 4 && index < 7)) ? item.classList.add('btn-primary') : item.classList.add('btn-secondary');
    })

</script>