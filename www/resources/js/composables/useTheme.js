import { ref } from 'vue'

const isDark = ref(false)
let initialized = false

function applyTheme(dark) {
    isDark.value = dark
    if (dark) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
    try {
        localStorage.setItem('theme', dark ? 'dark' : 'light')
    } catch (e) {
        // ignore storage errors
    }
}

export function useTheme() {
    if (!initialized) {
        initialized = true
        isDark.value = document.documentElement.classList.contains('dark')
    }

    function toggle() {
        applyTheme(!isDark.value)
    }

    function setTheme(theme) {
        applyTheme(theme === 'dark')
    }

    return {
        isDark,
        toggle,
        setTheme,
    }
}

