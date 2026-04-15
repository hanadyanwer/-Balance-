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

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="breakfast"
                data-ingredients="1 cup Rolled Oats, 1 cup Almond Milk, 1 tbsp Chia Seeds, آ½ cup Fresh Blueberries, 1 tsp Honey"
                data-nutrition="Cals: 320 | Protein: 10g | Carbs: 45g | Fats: 7g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/altumcode-BT-Cx1n1LXA-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase shadow-sm">Breakfast</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Blueberry Oatmeal</h3>
                <p class="text-sm text-slate-500 mb-6 line-clamp-2 italic text-balance text-description">Creamy oats
                    topped with fresh antioxidants.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-primary"></i> 10m</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-fire text-primary"></i> 320
                        kcal</span>
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

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="breakfast"
                data-ingredients="2 Large Eggs, 1 cup Fresh Spinach, 20g Feta Cheese, 1 slice Whole-wheat toast, Black pepper"
                data-nutrition="Cals: 280 | Protein: 18g | Carbs: 15g | Fats: 14g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/alimentos-fotogenicos-I7-KczdRauI-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Breakfast</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Spinach Omelet</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Protein-packed omelet with fresh spinach.
                </p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 15m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 280 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="breakfast"
                data-ingredients="200g Greek Yogurt, 30g Low-sugar Granola, 1 tsp Honey, 5 Fresh Strawberries"
                data-nutrition="Cals: 250 | Protein: 15g | Carbs: 30g | Fats: 5g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/alondra-lucia-VnXAdRS6Yt4-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Breakfast</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Yogurt Parfait</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Layers of creamy yogurt and crunchy
                    granola.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 5m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 250 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="breakfast"
                data-ingredients="1 slice Sourdough Bread, آ½ Ripe Avocado, Chili Flakes, 1 tsp Lemon juice, Sea salt"
                data-nutrition="Cals: 310 | Protein: 8g | Carbs: 35g | Fats: 18g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/imad-786-w1NiWDrp68M-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Breakfast</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Avocado Toast</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Classic smashed avocado on sourdough
                    bread.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 8m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 310 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="breakfast"
                data-ingredients="1 Ripe Banana, 2 Eggs, آ½ tsp Cinnamon, 1 tbsp Maple Syrup, Coconut Oil for cooking"
                data-nutrition="Cals: 290 | Protein: 12g | Carbs: 40g | Fats: 10g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/eiliv-aceron-exyTIrXyqm0-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Breakfast</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Banana Pancakes</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Fluffy pancakes with only natural sugars.
                </p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 20m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 290 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="lunch"
                data-ingredients="150g Chicken Breast, آ½ cup Cooked Quinoa, 1 cup Steamed Broccoli, 1 clove Garlic, Lemon Tahini dressing"
                data-nutrition="Cals: 450 | Protein: 40g | Carbs: 40g | Fats: 12g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/sumit-bhatia-g7WrssBb1Ak-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Lunch</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Grilled Chicken Bowl</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Healthy grain bowl with lean protein.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 30m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 450 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="lunch"
                data-ingredients="120g Salmon Fillet, 1 bunch Asparagus, 1 slice Lemon, 1 tbsp Olive Oil, Dried Dill"
                data-nutrition="Cals: 400 | Protein: 35g | Carbs: 5g | Fats: 22g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/thembi-johnson-HIFIN24HB7k-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Lunch</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Baked Salmon</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Omega-3 rich salmon with roasted
                    asparagus.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 25m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 400 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="lunch"
                data-ingredients="آ½ cup Chickpeas, 1 Cucumber, 1 Tomato, Fresh Parsley, Olive oil & Vinegar"
                data-nutrition="Cals: 320 | Protein: 12g | Carbs: 45g | Fats: 9g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/declan-sun-TsPlj-rqU9g-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Lunch</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Mediterranean Salad</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Refreshing salad with chickpeas and
                    herbs.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 15m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 320 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="lunch"
                data-ingredients="آ½ cup Brown Lentils, 1 Carrot, 1 stalk Celery, Cumin, Turmeric, Vegetable broth"
                data-nutrition="Cals: 280 | Protein: 18g | Carbs: 40g | Fats: 4g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/elena-leya-_jyB1ndDFQE-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Lunch</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Lentil Soup</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Hearty and warming vegetable lentil soup.
                </p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 40m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 280 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="dinner"
                data-ingredients="80g Whole-wheat pasta, 1 cup Cherry Tomatoes, Fresh Basil leaves, 1 tsp Olive oil, Parmesan"
                data-nutrition="Cals: 350 | Protein: 12g | Carbs: 60g | Fats: 8g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/karolina-kolodziejczak-Qf-gqJSWFYQ-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Dinner</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Tomato Basil Pasta</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Simple Italian pasta with fresh
                    ingredients.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 15m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 350 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="dinner"
                data-ingredients="1 Medium Sweet Potato, آ½ cup Black Beans, آ¼ cup Corn, 1 tsp Lime juice, Fresh Cilantro"
                data-nutrition="Cals: 300 | Protein: 10g | Carbs: 55g | Fats: 2g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/david-todd-mccarty-IzJTWRzipGc-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Dinner</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Stuffed Sweet Potato</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Baked potato filled with black beans and
                    corn.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 45m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 300 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="dinner"
                data-ingredients="150g Shrimp, 2 cups Cauliflower rice, آ¼ cup Peas, آ¼ cup Diced Carrots, Soy sauce (Low sodium)"
                data-nutrition="Cals: 250 | Protein: 25g | Carbs: 10g | Fats: 6g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/diego-arenas-de-rodrigo-kPAhQN-vxYg-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Dinner</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Shrimp "Rice"</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Low-carb dinner with cauliflower rice.
                </p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 20m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 250 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="dinner"
                data-ingredients="200g Firm Tofu, 2 cups Mixed Greens, 1 tbsp Sesame seeds, آ½ Avocado, Ginger dressing"
                data-nutrition="Cals: 270 | Protein: 20g | Carbs: 12g | Fats: 15g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/pexels-cottonbro-3297367.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Dinner</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Tofu Buddha Bowl</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Plant-based bowl with crispy tofu cubes.
                </p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 25m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 270 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="snack" data-ingredients="1 Medium Apple, 1 tbsp Natural Peanut Butter, Dash of Cinnamon"
                data-nutrition="Cals: 180 | Protein: 4g | Carbs: 20g | Fats: 8g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/cgdsro-food-3126525_1280.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Snack</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Apple & Nut Butter</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Simple snack for quick energy boost.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 3m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 180 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="snack" data-ingredients="10 Raw Almonds, 3 Walnuts, 5 Cashews (Unsalted)"
                data-nutrition="Cals: 160 | Protein: 5g | Carbs: 6g | Fats: 14g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/maksim-shutov-pUa1On18Jno-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Snack</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Mixed Nuts</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Handful of healthy fats and protein.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 1m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 160 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="snack"
                data-ingredients="1 cup Baby Carrots, 2 tbsp Traditional Hummus, Extra virgin olive oil"
                data-nutrition="Cals: 120 | Protein: 3g | Carbs: 15g | Fats: 6g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/corey-watson-ArGWd4sK6RM-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Snack</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Carrots & Hummus</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Crunchy carrots with smooth chickpea dip.
                </p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 2m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 120 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="snack" data-ingredients="آ½ cup Low-fat Cottage Cheese, آ½ cup Fresh Pineapple chunks"
                data-nutrition="Cals: 140 | Protein: 12g | Carbs: 10g | Fats: 2g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/andrew-molyneaux-X00aKdald68-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Snack</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Pineapple Cottage Cheese</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Sweet and salty high-protein snack.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 4m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 140 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

            <div class="card group bg-white p-5 rounded-4xl border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2"
                data-category="snack" data-ingredients="2 squares (20g) Dark Chocolate (85% Cocoa), Pinch of Sea Salt"
                data-nutrition="Cals: 150 | Protein: 2g | Carbs: 12g | Fats: 11g">
                <div class="relative h-48 overflow-hidden rounded-3xl mb-5">
                    <img src="../images/tetiana-bykovets-YemxYB75xvI-unsplash.jpg"
                        class="w-full h-full object-cover group-hover:scale-110 duration-700 transition">
                    <span
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase">Snack</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Dark Chocolate</h3>
                <p class="text-sm text-slate-500 mb-6 italic text-description">Two squares of 85% dark chocolate.</p>
                <div class="flex gap-4 text-xs font-bold text-slate-400 mb-6">
                    <span><i class="fa-regular fa-clock text-primary mr-1"></i> 1m</span>
                    <span><i class="fa-solid fa-fire text-primary mr-1"></i> 150 kcal</span>
                </div>
                <div class="flex gap-3">
                    <button
                        class="view-btn flex-1 bg-primary text-white py-3.5 rounded-2xl font-bold hover:bg-primaryDark transition shadow-lg shadow-primary/20">View
                        Recipe</button>
                    <button
                        class="heart w-12 h-12 flex items-center justify-center border border-slate-100 rounded-2xl text-slate-300 hover:text-red-500 transition-all"><i
                            class="fa-solid fa-heart"></i></button>
                </div>
            </div>

        </div>
    </section>
@endsection
