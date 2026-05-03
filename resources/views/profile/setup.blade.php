<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Goals - Balance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap');

        * {
            font-family: 'Cairo', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0B6B7A 0%, #0a5560 100%);
            min-height: 100vh;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .goal-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid transparent;
        }

        .goal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(11, 107, 122, 0.2);
        }

        .goal-card.selected {
            border-color: #0B6B7A;
            background: rgba(11, 107, 122, 0.05);
        }

        .goal-card.selected .goal-icon {
            color: #0B6B7A;
        }

        .progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0B6B7A 0%, #0dd3c5 100%);
            transition: width 0.3s ease;
        }

        .input-group {
            position: relative;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: #0B6B7A;
            box-shadow: 0 0 0 3px rgba(11, 107, 122, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0B6B7A 0%, #0dd3c5 100%);
            color: white;
            padding: 15px 40px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(11, 107, 122, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .animate-bounce-slow {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-white mb-4 animate-bounce-slow">
                <i class="fas fa-bullseye"></i> Choose Your Goals
            </h1>
            <p class="text-xl text-white opacity-90">Let's customize your wellness journey 🎯</p>
        </div>

        <!-- Progress Bar -->
        <div class="max-w-2xl mx-auto mb-8">
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill" style="width: 0%"></div>
            </div>
        </div>

        <!-- Form -->
        <div class="max-w-4xl mx-auto">
            <div class="card-glass p-8">
                <form action="{{ route('profile.setup.save') }}" method="POST" id="setupForm">
                    @csrf

                    <!-- Step 1: Basic Info -->
                    <div class="step" id="step1">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                            <i class="fas fa-user-circle text-[#0B6B7A]"></i>
                            Your Basic Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Weight -->
                            <div class="input-group">
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-weight text-[#0B6B7A]"></i> Weight (kg)
                                </label>
                                <input type="number" name="weight" id="weight" step="0.1" min="30" max="300"
                                       value="{{ old('weight', $user->weight) }}" required
                                       placeholder="e.g. 70">
                                @error('weight')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Height -->
                            <div class="input-group">
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-ruler-vertical text-[#0B6B7A]"></i> Height (cm)
                                </label>
                                <input type="number" name="height" id="height" step="0.1" min="100" max="250"
                                       value="{{ old('height', $user->height) }}" required
                                       placeholder="e.g. 170">
                                @error('height')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Age -->
                            <div class="input-group">
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-birthday-cake text-[#0B6B7A]"></i> Age
                                </label>
                                <input type="number" name="age" id="age" min="13" max="100"
                                       value="{{ old('age', $user->age) }}" required
                                       placeholder="e.g. 25">
                                @error('age')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="input-group">
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-venus-mars text-[#0B6B7A]"></i> Gender
                                </label>
                                <select name="gender" id="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center mt-8">
                            <button type="button" onclick="nextStep(2)" class="btn-primary">
                                Next <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Choose Goal -->
                    <div class="step hidden" id="step2">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                            <i class="fas fa-bullseye text-[#0B6B7A]"></i>
                            What's Your Health Goal?
                        </h2>

                        <input type="hidden" name="health_goal" id="health_goal" value="{{ old('health_goal') }}">

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <!-- Lose Weight -->
                            <div class="goal-card card-glass p-4 text-center" onclick="selectGoal('lose_weight', this)">
                                <div class="goal-icon text-4xl mb-4">🏃‍♂️</div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Lose Weight</h3>
                                <p class="text-sm text-gray-600">I want to lose weight and reach my ideal weight</p>
                            </div>

                            <!-- Gain Weight -->
                            <div class="goal-card card-glass p-4 text-center" onclick="selectGoal('gain_weight', this)">
                                <div class="goal-icon text-4xl mb-4">💪</div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Gain Weight</h3>
                                <p class="text-sm text-gray-600">I want to gain weight in a healthy way</p>
                            </div>

                            <!-- Build Muscle -->
                            <div class="goal-card card-glass p-4 text-center" onclick="selectGoal('build_muscle', this)">
                                <div class="goal-icon text-4xl mb-4">🏋️</div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Build Muscle</h3>
                                <p class="text-sm text-gray-600">I want to build muscle and increase my strength</p>
                            </div>

                            <!-- Maintain -->
                            <div class="goal-card card-glass p-4 text-center" onclick="selectGoal('maintain', this)">
                                <div class="goal-icon text-4xl mb-4">⚖️</div>
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Maintain Weight</h3>
                                <p class="text-sm text-gray-600">I want to maintain my current weight</p>
                            </div>
                        </div>

                        @error('health_goal')
                            <p class="text-red-500 text-sm text-center mb-4">{{ $message }}</p>
                        @enderror

                        <div class="flex justify-between">
                            <button type="button" onclick="prevStep(1)" class="text-gray-600 hover:text-gray-800 font-semibold">
                                <i class="fas fa-arrow-left mr-2"></i> Previous
                            </button>
                            <button type="submit" id="submitBtn" class="btn-primary" disabled>
                                Start My Journey <i class="fas fa-rocket ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-white opacity-75">
                <i class="fas fa-heart text-red-400"></i>
                Balance - Your journey to a healthier life
            </p>
        </div>
    </div>

    <script>
        let currentStep = 1;

        function nextStep(step) {
            // Validate current step
            if (currentStep === 1) {
                const weight = document.getElementById('weight').value;
                const height = document.getElementById('height').value;
                const age = document.getElementById('age').value;
                const gender = document.getElementById('gender').value;

                if (!weight || !height || !age || !gender) {
                    alert('Please fill in all fields');
                    return;
                }
            }

            // Hide current step
            document.getElementById('step' + currentStep).classList.add('hidden');

            // Show next step
            currentStep = step;
            document.getElementById('step' + step).classList.remove('hidden');

            // Update progress
            updateProgress();
        }

        function prevStep(step) {
            document.getElementById('step' + currentStep).classList.add('hidden');
            currentStep = step;
            document.getElementById('step' + step).classList.remove('hidden');
            updateProgress();
        }

        function updateProgress() {
            const progress = (currentStep / 2) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
        }

        function selectGoal(goal, element) {
            // Remove selected class from all cards
            document.querySelectorAll('.goal-card').forEach(card => {
                card.classList.remove('selected');
            });

            // Add selected class to clicked card
            element.classList.add('selected');

            // Set hidden input value
            document.getElementById('health_goal').value = goal;

            // Enable submit button
            document.getElementById('submitBtn').disabled = false;
        }

        // Auto-select goal if there's an old value
        @if(old('health_goal'))
            document.addEventListener('DOMContentLoaded', function() {
                const goal = "{{ old('health_goal') }}";
                const cards = document.querySelectorAll('.goal-card');
                cards.forEach(card => {
                    if (card.getAttribute('onclick').includes(goal)) {
                        card.classList.add('selected');
                        document.getElementById('health_goal').value = goal;
                        document.getElementById('submitBtn').disabled = false;
                    }
                });
            });
        @endif
    </script>
</body>
</html>
