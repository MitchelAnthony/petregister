declare function zxcvbn(password: any);

window.onload = function () {
    let cards = document.getElementsByClassName('card-header');
    for(let i = 0; i < cards.length; i++) {
        let card = cards.item(i);
        card.addEventListener('click', toggleCard);
    }

    let form = document.forms['form-search'];
    form.addEventListener('submit', updateAction);

    let passwordInput = document.getElementById('fos_user_registration_form_plainPassword_first');
    passwordInput.addEventListener('keyup', showPasswordStrength)
};

function toggleCard(event: any): void {
    let card = event.currentTarget.parentElement;
    let cardElements = [
        card.getElementsByClassName('card-content'),
        card.getElementsByClassName('card-footer'),
    ];

    for (let cardElement of cardElements) {
        if (1 === cardElement.length) {
            cardElement.item(0).classList.toggle('is-hidden');
        }
    }

    let cardArrowClassList = card.getElementsByClassName('fa').item(0).classList;
    if (cardArrowClassList.contains('fa-angle-right')) {
        cardArrowClassList.replace('fa-angle-right', 'fa-angle-down');
    } else {
        cardArrowClassList.replace('fa-angle-down', 'fa-angle-right')
    }
}

function updateAction(event: any): void {
    let form = event.currentTarget;
    form.action = form.action.replace('_placeholder_id_', form['q'].value);
}

function showPasswordStrength(event: any): void {
    let result = zxcvbn(event.currentTarget.value);
    let outputSpan = document.getElementById('password-strength');
    outputSpan.innerText = result.score + '/4';
}
