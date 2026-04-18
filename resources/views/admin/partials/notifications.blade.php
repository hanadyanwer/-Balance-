<div class="flex items-center gap-4">
    <button id="notificationBtn"
        class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center relative text-slate-500 hover:bg-slate-50 transition-all">
        <i class="fa-regular fa-bell"></i>
        <span id="notificationBadge"
            class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-white hidden animate-pulse"></span>
    </button>
    <!-- Notifications Dropdown -->
    <div id="notificationDropdown" class="hidden absolute top-16 right-8 w-96 bg-white rounded-xl shadow-2xl border border-slate-200 z-50 max-h-96 overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-800">Notifications</h3>
            <button onclick="markAllAsRead()" class="text-xs text-primary hover:underline">Mark all as read</button>
        </div>
        <div id="notificationList" class="overflow-y-auto max-h-80">
            <div class="p-8 text-center text-slate-400">
                <i class="fa-regular fa-bell-slash text-3xl mb-2"></i>
                <p class="text-sm">No notifications</p>
            </div>
        </div>
    </div>

    <!-- Admin Profile Button -->
    <div class="relative">
        <button id="adminProfileBtn"
            class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-50 transition-all">
            <i class="fa-regular fa-user"></i>
        </button>
        <!-- Admin Profile Dropdown -->
        <div id="adminProfileDropdown" class="hidden absolute top-12 right-0 w-64 bg-white rounded-xl shadow-2xl border border-slate-200 z-50">
            <div class="p-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-user-shield text-primary text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-sm text-slate-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        <span class="inline-block mt-1 px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase tracking-wide">Admin</span>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 rounded-lg transition-all">
                    <i class="fa-solid fa-table-cells-large w-5 text-slate-400"></i>
                    <span>Dashboard</span>
                </a>
                <div class="my-1 border-t border-slate-100"></div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-all">
                        <i class="fa-solid fa-arrow-right-from-bracket w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Notifications functionality
const notificationBtn = document.getElementById('notificationBtn');
const notificationDropdown = document.getElementById('notificationDropdown');
const notificationList = document.getElementById('notificationList');
const notificationBadge = document.getElementById('notificationBadge');

// Toggle notifications dropdown
notificationBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    notificationDropdown.classList.toggle('hidden');
    // Close admin profile dropdown if open
    if (document.getElementById('adminProfileDropdown')) {
        document.getElementById('adminProfileDropdown').classList.add('hidden');
    }
    if (!notificationDropdown.classList.contains('hidden')) {
        loadNotifications();
    }
});

// Load notifications
async function loadNotifications() {
    try {
        const response = await fetch('{{ route("admin.notifications") }}');
        const data = await response.json();

        // Update badge
        if (data.unreadCount > 0) {
            notificationBadge.textContent = data.unreadCount;
            notificationBadge.classList.remove('hidden');
        } else {
            notificationBadge.classList.add('hidden');
        }

        // Display notifications
        if (data.notifications.length === 0) {
            notificationList.innerHTML = `
                <div class="p-8 text-center text-slate-400">
                    <i class="fa-regular fa-bell-slash text-3xl mb-2"></i>
                    <p class="text-sm">No notifications</p>
                </div>
            `;
        } else {
            notificationList.innerHTML = data.notifications.map(notif => `
                <div class="p-4 border-b border-slate-100 hover:bg-slate-50 cursor-pointer ${notif.is_read ? 'bg-white' : 'bg-blue-50'}"
                     onclick="markAsRead(${notif.id}, '${notif.link || '#'}')">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                            <i class="fa-solid ${getNotificationIcon(notif.type)} text-primary text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-sm text-slate-800">${notif.title}</p>
                            <p class="text-xs text-slate-500 mt-1">${notif.message}</p>
                            <p class="text-[10px] text-slate-400 mt-1">${formatDate(notif.created_at)}</p>
                        </div>
                        ${!notif.is_read ? '<span class="w-2 h-2 bg-blue-500 rounded-full shrink-0 mt-2"></span>' : ''}
                    </div>
                </div>
            `).join('');
        }
    } catch (error) {
        console.error('Error loading notifications:', error);
    }
}

// Get icon based on notification type
function getNotificationIcon(type) {
    const icons = {
        'user_registered': 'fa-user-plus',
        'plan_regenerated': 'fa-rotate',
        'recipe_added': 'fa-utensils',
        'workout_added': 'fa-dumbbell',
        'tip_added': 'fa-lightbulb',
        'story_submitted': 'fa-quote-left'
    };
    return icons[type] || 'fa-bell';
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);

    if (diffMins < 1) return 'Just now';
    if (diffMins < 60) return `${diffMins} min ago`;
    if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
    if (diffDays < 7) return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    return date.toLocaleDateString();
}

// Mark notification as read
async function markAsRead(id, link) {
    try {
        await fetch(`/admin/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });

        if (link && link !== '#' && link !== 'null') {
            window.location.href = link;
        } else {
            loadNotifications();
        }
    } catch (error) {
        console.error('Error marking notification as read:', error);
    }
}

// Mark all as read
async function markAllAsRead() {
    try {
        await fetch('{{ route("admin.notifications.read-all") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        loadNotifications();
    } catch (error) {
        console.error('Error marking all as read:', error);
    }
}

// Load notifications on page load
loadNotifications();

// Refresh notifications every 30 seconds
setInterval(loadNotifications, 30000);

// Admin Profile Dropdown functionality
const adminProfileBtn = document.getElementById('adminProfileBtn');
const adminProfileDropdown = document.getElementById('adminProfileDropdown');

// Toggle admin profile dropdown
adminProfileBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    adminProfileDropdown.classList.toggle('hidden');
    // Close notifications dropdown if open
    notificationDropdown.classList.add('hidden');
});

// Update close dropdown listener to include admin profile
document.addEventListener('click', function(e) {
    if (!notificationDropdown.contains(e.target) && !notificationBtn.contains(e.target)) {
        notificationDropdown.classList.add('hidden');
    }
    if (!adminProfileDropdown.contains(e.target) && !adminProfileBtn.contains(e.target)) {
        adminProfileDropdown.classList.add('hidden');
    }
});
</script>
