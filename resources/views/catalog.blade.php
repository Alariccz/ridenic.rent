<x-front-layout>
    <section class="bg-darkGrey min-h-screen py-[60px] md:py-[100px]" id="catalogCars">
        <div class="container relative">
            <header class="mb-[40px] text-center" data-aos="fade-up">
                <h2 class="font-bold text-dark text-[28px] md:text-[36px] mb-2">
                    Catalog Mobil
                </h2>
                <p class="text-base text-secondary">Pilih mobil berdasarkan brand yang kamu suka!</p>
            </header>

            <!-- Filter Brand -->
            <div class="flex justify-center gap-3 flex-wrap mb-10" data-aos="fade-up" data-aos-delay="100">
                <button class="bg-primary text-white px-6 py-2.5 rounded-full text-sm font-semibold transition filter-btn active shadow-sm"
                    data-brand="all">
                    Semua Brand
                </button>
                @foreach($brands as $brand)
                    <button class="bg-white text-secondary hover:bg-primary hover:text-white transition px-6 py-2.5 rounded-full text-sm font-semibold filter-btn shadow-sm"
                        data-brand="{{ $brand->name }}">
                        {{ $brand->name }}
                    </button>
                @endforeach
            </div>

            <!-- List Mobil (Popular Cars Card Style) -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-[29px]" id="car-list" data-aos="fade-up" data-aos-delay="200">
                @forelse($items as $item)
                    <!-- Card -->
                    <div class="car-item card-popular" data-brand="{{ $item->brand->name ?? 'Tanpa Brand' }}">
                        <div>
                            <h5 class="text-lg text-dark font-bold mb-[2px]">
                                {{ $item->name }}
                            </h5>
                            <p class="text-sm font-normal text-secondary">
                                {{ $item->type ? $item->type->name : '-' }}
                            </p>
                            <a href="{{ route('front.detail', $item->slug) }}" class="absolute inset-0"></a>
                        </div>
                        <img src="{{ $item->thumbnail }}" class="rounded-[18px] min-w-[216px] w-full h-[150px] object-cover" alt="{{ $item->name }}">
                        <div class="flex items-center justify-between gap-1">
                            <!-- Price -->
                            <p class="text-sm font-normal text-secondary">
                                <span class="text-base font-bold text-primary">Rp {{ $item->price }}</span>/day
                            </p>
                            <!-- Rating -->
                            <p class="text-dark text-xs font-semibold flex items-center gap-[2px]">
                                ({{ $item->star }}/5)
                                <img src="/svgs/ic-star.svg" alt="">
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-secondary text-base">Tidak ada mobil tersedia.</div>
                @endforelse
            </div>

            <!-- Empty State for Filter -->
            <div id="empty-state" class="hidden text-center py-16">
                <p class="text-secondary text-base">Mobil tidak ditemukan untuk brand tersebut.</p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.filter-btn');
            const cars = document.querySelectorAll('.car-item');
            const emptyState = document.getElementById('empty-state');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Reset styling semua button
                    buttons.forEach(b => {
                        b.classList.remove('bg-primary', 'text-white', 'active');
                        b.classList.add('bg-white', 'text-secondary');
                    });

                    // Set button aktif
                    btn.classList.remove('bg-white', 'text-secondary');
                    btn.classList.add('bg-primary', 'text-white', 'active');

                    const brand = btn.getAttribute('data-brand');
                    let visible = 0;

                    cars.forEach(car => {
                        if (brand === 'all' || car.getAttribute('data-brand') === brand) {
                            car.style.display = 'flex';
                            visible++;
                        } else {
                            car.style.display = 'none';
                        }
                    });

                    if (visible === 0) {
                        emptyState.classList.remove('hidden');
                    } else {
                        emptyState.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-front-layout>
