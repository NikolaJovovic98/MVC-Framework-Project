

const quickSearchField = document.querySelector('#quick-search')

quickSearchField.addEventListener('keyup',filterSearch)

function filterSearch(e){

    const text = e.target.value.toLowerCase()

    const titles = document.querySelectorAll('.titleClass')
    
    Array.from(titles).forEach(function(title){


        if(title.textContent.toLocaleLowerCase().indexOf(text) != -1 ) {

            title.parentElement.style.display = 'block'

        }
        else {

            title.parentElement.style.display = 'none'


        }
        
    
    })

}


