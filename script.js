let filterMovie = () => {
    const input = document.querySelector(".filter-input");
    const cards = document.getElementsByClassName("card");
    let filter = input.value;

    for(let i = 0; i < cards.length; i++){
        let title = cards[i].querySelector('.card-body');

        console.log(title.innerText);

        if(title.innerText.indexOf(filter) > -1){
            cards[i].parentElement.classList.remove("d-none");
            
        }else{
            cards[i].parentElement.classList.add("d-none");
        }
    }
}