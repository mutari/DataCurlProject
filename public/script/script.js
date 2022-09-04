document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', async event => {
            event.stopImmediatePropagation();
            event.preventDefault();

            const get = new URLSearchParams(new FormData(form));

            let response = await fetch(`/apps/api.php?${get}`, {
                method: 'GET'
            })

            if(!response.ok) return console.error(response);

            let data = await response.text();

            let outputDiv = event.target.parentElement.querySelector('.output');
            insertHTML(data, outputDiv);

        })
    })

});

function insertHTML(html, dest, append=false){
    if(!append) dest.innerHTML = '';
    let container = document.createElement('div');
    container.innerHTML = html;

    let scripts = container.querySelectorAll('script');
    let nodes = container.childNodes;

    for( let i=0; i< nodes.length; i++) dest.appendChild( nodes[i].cloneNode(true) );
        for( let i=0; i< scripts.length; i++) {
            let script = document.createElement('script');
            script.type = scripts[i].type || 'text/javascript';
            if( scripts[i].hasAttribute('src') ) script.src = scripts[i].src;
            script.innerHTML = scripts[i].innerHTML;
            document.head.appendChild(script);
            document.head.removeChild(script);
        }
    return true;
}