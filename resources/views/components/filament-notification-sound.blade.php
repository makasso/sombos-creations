<script>
    document.addEventListener('DOMContentLoaded', function () {
        let lastNotificationCount = null;

        // Create audio context for notification sound
        function playNotificationSound() {
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();

                // First tone
                const osc1 = audioContext.createOscillator();
                const gain1 = audioContext.createGain();
                osc1.connect(gain1);
                gain1.connect(audioContext.destination);
                osc1.frequency.value = 830;
                osc1.type = 'sine';
                gain1.gain.setValueAtTime(0.3, audioContext.currentTime);
                gain1.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);
                osc1.start(audioContext.currentTime);
                osc1.stop(audioContext.currentTime + 0.3);

                // Second tone (higher pitch, slight delay)
                const osc2 = audioContext.createOscillator();
                const gain2 = audioContext.createGain();
                osc2.connect(gain2);
                gain2.connect(audioContext.destination);
                osc2.frequency.value = 1200;
                osc2.type = 'sine';
                gain2.gain.setValueAtTime(0.2, audioContext.currentTime + 0.15);
                gain2.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
                osc2.start(audioContext.currentTime + 0.15);
                osc2.stop(audioContext.currentTime + 0.5);
            } catch (e) {
                console.log('Could not play notification sound:', e);
            }
        }

        // Poll for new unread notifications by watching the badge
        setInterval(function () {
            const badge = document.querySelector('[x-text="$store.notificationStore.unreadCount"]')
                || document.querySelector('.fi-topbar-database-notifications-btn .fi-badge');

            if (badge) {
                const count = parseInt(badge.textContent) || 0;
                if (lastNotificationCount !== null && count > lastNotificationCount) {
                    playNotificationSound();
                }
                lastNotificationCount = count;
            }
        }, 3000);

        // Also listen for Livewire notification events
        document.addEventListener('notificationsSent', function() {
            playNotificationSound();
        });

        // Listen for the Filament notification event
        window.addEventListener('notificationSent', function() {
            playNotificationSound();
        });
    });
</script>

