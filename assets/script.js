document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-password-toggle]').forEach((button) => {
		const targetId = button.getAttribute('data-password-toggle');
		const input = targetId ? document.getElementById(targetId) : null;

		if (!input) {
			return;
		}

		const label = button.querySelector('[data-password-toggle-label]');

		const update = () => {
			const isVisible = input.getAttribute('type') === 'text';
			if (label) {
				label.textContent = isVisible ? 'Mostrar' : 'Ocultar';
			}
			button.setAttribute('aria-pressed', String(isVisible));
		};

		button.addEventListener('click', () => {
			input.setAttribute('type', input.getAttribute('type') === 'password' ? 'text' : 'password');
			update();
		});

		update();
	});

	document.querySelectorAll('[data-password-validator]').forEach((form) => {
		const passwordInput = form.querySelector('[data-password-input]');
		const confirmInput = form.querySelector('[data-password-confirm]');
		const feedback = form.querySelector('[data-password-feedback]');
		const rules = {
			length: form.querySelector('[data-rule="length"]'),
			number: form.querySelector('[data-rule="number"]'),
			symbol: form.querySelector('[data-rule="symbol"]'),
			match: form.querySelector('[data-rule="match"]'),
		};

		if (!(passwordInput instanceof HTMLInputElement)) {
			return;
		}

		const evaluate = () => {
			const senha = passwordInput.value;
			const confirmacao = confirmInput instanceof HTMLInputElement ? confirmInput.value : '';
			const lengthOk = senha.length >= 6;
			const numberOk = /[0-9]/.test(senha);
			const symbolOk = /[^A-Za-z0-9]/.test(senha);
			const matchOk = confirmInput instanceof HTMLInputElement ? senha === confirmacao && confirmacao.length > 0 : true;

			const setRuleState = (element, ok) => {
				if (!element) return;
				element.classList.toggle('text-emerald-600', ok);
				element.classList.toggle('text-rose-600', !ok);
				element.classList.toggle('font-semibold', ok);
			};

			setRuleState(rules.length, lengthOk);
			setRuleState(rules.number, numberOk);
			setRuleState(rules.symbol, symbolOk);
			setRuleState(rules.match, matchOk);

			if (feedback) {
				const faltas = [];

				if (!lengthOk) faltas.push('6 caracteres');
				if (!numberOk) faltas.push('1 número');
				if (!symbolOk) faltas.push('1 símbolo');
				if (confirmInput instanceof HTMLInputElement && confirmacao.length > 0 && !matchOk) {
					faltas.push('senhas iguais');
				}

				feedback.textContent = faltas.length === 0 ? 'Senha válida.' : `Falta: ${faltas.join(', ')}.`;
				feedback.classList.toggle('text-emerald-600', faltas.length === 0);
				feedback.classList.toggle('text-rose-600', faltas.length > 0);
			}

			return lengthOk && numberOk && symbolOk && matchOk;
		};

		form.addEventListener('submit', (event) => {
			if (!evaluate()) {
				event.preventDefault();
			}
		});

		passwordInput.addEventListener('input', evaluate);
		if (confirmInput instanceof HTMLInputElement) {
			confirmInput.addEventListener('input', evaluate);
		}

		evaluate();
	});
});
