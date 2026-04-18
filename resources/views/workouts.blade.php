@extends('layouts.app')

@section('title', 'Training Plans | Balance+')

@section('styles')
<style>
    .active-fav i {
        color: #ef4444 !important;
    }

    .active-fav {
        background-color: #fef2f2 !important;
        border-color: #fee2e2 !important;
    }
</style>
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12 flex-grow">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div>
                <h2 class="text-5xl font-black text-slate-900 tracking-tight mb-4">Training Plans</h2>
                <p class="text-slate-500 font-medium">Professional workouts designed for your fitness goals.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2 bg-white p-2 rounded-3xl border border-slate-200 shadow-sm">
                <button
                    class="filter active px-6 py-2.5 rounded-2xl text-sm font-bold transition-all bg-primary text-white"
                    data-filter="all">All</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="beginner">Beginner</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="intermediate">Intermediate</button>
                <button
                    class="filter px-6 py-2.5 rounded-2xl text-sm font-bold text-slate-500 transition-all hover:bg-slate-50"
                    data-filter="advanced">Advanced</button>
                <button
                    class="filter w-12 h-12 flex items-center justify-center rounded-2xl text-red-400 border border-transparent hover:border-red-100 hover:bg-red-50 transition-all"
                    data-filter="favorites">
                    <i class="fa-solid fa-heart text-lg"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="workoutsGrid">

            @foreach($workouts as $workout)
            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300"
                data-category="{{ $workout->difficulty }}"
                data-name="{{ $workout->name }}"
                data-desc="{{ $workout->description ?? 'Effective training program.' }}"
                data-duration="{{ $workout->duration ?? 'N/A' }}"
                data-calories="{{ $workout->calories_burned ?? 'N/A' }}"
                data-equipment="{{ $workout->equipment ?? 'No equipment needed' }}"
                data-instructions="{{ $workout->instructions ?? 'Follow along with the workout routine.' }}"
                data-video="{{ $workout->video_url ?? '' }}">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5 flex items-center justify-center group"
                    style="background: linear-gradient(135deg, {{ $workout->difficulty == 'beginner' ? '#e0f2fe, #bae6fd' : ($workout->difficulty == 'intermediate' ? '#fed7aa, #fdba74' : '#fecaca, #fca5a5') }})">
                    <span class="text-6xl group-hover:scale-110 transition duration-700">
                        @if($workout->type == 'cardio')
                            🏃
                        @elseif($workout->type == 'strength')
                            🏋️
                        @elseif($workout->type == 'flexibility')
                            🧘
                        @elseif($workout->type == 'hiit')
                            🔥
                        @else
                            💪
                        @endif
                    </span>
                    @if($workout->video_url)
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-play text-primary text-2xl ml-1"></i>
                        </div>
                    </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm z-10">{{ $workout->difficulty }}</span>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ $workout->name }}</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic">{{ $workout->description ?? 'Effective training program.' }}</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> {{ $workout->duration ?? 'N/A' }}m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> {{ $workout->calories_burned ?? 'N/A' }} kcal</span>
                </div>
                <div class="flex items-center gap-3">
                    <button class="view-plan-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View Plan</button>
                    <button class="heart-btn w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 hover:bg-red-50 transition-all"><i class="fa-solid fa-heart text-xl"></i></button>
                </div>
            </div>
            @endforeach

        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Load favorites from localStorage
    const savedFavorites = JSON.parse(localStorage.getItem('workoutFavorites') || '[]');

    // Apply saved favorites
    document.querySelectorAll('.card').forEach((card, index) => {
        const workoutName = card.dataset.name;
        if (savedFavorites.includes(workoutName)) {
            card.querySelector('.heart-btn').classList.add('active-fav');
        }
    });

    // Filter functionality
    document.querySelectorAll('.filter').forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            // Handle favorites filter separately
            if (filter === 'favorites') {
                const favCards = document.querySelectorAll('.card .heart-btn.active-fav');

                if (favCards.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No Favorites Yet',
                        text: 'Add workouts to favorites by clicking the heart icon!',
                        confirmButtonColor: '#0B6B7A'
                    });
                    return;
                }

                document.querySelectorAll('.card').forEach(card => {
                    const heartBtn = card.querySelector('.heart-btn');
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

    // View plan button
    document.querySelectorAll('.view-plan-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.card');
            const name = card.dataset.name;
            const desc = card.dataset.desc;
            const duration = card.dataset.duration;
            const calories = card.dataset.calories;
            const equipment = card.dataset.equipment;
            const instructions = card.dataset.instructions;
            const videoUrl = card.dataset.video;

            Swal.fire({
                title: `<strong class="text-primary">${name}</strong>`,
                html: `
                    <div class="text-left space-y-4">
                        <p class="text-sm text-slate-600 italic">${desc}</p>

                        <div class="grid grid-cols-2 gap-4 p-4 bg-slate-50 rounded-2xl">
                            <div class="text-center">
                                <i class="fa-regular fa-clock text-primary text-xl mb-2"></i>
                                <p class="text-xs text-slate-400 font-bold uppercase">Duration</p>
                                <p class="text-lg font-black text-slate-800">${duration} min</p>
                            </div>
                            <div class="text-center">
                                <i class="fa-solid fa-fire text-orange-500 text-xl mb-2"></i>
                                <p class="text-xs text-slate-400 font-bold uppercase">Calories</p>
                                <p class="text-lg font-black text-slate-800">${calories} kcal</p>
                            </div>
                        </div>

                        <div class="p-4 bg-blue-50 rounded-2xl">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fa-solid fa-dumbbell text-primary"></i>
                                <p class="text-xs font-bold text-slate-700 uppercase">Equipment Needed</p>
                            </div>
                            <p class="text-sm text-slate-600">${equipment}</p>
                        </div>

                        <div class="p-4 bg-emerald-50 rounded-2xl">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fa-solid fa-list-check text-emerald-600"></i>
                                <p class="text-xs font-bold text-slate-700 uppercase">Instructions</p>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed">${instructions}</p>
                        </div>

                        ${videoUrl ? `
                        <div class="mt-6 p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-2xl text-center border-2 border-red-100">
                            <i class="fa-brands fa-youtube text-red-600 text-3xl mb-2"></i>
                            <p class="text-xs text-slate-600 mb-2">Follow along with the video tutorial</p>
                        </div>
                        ` : `
                        <div class="mt-6 p-4 border-2 border-dashed border-slate-200 rounded-2xl text-center">
                            <p class="text-xs text-slate-400">Ready to begin? Let's get moving! 💪</p>
                        </div>
                        `}
                    </div>
                `,
                width: 700,
                confirmButtonColor: '#0B6B7A',
                confirmButtonText: videoUrl ? '<i class="fa-solid fa-play mr-2"></i> Watch on YouTube' : '<i class="fa-solid fa-dumbbell mr-2"></i> Start Workout',
                showCancelButton: true,
                cancelButtonText: 'Close',
                cancelButtonColor: '#94A3B8'
            }).then((result) => {
                if (result.isConfirmed && videoUrl) {
                    window.open(videoUrl, '_blank');
                }
            });
        });
    });

    // Favorite button
    document.querySelectorAll('.heart-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('active-fav');

            const card = this.closest('.card');
            const workoutName = card.dataset.name;
            let favorites = JSON.parse(localStorage.getItem('workoutFavorites') || '[]');

            if (this.classList.contains('active-fav')) {
                if (!favorites.includes(workoutName)) {
                    favorites.push(workoutName);
                }
            } else {
                favorites = favorites.filter(name => name !== workoutName);
            }

            localStorage.setItem('workoutFavorites', JSON.stringify(favorites));
        });
    });
</script>
@endsection
