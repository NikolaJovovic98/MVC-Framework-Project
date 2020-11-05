


const quickSearchUser = document.querySelector('#quick-search-user')

quickSearchUser.addEventListener('keyup',filterUser)

function filterUser(e){

    const text = e.target.value.toLowerCase()

    const usernameUser = document.querySelectorAll(".username-user")

    

    Array.from(usernameUser).forEach(function(user){

        const block =  user.parentElement.parentElement

        if(user.textContent.toLowerCase().indexOf(text) != -1){

           block.style.display='block'
           // $(block).fadeIn(500);

        }

        else {

           block.style.display='none'
           //$(block).fadeOut(500);

        }

    

})




}