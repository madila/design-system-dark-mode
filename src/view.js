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
			const { isDark } = getContext();
			return isDark ? 'dark' : 'light';
		}
	},
	actions: {
		toggle: () => {
			const context = getContext();
			context.isDark = !context.isDark;
			localStorage.setItem("design-system-dark-mode--scheme", state.scheme);
		},
		bodyScrolled: (e) => {
			const isScrolled = window.scrollY > 0;

			if (state.scrolled !== isScrolled) {
				state.scrolled = isScrolled;
				if (isScrolled) {
					e.target.documentElement.classList.add('scrolled');
				} else {
					e.target.documentElement.classList.remove('scrolled');
				}
			}
		},
		initScheme: () => {
			const hasPreference = localStorage.getItem("design-system-dark-mode--scheme");
			const context = getContext();

			if(state.prefersDarkMode || hasPreference && hasPreference !== state.scheme) {
				console.log(state.prefersDarkMode);
				context.isDark = hasPreference === 'dark' || (state.prefersDarkMode && !hasPreference);
			}
		}
	},
	callbacks: {
		updateScheme: () => {
			const { isDark } = getContext();
			document.documentElement.dataset.scheme = isDark ? 'dark' : 'light';
		}
	},
} );
