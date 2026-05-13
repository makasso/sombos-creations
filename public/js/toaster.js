/**
 * Livewire Toaster - Standalone build (masmerise/livewire-toaster)
 */
(function () {
    // uuid41
    function uuid41() {
        let d = '';
        while (d.length < 32) {
            d += Math.random().toString(16).substring(2);
        }
        const vr = ((Number.parseInt(d.substring(16, 1), 16) & 0x3) | 0x8).toString(16);
        return `${d.substring(0, 8)}-${d.substring(8, 4)}-4${d.substring(13, 3)}-${vr}${d.substring(17, 3)}-${d.substring(20, 12)}`;
    }

    // Config
    class Alignment {
        static Top = 'top';
        constructor(value) { this.value = value; }
        isTop() { return this.value === Alignment.Top; }
    }

    class Config {
        constructor(alignment, duration, replace, suppress) {
            this.alignment = new Alignment(alignment);
            this.duration = duration;
            this.replace = replace;
            this.suppress = suppress;
        }
        static fromJson(data) {
            return new Config(data.alignment, data.duration, data.replace, data.suppress);
        }
    }

    // Toast
    class Toast {
        constructor(duration, message, type) {
            this.$el = null;
            this.id = uuid41();
            this.isVisible = false;
            this.duration = duration;
            this.message = message;
            this.timeout = null;
            this.trashed = false;
            this.type = type;
        }
        static fromJson(data) {
            return new Toast(data.duration, data.message, data.type);
        }
        dispose() {
            if (this.timeout) clearTimeout(this.timeout);
            this.isVisible = false;
            if (this.$el) {
                this.$el.addEventListener('transitioncancel', () => { this.trashed = true; });
                this.$el.addEventListener('transitionend', () => { this.trashed = true; });
            }
        }
        equals(other) {
            return this.duration === other.duration && this.message === other.message && this.type === other.type;
        }
        runAfterDuration(callback) {
            this.timeout = setTimeout(() => callback(this), this.duration);
        }
        select(config) {
            return config[this.type];
        }
        show($el) {
            this.$el = $el;
            this.isVisible = true;
        }
    }

    // Hub (Alpine plugin)
    function Hub(Alpine) {
        Alpine.data('toasterHub', (initialToasts, config) => {
            config = Config.fromJson(config);
            return {
                _toasts: [],
                get toasts() {
                    const toasts = this._toasts.filter(t => !t.trashed);
                    if (this._toasts.length && !toasts.length) {
                        this.$nextTick(() => { this._toasts = []; });
                    }
                    return toasts;
                },
                init() {
                    document.addEventListener('toaster:received', event => {
                        this.processToast(event);
                    });
                    initialToasts.map(Toast.fromJson).forEach(toast => this.show(toast));
                },
                processToast(data) {
                    const toast = Toast.fromJson({ duration: config.duration, ...data.detail });
                    if (config.replace) {
                        this.toasts.filter(t => t.equals(toast)).forEach(t => t.dispose());
                    } else if (config.suppress && this.toasts.some(t => t.equals(toast))) {
                        return;
                    }
                    this.show(toast);
                },
                show(toast) {
                    toast = Alpine.reactive(toast);
                    toast.runAfterDuration(toast => toast.dispose());
                    if (config.alignment.isTop()) {
                        this._toasts.unshift(toast);
                    } else {
                        this._toasts.push(toast);
                    }
                },
            };
        });
    }

    // Toaster (client-side API)
    const event = (message, type) => {
        document.dispatchEvent(new CustomEvent('toaster:received', { detail: { message, type } }));
    };
    window.Toaster = {
        error: message => event(message, 'error'),
        info: message => event(message, 'info'),
        success: message => event(message, 'success'),
        warning: message => event(message, 'warning'),
    };

    // Register Alpine plugin
    document.addEventListener('alpine:init', () => {
        window.Alpine.plugin(Hub);
    });
})();

