/**
 * WordPress dependencies
 *
 *
 */
import {getContext, store} from '@wordpress/interactivity';

const {state, actions} = store( 'dark-mode', {
	state: {
		isDark: false,
		scrolled: false,
		get label() {
			const { isDark } = getContext();
			return `Switch to ${isDark ? 'light' : 'dark'} mode`;
		},
		get prefersDarkMode() {
			return (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
		},
		get scheme() {
			return state.isDark ? 'dark' : 'light';
		}
	},
	actions: {
		toggle: () => {
			state.isDark = !state.isDark;
			localStorage.setItem("design-system-dark-mode--scheme", state.scheme);
		},
		bodyScrolled: (e) => {
			const isScrolled = window.scrollY > 0;

			if (state.scrolled !== isScrolled) {
				state.scrolled = isScrolled;
				e.target.documentElement.classList.toggle('scrolled', isScrolled);
			}
		},
		initScheme: () => {
			const hasPreference = localStorage.getItem("design-system-dark-mode--scheme");

			if(state.prefersDarkMode || hasPreference && hasPreference !== state.scheme) {
				state.isDark = hasPreference === 'dark' || (state.prefersDarkMode && !hasPreference);
			}
		}
	},
	callbacks: {
		updateScheme: () => {
			document.documentElement.dataset.scheme = state.isDark ? 'dark' : 'light';
		}
	},
} );
