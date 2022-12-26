let table2 = $('#page_table_images').DataTable({
    serverSide: true,
    ajax: `${$('meta[name="url2"]').attr('content')}`,
    bSort: true,
    order: [],
    destroy: true,
    columns: [
        { data: "order" },
        { data: "image" },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    }, 
});

async function findContentImage(id)
{
    // get content 
    let url = `${document.querySelector('meta[name="url"]').getAttribute('content')}/image`
    if(url){
        if(id){
            try {
                let result = await axios.get(`${url}/${id}`)
                let content = result.data.content 
                dataImage(content)
            } catch (error) {
                console.log(new Error(error));
            }
        }
    }
}

function dataImage(content)
{
    let form = document.getElementById('form-update-image')
    form.reset()
    form.querySelector('input[name="id"]').setAttribute('value', content.id)
    if (content.order) 
        form.querySelector('input[name="order"]').setAttribute('value', content.order)
}

function modalImageDestroy(id)
{
    Swal.fire({
        title: 'Deseas eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Si!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            imageDestroy2(id)
        }
    })
}

function imageDestroy2(id)
{
    axios.delete(`${$('meta[name="url"]').attr('content')}/image/${id}`).then(r => {
        Swal.fire(
            'Eliminado!',
            '',
            'success'
        )

        if(typeof table !== 'undefined')    
            table.ajax.reload()

        if(typeof table2 !== 'undefined')    
            table2.ajax.reload()
        
    }).catch(error => console.error(error))

}