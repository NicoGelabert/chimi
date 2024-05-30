<div class="container flex flex-col gap-8 items-center">
    <div class="pretitle">
        <p>Faqs</p>
    </div>
    <h3 class="text-center">Preguntas Frecuentes</h3>
    <div class="flex flex-col gap-6 items-start md:flex-row md:flex-wrap md:px-0 md:gap-4">
    @foreach ($faqs as $faq)
            <div class="border rounded-xl pt-4 px-4 md:w-auto md:max-w-sm mx-auto" x-data="{expanded: false}">
                <div class="flex w-full justify-between items-baseline">
                    <p class="small-text subtitle">{{ $faq -> question}}</p>
                    <p class="text-right">
                        <a
                            @click="expanded = !expanded"
                            href="javascript:void(0)"
                        >
                            <svg class="shrink-0 fill-primary" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                <rect y="7" width="16" height="2" rx="1" class="transform origin-center transition duration-200 ease-out" :class="{'!rotate-180': expanded}" />
                                <rect y="7" width="16" height="2" rx="1" class="transform origin-center rotate-90 transition duration-200 ease-out" :class="{'!rotate-180': expanded}" />
                            </svg>
                        </a>
                    </p>
                </div>
                <div
                    x-show="expanded"
                    x-collapse.min.0
                    class="text-gray-500 wysiwyg-content pt-4"
                >
                    <p class="small-text font-light">{{ $faq -> answer}}</p>
                </div>
            </div>
            <hr class="w-full md:hidden" />
    @endforeach

    </div>
</div>