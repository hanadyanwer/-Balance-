@extends('layouts.app')

@section('title', 'Healthy Recipes | Balance+')

@section('styles')
<style>
    .heart.active-fav {
        color: #ef4444 !important;
        background-color: #fef2f2 !important;
        border-color: #fee2e2 !important;
    }

    .filter.active {
        background-color: #0B6B7A !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(11, 107, 122, 0.2);
    }

    .swal-no-padding .swal2-html-container {
        padding: 0 !important;
        margin: 0 !important;
        overflow: visible !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div>
                <h2 class="text-5xl font-black text-slate-900 tracking-tight mb-4">Our Healthy Menu</h2>
                <p class="text-slate-500 font-medium">Discover nutritious meals tailored for your lifestyle.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2 bg-white p-2 rounded-3xl border border-slate-200 shadow-sm">
                <button class="filter active px-6 py-2.5 rounded-2xl text-sm font-bold transition-all"
                    data-filter="all">All</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="breakfast">Breakfast</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="lunch">Lunch</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="dinner">Dinner</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="snack">Snack</button>
                <button
                    class="filter w-12 h-12 flex items-center justify-center rounded-2xl text-red-400 border border-transparent hover:border-red-100 hover:bg-red-50 transition-all"
                    data-filter="favorites">
                    <i class="fa-solid fa-heart text-lg"></i>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="recipesGrid">

            @foreach($recipes as $recipe)
            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="{{ $recipe->meal_type }}"
                data-name="{{ $recipe->name }}"
                data-image="{{ asset($recipe->image ?? 'images/healthy.jfif') }}"
                data-description="{{ $recipe->description ?? 'Delicious and healthy recipe.' }}"
                data-ingredients="{{ $recipe->ingredients ?? 'No ingredients listed' }}"
                data-instructions="{{ $recipe->instructions ?? 'Follow preparation steps.' }}"
                data-calories="{{ $recipe->calories ?? 'N/A' }}"
                data-protein="{{ $recipe->protein ?? 'N/A' }}"
                data-carbs="{{ $recipe->carbs ?? 'N/A' }}"
                data-fats="{{ $recipe->fats ?? 'N/A' }}"
                data-prep-time="{{ $recipe->prep_time ?? 'N/A' }}">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    @if($recipe->image)
                        <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary/10 to-primary/30 flex items-center justify-center">
                            <i class="fas fa-utensils text-5xl text-primary/40"></i>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">{{ $recipe->meal_type }}</span>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ $recipe->name }}</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic text-balance text-description">{{ $recipe->description ?? 'Delicious and healthy recipe.' }}</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> {{ $recipe->prep_time ?? 'N/A' }}m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> {{ $recipe->calories ?? 'N/A' }} kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20 active:scale-95">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>
            @endforeach

        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Load favorites from localStorage
    const savedFavorites = JSON.parse(localStorage.getItem('recipeFavorites') || '[]');

    // Apply saved favorites
    document.querySelectorAll('.card').forEach((card) => {
        const recipeName = card.querySelector('h3').textContent;
        if (savedFavorites.includes(recipeName)) {
            card.querySelector('.heart').classList.add('active-fav');
        }
    });

    // Update filter functionality to work with dynamic data
    document.querySelectorAll('.filter').forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            // Handle favorites filter separately
            if (filter === 'favorites') {
                const favCards = document.querySelectorAll('.card .heart.active-fav');

                if (favCards.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No Favorites Yet',
                        text: 'Add recipes to favorites by clicking the heart icon!',
                        confirmButtonColor: '#0B6B7A'
                    });
                    return;
                }

                document.querySelectorAll('.card').forEach(card => {
                    const heartBtn = card.querySelector('.heart');
                    if (heartBtn.classList.contains('active-fav')) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update active button (keep favorites button highlighted)
                document.querySelectorAll('.filter').forEach(b => {
                    if (b.dataset.filter !== 'favorites') {
                        b.classList.remove('active', 'bg-primary', 'text-white');
                        b.classList.add('text-slate-500');
                    }
                });
                this.style.backgroundColor = '#fef2f2';
                this.style.borderColor = '#fee2e2';
                return;
            }

            // Regular filters
            document.querySelectorAll('.filter').forEach(b => {
                b.classList.remove('active', 'bg-primary', 'text-white');
                b.classList.add('text-slate-500');
                if (b.dataset.filter === 'favorites') {
                    b.style.backgroundColor = '';
                    b.style.borderColor = '';
                }
            });
            this.classList.add('active', 'bg-primary', 'text-white');
            this.classList.remove('text-slate-500');

            // Filter cards
            document.querySelectorAll('.card').forEach(card => {
                const category = card.dataset.category;
                if (filter === 'all' || filter === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // View recipe button functionality
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.card');
            const recipeName = card.dataset.name;
            const recipeImage = card.dataset.image;
            const recipeDescription = card.dataset.description;
            const recipeIngredients = card.dataset.ingredients;
            const recipeInstructions = card.dataset.instructions;
            const recipeCalories = card.dataset.calories;
            const recipeProtein = card.dataset.protein;
            const recipeCarbs = card.dataset.carbs;
            const recipeFats = card.dataset.fats;
            const recipePrepTime = card.dataset.prepTime;

            Swal.fire({
                title: '',
                html: `
                    <div style="border: 3px solid #e2e8f0; border-radius: 1rem; background: white; overflow: hidden;">
                        <!-- Recipe Header with Image -->
                        <div style="position: relative; height: 140px; overflow: hidden;">
                            <img src="${recipeImage}" alt="${recipeName}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 0.75rem 1rem;">
                                <h2 style="color: white; font-size: 1.2rem; font-weight: 800; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">${recipeName}</h2>
                            </div>
                        </div>

                        <div style="padding: 1rem;">
                            <!-- Description -->
                            <p style="color: #64748b; font-size: 0.75rem; line-height: 1.4; text-align: center; margin: 0 0 0.75rem 0; padding-bottom: 0.75rem; border-bottom: 1px solid #e2e8f0;">${recipeDescription}</p>

                            <!-- Ingredients -->
                            <div style="background: #f8fafc; border: 2px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; margin-bottom: 0.65rem;">
                                <h3 style="color: #0B6B7A; font-size: 0.8rem; font-weight: 700; margin: 0 0 0.4rem 0; display: flex; align-items: center; gap: 0.3rem;">
                                    <i class="fa-solid fa-list-check" style="font-size: 0.75rem;"></i> Ingredients
                                </h3>
                                <ul style="color: #475569; font-size: 0.7rem; line-height: 1.5; margin: 0; padding-left: 1rem; list-style-type: disc;">
                                    ${recipeIngredients.split(',').map(item => `<li style="margin-bottom: 0.2rem;">${item.trim()}</li>`).join('')}
                                </ul>
                            </div>

                            <!-- Prep Time -->
                            <div style="background: #f1f5f9; border: 2px solid #cbd5e1; border-radius: 0.65rem; padding: 0.5rem; text-align: center; margin-bottom: 0.65rem;">
                                <i class="fa-solid fa-clock" style="color: #0B6B7A; font-size: 0.85rem;"></i>
                                <span style="color: #475569; font-weight: 600; margin-left: 0.3rem; font-size: 0.7rem;">${recipePrepTime} min</span>
                            </div>

                            <!-- Nutrition Facts -->
                            <div style="background: #e2e8f0; border: 2px solid #cbd5e1; border-radius: 0.65rem; padding: 0.6rem; margin-top: 0.65rem;">
                                <h3 style="color: #334155; font-size: 0.8rem; font-weight: 700; margin: 0 0 0.4rem 0; text-align: center;">
                                    <i class="fa-solid fa-chart-pie" style="color: #0B6B7A; font-size: 0.75rem;"></i> Nutrition Facts
                                </h3>
                                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.45rem;">
                                    <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                        <i class="fa-solid fa-fire" style="color: #f97316; font-size: 1rem;"></i>
                                        <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Cal</p>
                                        <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipeCalories}</p>
                                    </div>
                                    <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                        <i class="fa-solid fa-drumstick-bite" style="color: #dc2626; font-size: 1rem;"></i>
                                        <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Pro</p>
                                        <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipeProtein}g</p>
                                    </div>
                                    <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                        <i class="fa-solid fa-wheat-awn" style="color: #ca8a04; font-size: 1rem;"></i>
                                        <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Carbs</p>
                                        <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipeCarbs}g</p>
                                    </div>
                                    <div style="background: white; padding: 0.5rem; border-radius: 0.5rem; text-align: center; border: 2px solid #cbd5e1;">
                                        <i class="fa-solid fa-droplet" style="color: #eab308; font-size: 1rem;"></i>
                                        <p style="font-size: 0.6rem; color: #64748b; font-weight: 700; text-transform: uppercase; margin: 0.15rem 0;">Fats</p>
                                        <p style="font-weight: 900; color: #1e293b; font-size: 0.85rem; margin: 0;">${recipeFats}g</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Back to Menu Button -->
                            <div style="text-align: center; margin-top: 0.75rem;">
                                <button onclick="Swal.close()" style="background: #0B6B7A; color: white; padding: 0.55rem 1.75rem; border-radius: 0.6rem; border: none; font-weight: 700; font-size: 0.75rem; cursor: pointer; transition: all 0.3s; box-shadow: 0 2px 4px rgba(11, 107, 122, 0.2);" onmouseover="this.style.background='#094d56'" onmouseout="this.style.background='#0B6B7A'">
                                    <i class="fa-solid fa-arrow-left" style="margin-right: 0.35rem;"></i>Back to Menu
                                </button>
                            </div>
                        </div>
                    </div>
                `,
                width: 580,
                showConfirmButton: false,
                customClass: {
                    popup: 'swal-wide',
                    htmlContainer: 'swal-no-padding'
                }
            });
        });
    });

    // Favorite button functionality
    document.querySelectorAll('.heart').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('active-fav');

            const card = this.closest('.card');
            const recipeName = card.querySelector('h3').textContent;
            let favorites = JSON.parse(localStorage.getItem('recipeFavorites') || '[]');

            if (this.classList.contains('active-fav')) {
                if (!favorites.includes(recipeName)) {
                    favorites.push(recipeName);
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Favorites!',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                favorites = favorites.filter(name => name !== recipeName);
                Swal.fire({
                    icon: 'info',
                    title: 'Removed from Favorites',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            localStorage.setItem('recipeFavorites', JSON.stringify(favorites));
        });
    });
</script>
@endsection
