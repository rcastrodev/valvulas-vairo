let forNewsLetter = document.getElementById('formNewsletter')
async function storeNewsLetter(e){
    e.preventDefault()
    let form = e.currentTarget
    let formData = new FormData(form)
    let btn = form.querySelector('button')
    const mensajeNewsleller = document.getElementById('mensaje-newsletter')
    try {
        let result = await axios.post(form.getAttribute('action'), formData)
        mensajeNewsleller.innerHTML = "<p>Guardado con exito</p>"
        setTimeout(() => {
            form.reset()
        }, 2000);
    
    } catch (error) {            
        mensajeNewsleller.innerHTML = "<p>Error al guardar</p>"
        setTimeout(() => {
            form.reset()
        }, 2000);
    }
    
}
forNewsLetter.addEventListener('submit', storeNewsLetter)