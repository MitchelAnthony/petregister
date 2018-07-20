window.onload = function () {
    let cards = document.getElementsByClassName('card');
    for(let i = 0; i < cards.length; i++) {
        let card = cards.item(i);
        card.addEventListener('click', toggleCard);
    }
};

function toggleCard(event: any): void {
    let card = event.currentTarget;
    card.getElementsByClassName('card-content').item(0).classList.toggle('is-hidden');
    card.getElementsByClassName('card-footer').item(0).classList.toggle('is-hidden');

    let cardArrowClassList = card.getElementsByClassName('fa').item(0).classList;
    if (cardArrowClassList.contains('fa-angle-right')) {
        cardArrowClassList.replace('fa-angle-right', 'fa-angle-down');
    } else {
        cardArrowClassList.replace('fa-angle-down', 'fa-angle-right')
    }
}
