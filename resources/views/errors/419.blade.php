<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Expired - Balance+</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0B6B7A',
                        primaryDark: '#07505A',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8 text-center">
        <div class="mb-6">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-slate-800 mb-2">419</h1>
            <h2 class="text-xl font-semibold text-slate-700 mb-3">Page Expired</h2>
            <p class="text-slate-600 mb-6">
                Your session has expired due to inactivity. This usually happens when:
            </p>
            <ul class="text-sm text-slate-500 text-left space-y-2 mb-6">
                <li class="flex items-start gap-2">
                    <span class="text-primary mt-1">•</span>
                    <span>The page was left open for too long</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-primary mt-1">•</span>
                    <span>You submitted a form after a long period of inactivity</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-primary mt-1">•</span>
                    <span>Your browser cache needs to be cleared</span>
                </li>
            </ul>
        </div>

        <div class="space-y-3">
            <button onclick="window.location.reload()"
                class="w-full px-6 py-3 bg-gradient-to-r from-primary to-primaryDark text-white rounded-lg font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Refresh Page
            </button>

            <a href="{{ url()->previous() }}"
                class="block w-full px-6 py-3 border-2 border-primary text-primary rounded-lg font-bold hover:bg-primary hover:text-white transition-all">
                Go Back
            </a>

            <a href="{{ route('home') }}"
                class="block text-sm text-slate-500 hover:text-primary transition mt-4">
                Return to Home
            </a>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-200">
            <p class="text-xs text-slate-400">
                If this problem persists, please contact support.
            </p>
        </div>
    </div>

    <script>
        // Auto refresh after 3 seconds if user doesn't interact
        setTimeout(function() {
            if (confirm('Would you like to refresh the page to continue?')) {
                window.location.reload();
            }
        }, 3000);
    </script>
</body>
</html>
